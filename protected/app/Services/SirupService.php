<?php

namespace App\Services;

use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

class SirupService
{
    /**
     * The \GuzzleHttp\Client to make a request
     * 
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The response of request
     * 
     * @var response
     */

    /**
     * The base url
     * 
     * @var string
     */
    protected $baseUrl;

    /**
     * Username to login to SIRUP
     * 
     * @var string
     */
    protected $username;

    /**
     * Password to login with username to SIRUP
     * 
     * @var string
     */
    protected $password;

    /**
     * The headers of request
     * 
     * @var array
     */
    protected $headers  = [];

    /**
     * The body of the request
     * 
     * @var array
     */
    protected $body     = [];

    /**
     * The http request type
     * 
     * @var string
     */
    protected $httpRequest;

    /**
     * Endpoint to grab data
     * 
     * @var string
     */
    protected $endpoint;

    /**
     * The form data to send
     * 
     * @var array
     */
    protected $formData = [];

    /**
     * The URIs
     */
    protected $URI = [
        'login' => '/sirup/rw/login/submit',
        'skpd' => '/sirup/rkadctr/rkadaerahkonten?isAfterUpload=&tahunAnggaran=2019',
        'program' => '/sirup/service/daftarprogramdbyskpd',
        'activity' => '/sirup/selfservice/daftarkegiatanbyprogram',
        'package' => '/sirup/rkadctr/rkadaerahkontentable',
        'package-list' => '/sirup/datatablectr/dataruppenyedia2018',
        'package-detail' => '/sirup/ro/pp/2018/'
    ];

    protected $defaultUsername = 'ppe-298';
    protected $defaultPassword = 'sgu901261';

    /**
     * Construct the SirupService
     * 
     * @param \GuzzleHttp\Client $client
     * @return void
     */
    public function __construct()
    {
        /**
        $this->baseUrl  = trim( env('SIRUP_URL', 'https://sirup.lkpp.go.id'), '/');
        $this->username = env('SIRUP_USER');
        $this->password = env('SIRUP_PASS');
        */
        $this->baseUrl  = trim( 'https://sirup.lkpp.go.id', '/');
        $this->username = $this->defaultUsername;
        $this->password = $this->defaultPassword;
    }

    /**
     * Login to SIRUP
     * 
     * @return void
     */
    public function login()
    {
        $this->client       = new Client(['base_uri' => $this->baseUrl, 'cookies' => true]);
        $this->response     = $this->client
                                ->request('POST', $this->URI['login'], [
                                    'form_params' => [
                                        'txtUsername' => $this->username,
                                        'txtPassword' => $this->password
                                    ]
                                ]);
    }

    /**
     * Get SKPD Data
     * 
     * @return string
     */
    public function getSKPD()
    {
        $data       = [];
        $content    = $this->setRequest('GET')->setEndpoint('skpd')->run()->getResponseContent();
        if( preg_match_all("/<option value=\"([\d]+)\">(.*?)<\/option>/", $content, $output) ) {
            foreach ($output[1] as $key => $value) {
                $d  = array('id' => $value, 'name' => $output[2][$key]);
                array_push($data, $d);
            }
        }
        return $data;
    }

    /**
     * Get Program by SKPD ID
     * 
     * @param $id
     * @return array
     */
    public function getProgramBySKPDId($id)
    {
        $content    = $this->setRequest('POST')->setEndpoint('program')->setFormData(['form_params' => ['idSKPD' => $id]])->run()->getResponseContent();
        return json_decode($content);
    }

    /**
     * Get activity / kegiatan by program ID
     *  
     * @param $id
     * @return array
     */
    public function getActivityByProgramId($id)
    {
        $content    = $this->setRequest('POST')->setEndpoint('activity')->setFormData(['form_params' => ['idProgram' => $id]])->run()->getResponseContent();
        return json_decode($content);
    }

