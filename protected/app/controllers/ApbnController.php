<?php

class ApbnController extends BaseController {
	protected $menu;

	public function __construct() {
		$this->menu = 'apbn';
		View::share(array('menu'=>$this->menu));
	}

	public function indexApbn() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['tahun_id'] = $tahun_id;
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['nameTahun'] = Tahun::find($tahun_id);
		
		if(Input::has('triwulan') && Input::has('tahun_id')) {
			$triwulan = Input::get('triwulan');
			$tahun_id = Input::get('tahun_id');
			$data['Apbn'] = DB::table('apbn')->select('apbn.id','apbn.anggaran','kegiatan.kegiatan','program.program','lokasi.lokasi')
						->leftjoin('kegiatan','kegiatan.id','=','apbn.kegiatan_id')
						->leftjoin('program','program.id','=','apbn.program_id')
						->leftjoin('lokasi','lokasi.id','=','apbn.lokasi_id')
						->where('apbn.triwulan',$triwulan)
						->where('apbn.tahun_id',$tahun_id)->get();
		}else{

		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['tahun_id'] = $tahun_id;
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['nameTahun'] = Tahun::find($tahun_id);
		$data['Apbn'] = DB::table('apbn')->select('apbn.id','apbn.anggaran','kegiatan.kegiatan','program.program','lokasi.lokasi')
						->leftjoin('kegiatan','kegiatan.id','=','apbn.kegiatan_id')
						->leftjoin('program','program.id','=','apbn.program_id')
						->leftjoin('lokasi','lokasi.id','=','apbn.lokasi_id')->get();
					}
		return View::make('dashboard.apbn.indexApbn',$data);
	}

	 public function createApbn() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun', date("Y"))->first()->id;
		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['tahun_id'] = $tahun_id;
		$data['Program'] = Program::where('tahun_id',$tahun_id)->get();
		$data['Kegiatan'] = Kegiatan::where('tahun_id',$tahun_id)->get();
		$data['Lokasi'] = Lokasi::all();
		return View::make('dashboard.apbn.createApbn',$data);
	}

	public function insertApbn() {
		$data = Input::all();
		$data['total'] = str_replace(['Rp','.'], '', Input::get('total'));

		Apbn::insert($data);		
		return Redirect::to('emonevpanel/apbn');
	}

	public function detailApbn($id) {
		// $apbn1 = Apbn::find($id);
		// $tahun = $apbn1->tahun_id;
		// $data['Tahun'] = Tahun::find($tahun);
		$data['apbn'] = Apbn::where('id',$id)->first();
		// $data['apbn'] = DB::table('apbn')->select('apbn.*','kegiatan.kegiatan','program.program','lokasi.lokasi')
		// 				->join('kegiatan','kegiatan.id','=','apbn.kegiatan_id')
		// 				->join('program','program.id','=','apbn.program_id')
		// 				->join('lokasi','lokasi.id','=','apbn.lokasi_id')
		// 				->where('apbn.id',$id)->get();
		return View::make('dashboard.apbn.detailApbn',$data);
	}

	public function editApbn($id) {
		$apbn1 = Apbn::find($id);
		$tahun = $apbn1->tahun_id;
		$data['Tahun'] = Tahun::find($tahun);
		// dd($tahun);
		$data['apbn'] = $apbn1;
		$data['Program'] = Program::where('tahun_id',$apbn1->tahun_id)->get();
		$data['Kegiatan'] = Kegiatan::where('tahun_id',$apbn1->tahun_id)->where('skpd_id',$apbn1->skpd_id)->get();
		$data['Lokasi'] = Lokasi::all();
		return View::make('dashboard.apbn.editApbn',$data);
	}

	public function updateApbn() {
		$data = Input::all();
		$id = Input::get('id');
		$data['total'] = str_replace(['Rp','.'], '', Input::get('total'));
		DB::table('apbn')->where('id',$id)->update($data);
		return Redirect::to('emonevpanel/apbn');
	}

	public function hapusApbn($id) {
		$apbn = Apbn::where('id',$id)->first();
		$skpd_id = $apbn->skpd_id;
		$tahun_id = $apbn->tahun_id;

		/* Proses Menghapus Kegiatan */
		DB::table('apbn')->where('id',$id)->delete();

		return Redirect::to('emonevpanel/apbn');
	}
}

 ?>