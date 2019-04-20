<?php

class PaketController extends BaseController {

	protected $menu;
	public function __construct() {
		$this->menu = 'paket';
		View::share(array('menu'=>$this->menu));
	}

	public function indexDaftarPaket() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		if(Input::has('skpd_id') && Input::has('tahun_id')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
		}

		$data['tahun_id'] = $tahun_id;
		$data['skpd_id'] = $skpd_id;
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['nameSkpd'] = Skpd::find($skpd_id);
		$data['nameTahun'] = Tahun::find($tahun_id);
		$data['Paket'] = DB::table('daftar_paket')->where('skpd_id','=',$skpd_id)->where('tahun_id','=',$tahun_id)->get();

		return View::make('dashboard.paket.indexDaftarPaket',$data);
	}
	public function paket_sirup() {
		$satker = "102901";
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
		return View::make('dashboard.paket.indexPaketSirup',$data);
	}

	public function detailPaketSirup($id) {
		$url = "https://sirup.lkpp.go.id/sirup/rup/detailPaketPenyedia2018?idPaket=$id";
    $html = file_get_contents($url);
    $dom = new DOMDocument();

    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

$parentDiv = $dom->getElementsByTagName("div")->item(1);
$dataDiv = $parentDiv->getElementsByTagName("div")->item(0);
$dataDl = $dataDiv->getElementsByTagName("dl")->item(0);
$dataDl1 = $dataDiv->getElementsByTagName("dl")->item(1);
$obj = $dataDl->getElementsByTagName("dd");
$obj1 = $dataDl1->getElementsByTagName("dd");

  $data['dukungan_kegiatan'] = preg_replace("/: /", '', $obj->item(0)->textContent);
    $data['nawacita'] = preg_replace("/: /", '', $obj->item(1)->textContent);
    $data['prioritas_nasional'] = preg_replace("/: /", '', $obj->item(2)->textContent);
    $data['program_prioritas'] = preg_replace("/: /", '', $obj->item(3)->textContent);
    $data['kegiatan_prioritas'] = preg_replace("/: /", '', $obj->item(4)->textContent);
    $data['proyek_p_nasional'] = preg_replace("/: /", '', $obj->item(5)->textContent);
    $data['janji_presiden'] = preg_replace("/: /", '', $obj->item(6)->textContent);
    $data['prioritas_bidang'] = preg_replace("/: /", '', $obj->item(7)->textContent);
    $data['tematik'] = preg_replace("/: /", '', $obj->item(8)->textContent);
    $data['kode_urp'] = preg_replace("/: /", '', $obj1->item(0)->textContent);
    $data['nama_paket'] = preg_replace("/: /", '', $obj1->item(1)->textContent);
    $data['kldi']= preg_replace("/: /", '', $obj1->item(2)->textContent);
    $data['satuan_kerja'] = preg_replace("/: /", '', $obj1->item(3)->textContent);
    $data['tahun_anggaran'] = preg_replace("/: /", '', $obj1->item(4)->textContent);
    $data['lokasi_pekerjaan'] = preg_replace("/: /", '', $obj1->item(6)->textContent);
    $data['volume'] = preg_replace("/: /", '', $obj1->item(7)->textContent);
    $data['deskripsi'] = preg_replace("/: /", '', $obj1->item(8)->textContent);
    $data['spesifikasi'] = preg_replace("/: /", '', $obj1->item(9)->textContent);
    $data['produk_d_negeri'] = preg_replace("/: /", '', $obj1->item(10)->textContent);
    $data['usaha_kecil'] = preg_replace("/: /", '', $obj1->item(11)->textContent);
    $data['pra_dipa_dpa'] = preg_replace("/: /", '', $obj1->item(12)->textContent);
    $data['sumber_dana'] = preg_replace("/: /", '', $obj1->item(14)->textContent);
    $data['jenis_pengadaan'] = preg_replace("/: /", '', $obj1->item(15)->textContent);
    $data['jumlah_pagu'] = preg_replace("/: /", '', $obj1->item(16)->textContent);
    $data['pemilihan_penyedia'] = preg_replace("/: /", '', $obj1->item(17)->textContent);
    $data['bulan_kebutuhan'] = preg_replace("/: /", '', $obj1->item(19)->textContent);
    $data['bulan_pekerjaan_akhir'] = preg_replace("/: /", '', $obj1->item(20)->textContent);
    $data['bulan_pekerjaan_mulai'] = preg_replace("/: /", '', $obj1->item(21)->textContent);
    $data['bulan_pemilihan_akhir'] = preg_replace("/: /", '', $obj1->item(22)->textContent);
    $data['bulan_pemilihan_mulai'] = preg_replace("/: /", '', $obj1->item(23)->textContent);
    $data['tanggal_perbarui'] = preg_replace("/: /", '', $obj1->item(24)->textContent);
		return View::make('dashboard.paket.detailPaketSirup',$data);
	}


	public function indexPaketLelang() {
		$data['menu'] = 'lelang';

		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		if(Input::has('tahun_id')) {
			$tahun_id = Input::get('tahun_id');
		}

		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['tahun_id'] = $tahun_id;
		if(Auth::user()->level == 'adminskpd') {
			$data['Lelang'] = Lelang::where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->latest()->get();
		} else {
			$data['Lelang'] = Lelang::where('tahun_id',$tahun_id)->latest()->get();
		}
        //return Response::json($data);
		return View::make('dashboard.paket.indexPaketLelang',$data);
	}
	public function indexProgresPaket() {
		$data['menu'] = 'progres-paket';

		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		if(Input::has('tahun_id')) {
			$tahun_id = Input::get('tahun_id');
		}

		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['tahun_id'] = $tahun_id;
		if(Auth::user()->level == 'adminskpd') {
			$data['Lelang'] = Lelang::where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->latest()->get();
			$data['Progres'] = Progres::where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->get();
		} else {
			$data['Lelang'] = Lelang::where('tahun_id',$tahun_id)->latest()->get();
			$data['Progres'] = Progres::where('tahun_id',$tahun_id)->get();
		}	


        //return Response::json($data);
		return View::make('dashboard.paket.indexProgrespaket',$data);
	}



	public function createDaftarPaket() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$tahun = Tahun::where('tahun',date("Y"))->first()->tahun;


		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['Pegawai'] = Pegawai::getKpa($skpd_id);
		$data['Kegiatan'] = Kegiatan::where('skpd_id', '=', $skpd_id)->where('tahun_id', '=', $tahun_id)->get();
		$data['Lokasi'] = DB::table('lokasi')->get();


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

		return View::make('dashboard.paket.createDaftarPaket',$data);
	}
	public function cari_satker()
    {
        $strsatker    = Input::get('strsatker');
        $tahun = Tahun::where('tahun',date("Y"))->first()->tahun;

  $params = "tahun=$tahun&idSatker=$strsatker&sEcho=1&iColumns=8&sColumns=%2CnamaPaket%2C%2C%2CsumberDana%2Cumumkan%2Caktif%2Caction&iDisplayStart=0&iDisplayLength=10&mDataProp_0=0&sSearch_0=&bRegex_0=false&bSearchable_0=true&bSortable_0=false&mDataProp_1=1&sSearch_1=&bRegex_1=false&bSearchable_1=true&bSortable_1=true&mDataProp_2=2&sSearch_2=&bRegex_2=false&bSearchable_2=true&bSortable_2=true&mDataProp_3=3&sSearch_3=&bRegex_3=false&bSearchable_3=true&bSortable_3=true&mDataProp_4=4&sSearch_4=&bRegex_4=false&bSearchable_4=true&bSortable_4=true&mDataProp_5=5&sSearch_5=&bRegex_5=false&bSearchable_5=false&bSortable_5=true&mDataProp_6=6&sSearch_6=&bRegex_6=false&bSearchable_6=false&bSortable_6=true&mDataProp_7=7&sSearch_7=&bRegex_7=false&bSearchable_7=false&bSortable_7=true&sSearch=&bRegex=false&iSortCol_0=0&sSortDir_0=asc&iSortingCols=1&sRangeSeparator=~";
$params = urldecode($params);
$params = explode('&', $params);


for ($i=0;$i<count($params);$i++) {
    if (strpos($params[$i], "idSatker") === 0) $params[$i] = "idSatker=$strsatker";
    if (strpos($params[$i], "iDisplayLength") === 0) $params[$i] = "iDisplayLength=500";
    if (strpos($params[$i], "sEcho") === 0) $params[$i] = "sEcho=1";
    // echo "<b>$i</b> $params[$i] <br/>";
}

$params = implode('&', $params);
$url = "https://sirup.lkpp.go.id/sirup/datatablectr/dataruppenyediasatker?$params";
$getData = file_get_contents($url);
$dataData = json_decode($getData)->aaData;

echo "<label for=''>Paket (SIRUP)</label>
<select class='form-control' data-live-search='true' onchange='cari()' id='txtpaket'>
<option value=''>-Pilih-</option>";
foreach ($dataData as $data) {
	echo "<option value='",$data[0],"'>[Kode RUP : ",$data[0],"] ",$data[1],"</option>";
}

echo "</select>";
}
	public function cari_paket()
    {
        $strpaket    = Input::get('strpaket');
//         $strpaket    = $request->strpaket;
   $url = "https://sirup.lkpp.go.id/sirup/rup/detailPaketPenyedia2018?idPaket=$strpaket";
    $html = file_get_contents($url);
    $dom = new DOMDocument();

    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

$parentDiv = $dom->getElementsByTagName("div")->item(1);
$dataDiv = $parentDiv->getElementsByTagName("div")->item(0);
$dataDl = $dataDiv->getElementsByTagName("dl")->item(0);
$dataDl1 = $dataDiv->getElementsByTagName("dl")->item(1);
$obj = $dataDl->getElementsByTagName("dd");
$obj1 = $dataDl1->getElementsByTagName("dd");
 $dukungan_kegiatan = preg_replace("/: /", '', $obj->item(0)->textContent);
    $nawacita = preg_replace("/: /", '', $obj->item(1)->textContent);
    $prioritas_nasional = preg_replace("/: /", '', $obj->item(2)->textContent);
    $program_prioritas = preg_replace("/: /", '', $obj->item(3)->textContent);
    $kegiatan_prioritas = preg_replace("/: /", '', $obj->item(4)->textContent);
    $proyek_p_nasional = preg_replace("/: /", '', $obj->item(5)->textContent);
    $janji_presiden = preg_replace("/: /", '', $obj->item(6)->textContent);
    $prioritas_bidang = preg_replace("/: /", '', $obj->item(7)->textContent);
    $tematik = preg_replace("/: /", '', $obj->item(8)->textContent);
    $kode_urp = preg_replace("/: /", '', $obj1->item(0)->textContent);
    $nama_paket = preg_replace("/: /", '', $obj1->item(1)->textContent);
    $kldi = preg_replace("/: /", '', $obj1->item(2)->textContent);
    $satuan_kerja = preg_replace("/: /", '', $obj1->item(3)->textContent);
    $tahun_anggaran = preg_replace("/: /", '', $obj1->item(4)->textContent);
    $lokasi_pekerjaan = preg_replace("/: /", '', $obj1->item(6)->textContent);
    $volume = preg_replace("/: /", '', $obj1->item(7)->textContent);
    $deskripsi = preg_replace("/: /", '', $obj1->item(8)->textContent);
    $spesifikasi = preg_replace("/: /", '', $obj1->item(9)->textContent);
    $produk_d_negeri = preg_replace("/: /", '', $obj1->item(10)->textContent);
    $usaha_kecil = preg_replace("/: /", '', $obj1->item(11)->textContent);
    $pra_dipa_dpa = preg_replace("/: /", '', $obj1->item(12)->textContent);
    $sumber_dana = preg_replace("/: /", '', $obj1->item(13)->textContent);
    $jenis_pengadaan = preg_replace("/: /", '', $obj1->item(14)->textContent);
    $jumlah_pagu = preg_replace("/: /", '', $obj1->item(15)->textContent);
    $pemilihan_penyedia = preg_replace("/: /", '', $obj1->item(16)->textContent);
    $bulan_kebutuhan = preg_replace("/: /", '', $obj1->item(18)->textContent);
    $bulan_pekerjaan_akhir = preg_replace("/: /", '', $obj1->item(19)->textContent);
    $bulan_pekerjaan_mulai = preg_replace("/: /", '', $obj1->item(20)->textContent);
    $bulan_pemilihan_akhir = preg_replace("/: /", '', $obj1->item(21)->textContent);
    $bulan_pemilihan_mulai = preg_replace("/: /", '', $obj1->item(22)->textContent);
    $tanggal_perbarui = preg_replace("/: /", '', $obj1->item(23)->textContent);


    if($jumlah_pagu <= "2500000000") {
$kualifikasi = "<div class='col-md-12'>
			<div class='form-group'>
				<label for=''>Kualifikasi</label>
				<select name='kualifikasi_lelang' class='form-control'>
					<option value='kecil'>Kecil</option>
				</select>
			</div>
			
		</div>";
    }else{
$kualifikasi = "<div class='col-md-12'>
			<div class='form-group'>
				<label for=''>Kualifikasi</label>
				<select name='kualifikasi_lelang' class='form-control'>
					<option value='non-kecil'>Non Kecil</option>
				</select>
			</div>
			
		</div>";
    }


       echo "<div class='col-md-12'>
			<div class='form-group'><label for=''>Pagu Paket</label><input type='text' value='Rp ",str_replace(",", ".", number_format((float)$jumlah_pagu)),"' class='form-control' id='pagu' disabled><input type='hidden' value='Rp ",str_replace(",", ".", number_format((float)$jumlah_pagu)),"' name='pagu_paket'><input type='hidden' value='",$nama_paket,"' name='paket'></div></div>";
		echo "<div class='col-md-12'><div class='form-group'><label for=''>Volume</label><input type='text' name='volume' class='form-control' value='",$volume,"'></div></div>";
		echo $kualifikasi;


		
    }

	public function insertDaftarPaket() {
		$data = Input::all();
		$data['nilai_pagu_paket'] = str_replace(['.','Rp'], '', Input::get('pagu_paket'));
		$paket_id = DB::table('daftar_paket')->insertGetId($data);

		DB::table('realisasi_kegiatan')->where('skpd_id',$data['skpd_id'])->where('tahun_id',$data['tahun_id'])->where('kegiatan_id',$data['kegiatan_id'])->update(array('punya_paket'=>1));
		DB::table('realisasi_paket')->insert(array('tahun_id'=>$data['tahun_id'],'skpd_id'=>$data['skpd_id'],'kegiatan_id'=>$data['kegiatan_id'],'paket_id'=>$paket_id,'bulan'=>1));
		return Redirect::to('emonevpanel/daftar-paket');
	}

	public function detailDaftarPaket($id) {
		$data['paket'] = Paket::where('id',$id)->first();
		return View::make('dashboard.paket.detailDaftarPaket',$data);
	}

	public function editDaftarPaket($id) {
		$paket = Paket::where('id',$id)->first();
		$data['Kpa'] = Pegawai::where('skpd_id',$paket->skpd_id)->where('kpa',1)->get();
		$data['Kegiatan'] = Kegiatan::where('tahun_id',$paket->tahun_id)->where('skpd_id',$paket->skpd_id)->get();
		$data['Lokasi'] = Lokasi::all();
		$data['paket'] = $paket;
		return View::make('dashboard.paket.editDaftarPaket',$data);
	}

	public function updateDaftarPaket() {
		$data = Input::all();
		$id = Input::get('id');
		$data['nilai_pagu_paket'] = str_replace(['.','Rp'], '', Input::get('pagu_paket'));
		DB::table('daftar_paket')->where('id',$id)->update($data);
		return Redirect::to('emonevpanel/daftar-paket');
	}

	public function hapusDaftarPaket($id) {
		DB::table('daftar_paket')->where('id',$id)->delete();
		return Redirect::back();
	}

	

	public function createPaketLelang() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['Kegiatan'] = Kegiatan::where('skpd_id', '=', $skpd_id)->where('tahun_id', '=', $tahun_id)->get();
		$data['Daftar_paket'] = DB::table('daftar_paket')->where('skpd_id','=',$skpd_id)->where('tahun_id','=',$tahun_id)->get();
		$data['menu'] = 'lelang';
	

		return View::make('dashboard.paket.createPaketLelang',$data);
	}

	public function insertPaketLelang() {
		$data['skpd_id'] = Input::get('skpd_id');
		$data['tahun_id'] = Input::get('tahun_id');
		$data['jenis_proses_lelang'] = Input::get('jenis_proses_lelang');
		$data['kegiatan_id'] = Input::get('kegiatan_id');
		$data['paket_id'] = Input::get('paket_id');
		$data['lokasi_id'] = Input::get('lokasi_id');
		$data['nilai_hps'] = str_replace(['Rp','.'], '', Input::get('hps'));
		$data['hps'] = Input::get('hps');
		$data['nomor_kontrak'] = Input::get('nomor_kontrak');
		$data['tgl_bast'] = Convert::tgl_ind_to_eng(Input::get('tgl_bast'));
		$data['nomor_bast'] = Input::get('nomor_bast');
		$data['realisasi-fisik-paket'] = Input::get('realisasi-fisik-paket');
		$data['realisasi-keuangan-paket'] = Input::get('realisasi-keuangan-paket');
		$data['status'] = Input::get('status');
		$data['rekanan'] = Input::get('rekanan');
		$data['status_kontrak'] = Input::get('status_kontrak');
		$lelang_id = DB::table('paket_lelang')->insertGetId($data);
		$tanggal_mulai = $data['tanggal_mulai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_mulai'));
		$tanggal_selesai = $data['tanggal_selesai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_selesai'));
		$nilai_kontrak = $data['nilai_kontrak'] = str_replace(['Rp','.'], '', Input::get('nilai_kontrak'));
