@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail Daftar Paket (SIRUP)</h2>
	
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-12">
				<table class="table">
			<tr>
				<td>Nama Perangkat Daerah</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["work_unit"]}}</td>
			</tr>
			<tr>
				<td>Tahun Anggaran</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["year"]}}</td>
			</tr>
			<tr>
				<td>Nama Kegiatan </td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["activity"]}}</td>
			</tr>
			<tr>
				<td>Nama Paket</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["name"]}}</td>
			</tr>
			<tr>
				<td>HPS</td>
				<td>&nbsp;:&nbsp;</td>
				<td>Rp. {{number_format($paket["nominal"],0,',','.')}}</td>
			</tr>
			<tr>
				<td>Nilai Kontrak</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
			</tr>
			<tr>
				<td>Nomor Kontrak</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
				</tr>
			<tr>
			<tr>
				<td>Rekanan</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
			</tr>
			<tr>
				<td>Jenis Proses Pengadaan</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
			</tr>
			<tr>
				<td>Status</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
			</tr>
			<tr>
				<td>Tanggal BAST</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
				</tr>
				<tr>
				<td>Nomor BAST</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
				</tr>
			<tr>
				<td>Realisasi Fisik Paket</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
				</tr>
			<tr>
				<td>Realisasi Keuangan Paket</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
				</tr>
			<tr>
				<td>Progres Pekerjaan</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
				</tr>
			<tr>
				<td>Tanggal Mulai</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
				</tr>
				<tr>
				<td>Tanggal Selesai</td>
				<td>&nbsp;:&nbsp;</td>
				<td></td>
				</tr>
			

					
				</table>

			</div>
			
			
		</div>
	</div>
@endsection