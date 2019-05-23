<?php

use App\Services\SirupService;

class SirupController extends BaseController
{
    /**
     * The SIRUP Service
     * 
     * @var \App\Services\Contracts\SirupServiceInterface
     */
    protected $sirupService;

    /**
     * Construct the dependency
     * 
     * @return void
     */
    public function __construct(SirupService $sirupService)
    {
        $this->sirupService     = $sirupService;
    }

    public function skpd()
    {
        $skpd       = $this->sirupService->getSKPD();
        // Coba kita dd
        dd($skpd);
    }

    public function program()
    {
        $id = Auth::user()->pegawai->skpd->kode_skpd_admin;
        $skpd_id = Auth::user()->pegawai->skpd->id;
        $tahun_id = Tahun::where('tahun',date('Y'))->first()->id;

        // jika masuk sebagai root || superadmin, maka harus pilih skpd dan tahun
        if(Input::has('skpd_id') && Input::has('tahun_id')) {
            $skpd_id = Input::get('skpd_id');
            $tahun_id = Input::get('tahun_id');
        }

        $data['tahun_id'] = $tahun_id;
        $data['skpd_id'] = $skpd_id;
        $data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
        $data['Skpd'] = Skpd::getSkpd($skpd_id);
        $data['data_sirup']  = $this->sirupService->getProgramBySKPDId($id);     
    // dd($data['data_sirup']);
        return View::make('dashboard.program.indexProgramSirup',$data);
    }

    public function activity()
    {
        $idp = Auth::user()->pegawai->skpd->kode_skpd_admin;
        $skpd_id = Auth::user()->pegawai->skpd->id;
        $tahun_id = Tahun::where('tahun',date('Y'))->first()->id;
 if(Input::has('skpd_id') && Input::has('tahun_id') && Input::has('program_id') ) {
            $skpd_id = Input::get('skpd_id');
            $idProgram = Input::get('program_id');
            $tahun_id = Input::get('tahun_id');
            $data['Kegiatan'] = $this->sirupService->getActivityByProgramId($idProgram);
            $data['idProgram'] = $idProgram;
        }
        
        $data['tahun_id'] = $tahun_id;
        $data['skpd_id'] = $skpd_id;
        $data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
        $data['Skpd'] = Skpd::getSkpd($skpd_id);
        $data['Program']  = $this->sirupService->getProgramBySKPDId($idp); 

    // dd($data['Program']);
        return View::make('dashboard.kegiatan.indexKegiatanSirup',$data);
    }

    

    /**
     * Nha ini bentuk datanya

     [code] => [
        [
        'name' => 
        'type' => // Ada 4 tipe hierarki. Kegiatan > Output > Sub Output > Komponen > Sub Komponen / Package
        'nominal' => 
        'id_parent' => // Nha id_parent ini karena dia kan sifatnya hierarki, Mas.
        ]
     ]

     Nha begitu. Gimana, Mas?
     ok mas saya cek dulu lah..
     makasih mas
     siap... saya exit teamviewer ya mass...
     */
    public function package( $idSKPD, $idProgram, $idActivity)
    {
        $packages   = $this->sirupService->getPackage($idSKPD, $idProgram, $idActivity);
        dd( $packages ); // Nha yang ini butuh 3 parameter. idskpd, idprogram, idactivity
    }
 public function packageList()
    {
        /**
         * Ada 3 Param
         * 
         * page, limit, search
         * tapi semua opsional. Sudah ada nilai defaultnya
         */

        $page       = 1;
        $limit      = 100;
        $search     = '';

        $packages   = $this->sirupService->getPackageList($page, $limit, $search); // bisa dipanggil dengan parameter seperti ini
        // $packages   = $this->sirupService->getPackageList(); // atau default seperti ini
        dd($packages);
    }

    public function packageDetail($id)
    {
        $data['paket'] = $this->sirupService->getPackageDetail($id);
        // dd($data['paket']);
          return View::make('dashboard.paket.detailPaketSirup',$data);
    }