    /**
     * Get package by activity ID
     * 
     * @param $id
     * @param $idSKPD
     * @param $idProgram
     * @return array
     */
    public function getPackage($idSKPD, $idProgram, $id)
    {
        $datas      = [];
        $queryData  = [
            'idSKPD' => $idSKPD,
            'idProgram' => $idProgram,
            'idKegiatan' => $id,
            'tahunAnggaran' => ''
        ];
        $this->URI['package'] .= '?' . http_build_query($queryData);
        $content    = $this->setRequest('GET')->setEndpoint('package')->run()->getResponseContent();
        if( preg_match_all('/<td>(.*?)<\/td>[\s]+<td><span class="[^\"]+">(.*?)<\/span><\/td>[\s]*<td class="rupiah" style="text-align:right">(.*?)<\/td>/', $content, $output) ) {
            $codes      = $output[1];
            $names      = $output[2];
            $nominals   = $output[3];

            if( count($codes) == count($names) AND count($names) == count($nominals) ) {
                foreach ($codes as $key => $code) {
                    $type       = ( strlen( $code ) == 18 ) ? 'activity' : (
                                    ( strlen( $code ) == 27 ) ? 'output' : 
                                        (
                                            ( strlen( $code ) == 30 ) ? 'sub_output' :
                                            (
                                                ( strlen( $code ) >= 32 AND strlen( $code ) <= 33 ) ? 'component' : 'sub_component'
                                            )
                                        )
                                );
                    $datas[$code] = [
                        'name' => $names[$key],
                        'nominal' => $nominals[$key],
                        'type' => $type
                    ];
                    if( $type != 'activity' ) {
                        $length = ( $type == 'output' ) ? 18 : (
                            ( $type == 'sub_output' ) ? 27 : (
                                ( $type == 'component' ) ? 30 : 32
                            )
                        );
                        $datas[$code]['id_parent'] = substr( $code, 0, $length );
                    }
                }
            }
        }
        return $datas;
    }

    /**
     * Get the package list
     * 
     * @param $page
     * @param $limit
     * @param $search
     * @return array
     */
    public function getPackageList($page = 1, $limit = 10, $search = '')
    {
        $datas          = [];
        $offset         = ( is_numeric($page) AND $page > 0 ) ? $page - 1 : 0;
        $displayStart   = $offset * $limit;
        $query      = [
            'tahun' => '2019',
            'sEcho' => '2',
            'iColumns' => '10',
            'sColumns' => ',kegiatan,namaPaket,,,sumberDana,aktif,final,umumkan,action,',
            'iDisplayStart' => $displayStart,
            'iDisplayLength' => $limit,
            'mDataProp_0' => '0',
            'sSearch_0' => '',
            'bRegex_0' => 'false',
            'bSearchable_0' => 'true',
            'bSortable_0' => 'false',
            'mDataProp_1' => '1',
            'sSearch_1' => '',
            'bRegex_1' => 'false',
            'bSearchable_1' => 'true',
            'bSortable_1' => 'true',
            'mDataProp_2' => '2',
            'sSearch_2' => '',
            'bRegex_2' => 'false',
            'bSearchable_2' => 'true',
            'bSortable_2' => 'true',
            'mDataProp_3' => '3',
            'sSearch_3' => '',
            'bRegex_3' => 'false',
            'bSearchable_3' => 'true',
            'bSortable_3' => 'true',
            'mDataProp_4' => '4',
            'sSearch_4' => '',
            'bRegex_4' => 'false',
            'bSearchable_4' => 'true',
            'bSortable_4' => 'true',
            'mDataProp_5' => '5',
            'sSearch_5' => '',
            'bRegex_5' => 'false',
            'bSearchable_5' => 'true',
            'bSortable_5' => 'true',
            'mDataProp_6' => '6',
            'sSearch_6' => '',
            'bRegex_6' => 'false',
            'bSearchable_6' => 'true',
            'bSortable_6' => 'true',
            'mDataProp_7' => '7',
            'sSearch_7' => '',
            'bRegex_7' => 'false',
            'bSearchable_7' => 'true',
            'bSortable_7' => 'true',
            'mDataProp_8' => '8',
            'sSearch_8' => '',
            'bRegex_8' => 'false',
            'bSearchable_8' => 'true',
            'bSortable_8' => 'true',
            'mDataProp_9' => '9',
            'sSearch_9' => '',
            'bRegex_9' => 'false',
            'bSearchable_9' => 'false',
            'bSortable_9' => 'true',
            'sSearch' => $search,
            'bRegex' => 'false',
            'iSortCol_0' => '0',
            'sSortDir_0' => 'asc',
            'iSortingCols' => '1',
            'sRangeSeparator' => '~'
        ];
        $this->URI['package-list'] .= '?' . http_build_query($query);
        $content    = $this->setRequest('GET')->setEndpoint('package-list')->run()->getResponseContent();
        $object     = json_decode($content);
        foreach ($object->aaData as $key => $value) {
            $d  = [
                'id' => $value[0],
                'activity' => $value[1],
                'package' => $value[2],
                'nominal' => $value[3],
                'month' => $value[4],
                'fund' => $value[5],
                'A' => $value[6],
                'FD' => $value[7],
                'U' => $value[8]
            ];
            array_push($datas, $d);
        }
        return $datas;
    }


