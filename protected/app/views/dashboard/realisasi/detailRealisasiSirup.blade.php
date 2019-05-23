@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail Realisasi</h2>
	
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-12">
				<table class="table">
			<tr>
				<td>Nama Perangkat Daerah</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$Skpd->skpd}}</td>
			</tr>
			<tr>
				<td>Tahun Anggaran</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$Tahun->tahun}}</td>
			</tr>
			<tr>
				<td>Nama Kegiatan </td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$nama_kegiatan}}</td>
			</tr>
			<tr>
				<td>bulan</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{ Convert::ubah_bulan($bulan) }}</td>
			</tr>
			<tr>
				<td>Pagu</td>
				<td>&nbsp;:&nbsp;</td>
				<td>Rp. {{number_format($pagu_kegiatan,0,',','.')}}</td>
			</tr>
			<tr>
				<td>Pengeluaran</td>
				<td>&nbsp;:&nbsp;</td>
				<td>Rp. {{number_format($realisasi_kegiatan->pengeluaran,0,',','.')}} </td>
			</tr>
			<tr>
				<td>Fisik</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$realisasi_kegiatan->fisik}}%</td>
			</tr>
			<tr>
				<td>Uang</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$realisasi_kegiatan->uang}}%</td>
			</tr>

					
				</table>
<a href="{{URL::to('emonevpanel/realisasi/edit/'.$kegiatan_id.'?id_program='.$id_program.'&nama_kegiatan='.$nama_kegiatan.'&pagu_kegiatan='.$pagu_kegiatan)}}" class="btn btn-warning" style="margin-top: 20px; margin-left:15px;">Edit Realisasi</a>
			</div>
			
			
		</div>
	</div>
@endsection