    public function getActivity($id) {
        $act    = $this->sirupService->getPackageDetail($id);
        if( $act ) {
            return $act['activity'];
        }
        return '';
    }

    public function indexProgresPaket() {
        $data['menu'] = 'progres-paket';

        $satker = Auth::user()->pegawai->skpd->kode_skpd_publik;
        // $satker = "102901";
        $tahun = Tahun::where('tahun',date("Y"))->first()->tahun;
        $tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

        if(Input::has('satker') && Input::has('tahun_id')) {
            $satker = Input::get('satker');
            $tahun_id = Input::get('tahun_id');
            $tahun_didapt = Tahun::find($tahun_id);
            $tahun = $tahun_didapt->tahun;
        }

        $data['tahun_id'] = $tahun_id;
        $data['satker'] = $satker;
        $data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
        // $data['Skpd'] = Skpd::getSkpd($skpd_id);
        // $data['nameSkpd'] = Skpd::find($skpd_id);
        $data['nameTahun'] = Tahun::find($tahun_id);
// dd($tahun);

$jedaSleep = 0; //set detik jeda get data detail penyedia dan sewakeloal paket, guna untuk prevent failed http request
$tahun = $tahun; // set tahun
        $params1 = urldecode("idKldi=D204&tahun=$tahun&sEcho=1&iColumns=8&sColumns=%2Csatker%2CjumPenyedia%2C%2CjumSwakelola%2C%2CjumSwakelolaPenyedia%2C&iDisplayStart=0&iDisplayLength=1&mDataProp_0=0&sSearch_0=&bRegex_0=false&bSearchable_0=true&bSortable_0=false&mDataProp_1=1&sSearch_1=&bRegex_1=false&bSearchable_1=true&bSortable_1=true&mDataProp_2=2&sSearch_2=&bRegex_2=false&bSearchable_2=true&bSortable_2=true&mDataProp_3=3&sSearch_3=&bRegex_3=false&bSearchable_3=true&bSortable_3=true&mDataProp_4=4&sSearch_4=&bRegex_4=false&bSearchable_4=true&bSortable_4=true&mDataProp_5=5&sSearch_5=&bRegex_5=false&bSearchable_5=true&bSortable_5=true&mDataProp_6=6&sSearch_6=&bRegex_6=false&bSearchable_6=true&bSortable_6=true&mDataProp_7=7&sSearch_7=&bRegex_7=false&bSearchable_7=true&bSortable_7=true&sSearch=&bRegex=false&iSortCol_0=0&sSortDir_0=asc&iSortingCols=1&_=1546056733110");
$url1 = "https://sirup.lkpp.go.id/sirup/datatablectr/datatableruprekapkldi?$params1";
$getData1 = file_get_contents($url1);
$getData1 = json_decode($getData1);
$totalData1 = $getData1->iTotalDisplayRecords;
$dataParam1 = explode('&', $params1);
for ($i=0;$i<count($dataParam1);$i++) {
    if (strpos($dataParam1[$i], "iDisplayLength") === 0) $dataParam1[$i] = "iDisplayLength=43";
    // if (strpos($dataParam1[$i], "iDisplayLength") === 0) $dataParam1[$i] = "iDisplayLength=$totalData"; // kalo mau seluruh data make yg ini, yg atas matikan saja
    if (strpos($dataParam1[$i], "sEcho") === 0) $dataParam1[$i] = "sEcho=1";
    if (strpos($dataParam1[$i], "tahun") === 0) $dataParam1[$i] = "tahun=$tahun";
}
$dataParam1 = implode('&', $dataParam1);
$url1 = "https://sirup.lkpp.go.id/sirup/datatablectr/datatableruprekapkldi?$dataParam1";
$getData1 = file_get_contents($url1);
$dataData1 = json_decode($getData1)->aaData;
$data['data_satker'] = $dataData1;
        
$params = "tahun=$tahun&idSatker=$satker&sEcho=1&iColumns=8&sColumns=%2CnamaPaket%2C%2C%2CsumberDana%2Cumumkan%2Caktif%2Caction&iDisplayStart=0&iDisplayLength=10&mDataProp_0=0&sSearch_0=&bRegex_0=false&bSearchable_0=true&bSortable_0=false&mDataProp_1=1&sSearch_1=&bRegex_1=false&bSearchable_1=true&bSortable_1=true&mDataProp_2=2&sSearch_2=&bRegex_2=false&bSearchable_2=true&bSortable_2=true&mDataProp_3=3&sSearch_3=&bRegex_3=false&bSearchable_3=true&bSortable_3=true&mDataProp_4=4&sSearch_4=&bRegex_4=false&bSearchable_4=true&bSortable_4=true&mDataProp_5=5&sSearch_5=&bRegex_5=false&bSearchable_5=false&bSortable_5=true&mDataProp_6=6&sSearch_6=&bRegex_6=false&bSearchable_6=false&bSortable_6=true&mDataProp_7=7&sSearch_7=&bRegex_7=false&bSearchable_7=false&bSortable_7=true&sSearch=&bRegex=false&iSortCol_0=0&sSortDir_0=asc&iSortingCols=1&sRangeSeparator=~";
$params = urldecode($params);
$params = explode('&', $params);


for ($i=0;$i<count($params);$i++) {
    if (strpos($params[$i], "idSatker") === 0) $params[$i] = "idSatker=$satker";
    if (strpos($params[$i], "iDisplayLength") === 0) $params[$i] = "iDisplayLength=500";
    if (strpos($params[$i], "sEcho") === 0) $params[$i] = "sEcho=1";
    // echo "<b>$i</b> $params[$i] <br/>";
}

$params = implode('&', $params);
$url = "https://sirup.lkpp.go.id/sirup/datatablectr/dataruppenyediasatker?$params";
$getData = file_get_contents($url);
$dataData = json_decode($getData)->aaData;
$data['data_sirup'] = $dataData; 
        return View::make('dashboard.paket.indexProgrespaket',$data);
    }