    /**
     * Get the detail of package
     * 
     * @param $id
     * @return array
     */
    public function getPackageDetail($id)
    { 
        $this->URI['package-detail'] .= $id;
        $content    = $this->setRequest('GET')->setEndpoint('package-detail')->run()->getResponseContent();
        $activity   = $this->getPackageList(1, 1, $id);
        if( count($activity) == 1 ) {
            $activityString = $activity[0]['activity'];
        }
        $data       = [
            'id' => '',
            'name' => '',
            'activity' => $activityString,
            'kldi' => '',
            'work_unit' => '',
            'year' => '',
            'location' => [],
            'volume' => '',
            'description' => '',
            'spesification' => '',
            'is_local_product' => '',
            'is_small_business' => '',
            'pra_dipa_dpa' => '',
            'fund' => [
                'total' => '',
                'source' => []
            ],
            'type' => '',
            'nominal' => '',
            'selection' => '',
            'time' => [
                'final_need' => '',
                'initial_need' => '',
                'final_work' => '',
                'initial_work' => '',
                'final_poll' => '',
                'initial_poll' => '',
                'updated' => ''
            ],
            'renja' => [
                'nawacita' => '',
                'jani_president' => '',
                'national_priority' => '',
                'program_priority' => '',
                'activity_priority' => '',
                'project_priority' => '',
                'output_program' => '',
                'theme' => ''
            ]
        ];

        $regexGroup = [
            'id' => "/<dt>Kode RUP<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'name' => "/<dt>Nama Paket<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'kldi' => "/<dt>KLDI<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'work_unit' => "/<dt>Satuan Kerja<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'year' => "/<dt>Tahun Anggaran<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'volume' => "/<dt>Volume<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'description' => "/<dt>Deskripsi<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'spesification' => "/<dt>Spesifikasi<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'is_local_product' => "/<dt>Produk Dalam Negeri<\/dt>\s*<dd>[<b>]*: ([a-zA-Z]+)[<\/b>]*<\/dd>/",
            'is_small_business' => "/<dt>Usaha Kecil<\/dt>\s*<dd>[<b>]*: ([a-zA-Z]+)[<\/b>]*<\/dd>/",
            'pra_dipa_dpa' => "/<dt>Pra DIPA \/ DPA<\/dt>\s*<dd>[<b>]*: ([a-zA-Z]+)[<\/b>]*<\/dd>/",
            'type' => "/<dt>Jenis Pengadaan<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'nominal' => "/<dt>Jumlah Pagu<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'selection' => "/<dt>Pemilihan Penyedia<\/dt>\s*<dd>: (.*?)<\/dd>/",
        ];

        $regexTimeGroup = [
            'final_need' => "/<dt>Bulan Kebutuhan Akhir<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'initial_need' => "/<dt>Bulan Kebutuhan Awal<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'final_work' => "/<dt>Bulan Pekerjaan Akhir<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'initial_work' => "/<dt>Bulan Pekerjaan Mulai<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'final_poll' => "/<dt>Bulan Pemilihan Akhir<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'initial_poll' => "/<dt>Bulan Pemilihan Mulai<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'updated' => "/<dt>Tanggal Perbarui<\/dt>\s*<dd>: (.*?)<\/dd>/"
        ];

        $regexRenjaGroup = [
            'nawacita' => "/<dt>Nawacita<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'jani_president' => "/<dt>Jani Presiden<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'national_priority' => "/<dt>Prioritas Nasional<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'program_priority' => "/<dt>Prioritas Program<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'activity_priority' => "/<dt>Prioritas Kegiatan<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'project_priority' => "/<dt>Prioritas Proyek<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'output_program' => "/<dt>Program Output<\/dt>\s*<dd>: (.*?)<\/dd>/",
            'theme' => "/<dt>Tema<\/dt>\s*<dd>: (.*?)<\/dd>/"
        ];

        foreach ($regexGroup as $key => $value) {
            if( preg_match_all($value, $content, $output) ) {
                $data[$key]     = $output[1][0];
            }
        }

        foreach ($regexTimeGroup as $key => $value) {
            if( preg_match_all($value, $content, $output) ) {
                $data['time'][$key]     = $output[1][0];
            }
        }

        foreach ($regexRenjaGroup as $key => $value) {
            if( preg_match_all($value, $content, $output) ) {
                $data['renja'][$key]     = $output[1][0];
            }
        }

        if( preg_match_all("/<td>([^<]+)<\/td>\s+<td>([^<]+)<\/td>\s+<td>([^<]+)<\/td>\s+<td>([^<]+)<\/td>/", $content, $output) ) {
            foreach ($output[1] as $key => $value) {
                $loc    = [
                    'province' => $output[2][$key],
                    'city' => $output[3][$key],
                    'detail' => $output[4][$key]
                ];

                array_push($data['location'], $loc);
            }
        }

        if( preg_match_all("/<th>([^<]+)<\/th>\s+<th>([^<]+)<\/th>\s+<th>([^<]+)<\/th>\s+<th>([^<]+)<\/th>\s+<th><span class=\"rupiah\">([^<]+)<\/span><\/th>/", $content, $output) ) {
            foreach ($output[1] as $key => $value) {
                $fund    = [
                    'name' => $output[1][$key],
                    'ta' => $output[2][$key],
                    'klpd' => $output[3][$key],
                    'mak' => $output[4][$key],
                    'nominal' => $output[5][$key]
                ];

                array_push($data['fund']['source'], $fund);
            }
        }

        if( preg_match_all('/Total<\/th>\s+<th><span class="rupiah"> (\d+)<\/span>/', $content, $output) ) {
            $data['fund']['total']  = $output[1][0];
        }

        return $data;
    }