DB::table('progres_lelang')->insert(array('tahun_id'=>$data['tahun_id'],'skpd_id'=>$data['skpd_id'],'lelang_id'=>$lelang_id,'lokasi_id'=>$data['lokasi_id'],'nilai_kontrak'=>$nilai_kontrak,'rekanan'=>$data['rekanan'],'tanggal_mulai'=>$tanggal_mulai,'tanggal_selesai'=>$tanggal_selesai,'status_kontrak'=>$data['status_kontrak'],));

		return Redirect::to('emonevpanel/progres-paket');
	}

	public function detailPaketLelang($id) {
		$data['lelang'] = Lelang::find($id);
		return View::make('dashboard.paket.detailPaketLelang',$data);
	}

	public function editPaketLelang($id) {
		$lelang = Lelang::find($id);
		$data['lelang'] = $lelang;
		$data['Paket'] = Paket::where('skpd_id',$lelang->skpd_id)->where('tahun_id',$lelang->tahun_id)->where('kegiatan_id',$lelang->kegiatan_id)->get();
		$data['progres'] = Progres::where('skpd_id',$lelang->skpd_id)->where('tahun_id',$lelang->tahun_id)->where('lelang_id',$lelang->kegiatan_id)->get();
		return View::make('dashboard.paket.editPaketLelang',$data);
	}

	public function updatePaketLelang() {
		$data = Input::all();
		$data['nilai_hps'] = str_replace(['Rp','.'], '', Input::get('hps'));
		$id = Input::get('id');
		DB::table('paket_lelang')->where('id',$id)->update($data);
		$data1['rekanan'] = Input::get('rekanan');
		$data1['status_kontrak'] = Input::get('status_kontrak');
		$data1['tanggal_mulai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_mulai'));
		$data1['tanggal_selesai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_selesai'));
		$data1['nilai_kontrak'] = str_replace(['Rp','.'], '', Input::get('nilai_kontrak'));
		Progress::where('id',$id)->update($data1);
		return Redirect::to('emonevpanel/paket-lelang');
	}

	public function hapusPaketLelang($id) {
		DB::table('paket_lelang')->where('id',$id)->delete();
		return Redirect::back();
	}

	public function indexProgresLelang() {
		$data['menu'] = 'progress';

		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$skpd_id = Auth::user()->pegawai->skpd->id;

		if(Input::has('tahun_id')) {
			$tahun_id = Input::get('tahun_id');
		}

		if(Auth::user()->level == 'adminskpd') {
			$data['Progres'] = Progres::where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->get();
		} else {
			$data['Progres'] = Progres::where('tahun_id',$tahun_id)->get();
		}

		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['tahun_id'] = $tahun_id;

		return View::make('dashboard.paket.indexProgresLelang',$data);
	}

	public function createProgresLelang() {
		$status = "lelang-sudah-selesai,proses-selesai";
		
		$data['menu'] = 'progress';
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		$data['Lelang'] = Lelang::where('skpd_id', '=', $skpd_id)->where('tahun_id', '=', $tahun_id)->get();
		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		return View::make('dashboard.paket.createProgresLelang',$data);
	}

	public function insertProgresLelang() {
		$data = Input::all();
		$data['tanggal_mulai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_mulai'));
		$data['tanggal_selesai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_selesai'));
		$data['nilai_kontrak'] = str_replace(['Rp','.'], '', Input::get('nilai_kontrak'));

		DB::table('progres_lelang')->insert($data);
		return Redirect::to('emonevpanel/progres-lelang');
	}

	public function detailProgresLelang($id) {
		$data['progres'] = Progres::find($id);
		$data['menu'] = 'progress';
		return View::make('dashboard.paket.detailProgresLelang',$data);
	}

	public function editProgresLelang($id) {
		$data['progres'] = Progres::find($id);
		$data['menu'] = 'progress';
		return View::make('dashboard.paket.editProgresLelang',$data);
	}

	public function updateProgresLelang() {
		$data = Input::all();
		$data['tanggal_mulai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_mulai'));
		$data['tanggal_selesai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_selesai'));
		$data['nilai_kontrak'] = str_replace(['Rp','.'], '', Input::get('nilai_kontrak'));
		$id = Input::get();
		Progress::where('id',$id)->update($data);
		return Redirect::to('emonevpanel/progres-lelang');
	}

	public function hapusProgressLelang($id) {
		Progress::where('id',$id)->where();
		return Redirect::back();
	}
}

?>