    public function editProgres($id) {
        $skpd_id = Auth::user()->pegawai->skpd->id;
        $data['Skpd'] = Skpd::getSkpd($skpd_id);
        $data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
        $data['Pegawai'] = Pegawai::getKpa($skpd_id);
       
        $data['paket'] = $this->sirupService->getPackageDetail($id);
        $paket = $data['paket'];
        $paket_id = $paket["id"];
        $paket_lelang = Lelang::where('paket_id',$paket_id)->first();
       if (isset($paket_lelang->id)) {
         $data['paket_lelang'] = $paket_lelang;
         $lelang_id = $paket_lelang->id; 
        $data['progres'] = Progres::where('lelang_id','=',$lelang_id)->first();
          return View::make('dashboard.paket.editProgresSirup2',$data);
       }else{
 return View::make('dashboard.paket.editProgresSirup',$data);
       }

        

       
    }
    public function updateProgres() {
        $paket_id = Input::get('paket_id');
        $data['skpd_id'] = Input::get('skpd_id');
        $data['tahun_id'] = Input::get('tahun_id');
        $data['jenis_proses_lelang'] = Input::get('jenis_proses_lelang');
        $data['paket_id'] = Input::get('paket_id');
        $data['lokasi_id'] = "1";
        $data['nilai_hps'] = str_replace(['Rp','.'], '', Input::get('hps'));
        $data['hps'] = Input::get('hps');
        $data['nomor_kontrak'] = Input::get('nomor_kontrak');
        $data['tgl_bast'] = Convert::tgl_ind_to_eng(Input::get('tgl_bast'));
        $data['nomor_bast'] = Input::get('nomor_bast');
        $data['realisasi_fisik_paket'] = Input::get('realisasi_fisik_paket');
        $data['realisasi_keuangan_paket'] = Input::get('realisasi_keuangan_paket');
        $data['status'] = Input::get('status');
        $data['status_kontrak'] = Input::get('status_kontrak');
        $data['rekanan'] = Input::get('rekanan');
       
        $paket_lelang = Lelang::where('paket_id',$paket_id)->first();
       if (isset($paket_lelang->id)) {
        $id = Input::get('id');
    DB::table('paket_lelang')->where('id',$id)->update($data);

     $tanggal_mulai = $data['tanggal_mulai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_mulai'));
        $tanggal_selesai = $data['tanggal_selesai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_selesai'));
        $nilai_kontrak = $data['nilai_kontrak'] = str_replace(['Rp','.'], '', Input::get('nilai_kontrak'));

DB::table('progres_lelang')->where('lelang_id',$id)->update(array('tahun_id'=>$data['tahun_id'],'skpd_id'=>$data['skpd_id'],'lokasi_id'=>$data['lokasi_id'],'nilai_kontrak'=>$nilai_kontrak,'rekanan'=>$data['rekanan'],'tanggal_mulai'=>$tanggal_mulai,'tanggal_selesai'=>$tanggal_selesai,'status_kontrak'=>$data['status_kontrak']));
        }else{
            //insert tabel paket lelalng dari data
            $lelang_id = DB::table('paket_lelang')->insertGetId($data);
            //insert dari tabel progres lelang
             $tanggal_mulai = $data['tanggal_mulai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_mulai'));
        $tanggal_selesai = $data['tanggal_selesai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_selesai'));
        $nilai_kontrak = $data['nilai_kontrak'] = str_replace(['Rp','.'], '', Input::get('nilai_kontrak'));
             DB::table('progres_lelang')->insert(array('tahun_id'=>$data['tahun_id'],'skpd_id'=>$data['skpd_id'],'lelang_id'=>$lelang_id,'lokasi_id'=>$data['lokasi_id'],'nilai_kontrak'=>$nilai_kontrak,'rekanan'=>$data['rekanan'],'tanggal_mulai'=>$tanggal_mulai,'tanggal_selesai'=>$tanggal_selesai,'status_kontrak'=>$data['status_kontrak']));
        }
     return Redirect::to('emonevpanel/progres-paket');
    }

    public function detailProgres($id) {
        $paket_lelang = Lelang::where('paket_id',$id)->first();
       if (isset($paket_lelang->id)) {
        $data['paket'] = $this->sirupService->getPackageDetail($id);
        $paket_lelang = Lelang::where('paket_id',$id)->first();
         $data['paket_lelang'] = $paket_lelang;
         $lelang_id = $paket_lelang->id; 
        $data['progres'] = Progres::where('lelang_id','=',$lelang_id)->first();

        return View::make('dashboard.paket.detailProgresSirup',$data);

       }else{
        $data['paket'] = $this->sirupService->getPackageDetail($id);
 return View::make('dashboard.paket.detailProgresSirup2',$data);
       }
        
    }
    public function realisasiKegiatan()
    {
         $idp = Auth::user()->pegawai->skpd->kode_skpd_admin;
        $skpd_id = Auth::user()->pegawai->skpd->id;
        $tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
        $bulan = date('m') - 1;
        if(Input::has('skpd_id') && Input::has('tahun_id') && Input::has('bulan') && Input::has('program_id')) {
            $skpd_id = Input::get('skpd_id');
            $tahun_id = Input::get('tahun_id');
            $bulan = Input::get('bulan');
            $idProgram = Input::get('program_id');
            $data['Kegiatan'] = $this->sirupService->getActivityByProgramId($idProgram);
            $data['idProgram'] = $idProgram;
        }
        
        $data['Tahun'] = Tahun::latest()->get();
        $data['Skpd'] = Skpd::getSkpd($skpd_id);
        $data['skpd_id'] = $skpd_id;
        $data['tahun_id'] = $tahun_id;
        $data['bulan'] = $bulan;

        $data['Program']  = $this->sirupService->getProgramBySKPDId($idp);
        return View::make('dashboard.realisasi.realisasiKegiatanSirup',$data);
    }

    public function editRealisasi($id) {
        $skpd_id = Auth::user()->pegawai->skpd->id;
        $data['Tahun'] = Tahun::where('tahun',date("Y"))->first();
        $data['Skpd'] = Skpd::getSkpd($skpd_id);
        $data['bulan'] = date("m");

        $data['id_program'] = Input::get('id_program');
        $data['nama_kegiatan'] = Input::get('nama_kegiatan');
        $data['pagu_kegiatan'] = Input::get('pagu_kegiatan');
        $data['kegiatan_id'] = $id;
        $realisasi_kegiatan = Realisasi::where('kegiatan_id',$id)->first();
        if (isset($realisasi_kegiatan->id)) {
            $data['realisasi_kegiatan'] = $realisasi_kegiatan;
            return View::make('dashboard.realisasi.editRealisasiSirup2',$data);

        }else{
           return View::make('dashboard.realisasi.editRealisasiSirup',$data);  
        }
       // dd($data['bulan']); 
       
    }
    public function updateRealisasi() {
        $skpd_id = Input::get('skpd_id');
        $id_program = Input::get('id_program');
        $kegiatan_id = Input::get('kegiatan_id');
        $tahun_id = Input::get('tahun_id');
        $punya_paket = 1;
        $bulan = Input::get('bulan');
        $bulan_sekarang = Date('m') - 1;
        $fisik = Input::get('fisik');
        $uang = Input::get('uang');
        $pengeluaran = str_replace(['Rp','.'], "", Input::get('pengeluaran'));

       $realisasi_kegiatan = Realisasi::where('kegiatan_id',$kegiatan_id)->first(); 
        if (isset($realisasi_kegiatan->id)) {
             DB::table('realisasi_kegiatan')->where('kegiatan_id',$kegiatan_id)->update(array('skpd_id'=>$skpd_id,'kegiatan_id'=>$kegiatan_id,'tahun_id'=>$tahun_id,'punya_paket'=>$punya_paket,'fisik'=>$fisik,'uang'=>$uang,'pengeluaran'=>$pengeluaran,'bulan'=>$bulan));
        }else{
        DB::table('realisasi_kegiatan')->insert(array('skpd_id'=>$skpd_id,'kegiatan_id'=>$kegiatan_id,'tahun_id'=>$tahun_id,'punya_paket'=>$punya_paket,'fisik'=>$fisik,'uang'=>$uang,'pengeluaran'=>$pengeluaran,'bulan'=>$bulan));
    }
        return Redirect::to('emonevpanel/realisasi?skpd_id='.$skpd_id.'&program_id='.$id_program.'&tahun_id='.$tahun_id.'&bulan='.$bulan_sekarang.' ');
    }
    public function detailRealisasi($id) {
        $skpd_id = Auth::user()->pegawai->skpd->id;
        $data['Tahun'] = Tahun::where('tahun',date("Y"))->first();
        $data['Skpd'] = Skpd::getSkpd($skpd_id);
        $data['bulan'] = date("m");
        $data['id_program'] = Input::get('id_program');
        $data['nama_kegiatan'] = Input::get('nama_kegiatan');
        $data['pagu_kegiatan'] = Input::get('pagu_kegiatan');
        $data['kegiatan_id'] = $id;
        $realisasi_kegiatan = Realisasi::where('kegiatan_id',$id)->first();
        if (isset($realisasi_kegiatan->id)) {
            $data['realisasi_kegiatan'] = $realisasi_kegiatan;
        return View::make('dashboard.realisasi.detailRealisasiSirup',$data);
    }else{
        return View::make('dashboard.realisasi.detailRealisasiSirup2',$data);
    }
    }

}
