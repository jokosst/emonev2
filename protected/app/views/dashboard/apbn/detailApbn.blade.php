@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail APBN</h2>
	<a href="{{URL::to('emonevpanel/apbn/create')}}" class="btn btn-primary" style="float:right;margin-top: 10px;">Tambah APBN</a>
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-2">
				<p><b>Tahun</b></p>
				<p><b>Triwulan</b></p>
				<p><b>Program</b></p>
				<p><b>Kegiatan</b></p>
				<p><b>Sumber Dana</b></p>
				<p><b>Anggaran</b></p>
				<p><b>Total</b></p>
				<p><b>No DIPA</b></p>
				<p><b>Lokasi</b></p>
				<p><b>Realisasi</b></p>
				<p><b>Kendala</b></p>
				<p><b>Tindak Lanjut</b></p>
				<p><b>Instansi Terkait</b></p>
			</div>
			<div class="col-md-10">
				<p><span>:</span> {{$apbn->tahun->tahun}}</p>
				<p><span>:</span> Triwulan {{$apbn->triwulan}}</p>
				<p><span>:</span> {{$apbn->program->program}}</p>
				<p><span>:</span> {{$apbn->kegiatan->kegiatan}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($apbn->sumber_dana)}}</p>
				<p><span>:</span> {{$apbn->anggaran}}</p>
				<p><span>:</span> Rp. {{number_format((float)$apbn->total,2)}}</p>
				<p><span>:</span> {{$apbn->no_dipa}}</p>
				<p><span>:</span> {{$apbn->lokasi->lokasi}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($apbn->realisasi)}}</p>
				<p><span>:</span> {{$apbn->kendala}}</p>
				<p><span>:</span> {{$apbn->tindak_lanjut}}</p>
				<p><span>:</span> {{$apbn->instansi_terkait}}</p>
			</div>
			<a href="{{URL::to('emonevpanel/apbn/edit/'.$apbn->id)}}" class="btn btn-warning" style="margin-top: 20px;margin-bottom: 10px; margin-left:15px;">Edit Kegiatan</a>
		</div>
	</div>
@endsection