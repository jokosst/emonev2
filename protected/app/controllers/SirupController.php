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
        $kode_skpd = Auth::user()->pegawai->skpd->kode_skpd;
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
        $data['data_sirup']  = $this->sirupService->getProgramBySKPDId("60114");     
    // dd($data['data_sirup']);
        return View::make('dashboard.program.indexProgramSirup',$data);
    }

    public function activity()
    {
        $kode_skpd = Auth::user()->pegawai->skpd->kode_skpd;
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
        $data['data_sirup'] = $this->sirupService->getActivityByProgramId("1034169");
          // $data['data_sirup'] = $this->sirupService->getActivityByProgramId();
        dd( $data['data_sirup'] );
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
}
