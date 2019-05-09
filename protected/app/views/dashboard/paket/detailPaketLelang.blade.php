@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail Paket Tender</h2>
	<a href="{{URL::to('emonevpanel/paket-lelang/create')}}" class="btn btn-primary" style="float:right;margin-top:10px;">Tambah Paket Tender</a>
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-4">
				<p><b>Nama Perangkat Daerah</b></p>
				<p><b>Tahun Anggaran</b></p>
				<p><b>Nama Kegiatan</b></p>
				<p><b>Nama Paket</b></p>
				<p><b>Rekanan</b></p>
				<p><b>Nilai Kontrak</b></p>
				<p><b>HPS</b></p>
				<p><b>Progres Pekerjaan</b></p>
				<p><b>Nomor Kontrak</b></p>
				<p><b>Nomor BAST</b></p>
				<p><b>Tanggal BAST</b></p>
				<p><b>Tanggal Mulai</b></p>
				<p><b>Tanggal Selesai</b></p>
				<p><b>Status</b></p>
			</div>
			<div class="col-md-8">
				<p><span>:</span> {{$lelang->skpd->skpd}}</p>
				<p><span>:</span> {{$lelang->tahun->tahun}}</p>
				<p><span>:</span> {{$lelang->kegiatan->kegiatan}}</p>
				<p><span>:</span> {{$lelang->paket->paket}}</p>
				<p><span>:</span> {{$lelang->rekanan}}</p>
				<p><span>:</span> Rp. {{number_format((float)$lelang->progres->nilai_kontrak,2,',','.')}}</p>
				<p><span>:</span> {{$lelang->hps}},00</p>
				<p><span>:</span> @if ($lelang->status_kontrak == 'blt')
				Belum
				@elseif ($lelang->status_kontrak == 'sdt')
			Sedang Pelaksanaan
		@else
	Selesai
@endif</p>
				<p><span>:</span> {{$lelang->nomor_kontrak}}</p>
				<p><span>:</span> {{$lelang->nomor_bast}}</p>
				<p><span>:</span> {{ Convert::tgl_eng_to_ind($lelang->tgl_bast)}}</p>
				<p><span>:</span> {{Convert::tgl_eng_to_ind($lelang->progres->tanggal_mulai)}}</p>
				<p><span>:</span> {{Convert::tgl_eng_to_ind($lelang->progres->tanggal_selesai)}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($lelang->status)}}</p>
			</div>
			<a href="{{URL::to('emonevpanel/paket-lelang/edit/'.$lelang->id)}}" class="btn btn-warning" style="margin-top: 20px; margin-left:15px;">Edit Paket Tender</a>
		</div>
	</div>
@endsection