    /**
     * Set data to send
     * 
     * @param array $formData
     * @return \App\Services\SirupService
     */
    private function setFormData( $formData)
    {
        $this->formData     = $formData;
        return $this;
    }

    /**
     * Set endpoint that will be send the request
     * 
     * @param string $endpoint
     * @return \App\Services\SirupService
     */
    private function setEndpoint( $endpoint)
    {
        $this->endpoint     = $endpoint;
        return $this;
    }

    /**
     * Set request that will be send to URI
     * 
     * @param string $request
     * @return \App\Services\SirupService
     */
    private function setRequest( $request)
    {
        $this->httpRequest  = $request;
        return $this;
    }
    
    /**
     * Get the response content
     * 
     * @return string
     */
    private function getResponseContent()
    {
        if( $this->response ) {
            $body   = $this->response->getBody();
            return $body->getContents();
        }
        return '';
    }

    /**
     * Set headers that will be send to URI
     * 
     * @param array $headers
     * @return \App\Services\SirupService
     */
    private function setHeaders( $headers)
    {
        $this->headers  = $headers;
        return $this;
    }

    /**
     * Set body that will be send to URI
     * 
     * @param array $body
     * @return \App\Services\SirupService
     */
    private function setBody( $body)
    {
        $this->body     = $body;
        return $this;
    }

    /**
     * Send the request
     * 
     * @return \App\Services\SirupService
     */
    private function run()
    {
        if( isset( $this->URI[$this->endpoint] ) ) {
            $this->login();
            $this->response     = $this->client->request( $this->httpRequest, $this->URI[$this->endpoint], $this->formData);
        } else {
            $this->response     = null;
        }
        return $this;
    }

    public function coba (){
       return "Matikan Laptop";
    }

    }
