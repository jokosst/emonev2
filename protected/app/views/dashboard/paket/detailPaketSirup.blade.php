@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail Daftar Paket (SIRUP)</h2>
	
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-12">
				<table class="table">
			<tr>
				<td>Kode RUP</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["id"]}}</td>
			</tr>
			<tr>
				<td>Nama Kegiatan </td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["activity"]}}</td>
			</tr>
			<tr>
				<td>Nama Paket </td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["name"]}}</td>
			</tr>
			<tr>
				<td>KLDI</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["kldi"]}}</td>
			</tr>
			<tr>
				<td>Satuan Kerja</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["work_unit"]}}</td>
			</tr>
			<tr>
				<td>Tahun Anggaran</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["year"]}}</td>
			</tr>
			<tr>
				<td>Lokasi Pekerjaan</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["location"]['0']["detail"]}}, {{$paket["location"]['0']["province"]}}</td>
			</tr>
			<tr>
				<td>Volume</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["volume"]}}</td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["description"]}}</td>
				</tr>
			<tr>
				<td>Spesifikasi</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["spesification"]}}</td>
				</tr>
			<tr>
				<td>Produk Dalam Negri</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["is_local_product"]}}</td>
				</tr>
			<tr>
				<td>Usaha Kecil</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["is_small_business"]}}</td>
				</tr>
			<tr>
				<td>Pra DIPA/DIPA</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["pra_dipa_dpa"]}}</td>
				</tr>
			<tr>
				<td>Sumber Dana</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["fund"]["source"]['0']["name"]}}</td>
				</tr>
				<tr>
				<td>MAK</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["fund"]["source"]['0']["mak"]}}</td>
				</tr>
			<tr>
				<td>Jenis Pengadaan</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["type"]}}</td>
				</tr>
			<tr>
				<td>Jumlah Pagu</td>
				<td>&nbsp;:&nbsp;</td>
				<td>Rp. {{number_format($paket["nominal"],0,',','.')}}</td>
				</tr>
			<tr>
				<td>Pemilihan Penyedia</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["selection"]}}</td>
				</tr>
				<tr>
				<td>Bulan Kebutuhan Akhir</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["time"]["final_need"]}}</td>
				</tr>
			<tr>
			<tr>
				<td>Bulan Kebutuhan Awal</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["time"]["initial_need"]}}</td>
				</tr>
			<tr>
				<td>Bulan Pekerjaan Akhir</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["time"]["final_work"]}}</td>
				</tr>
			<tr>
				<td>Bulan Pekerjaan Mulai</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["time"]["initial_work"]}}</td>
				</tr>
			<tr>
				<td>Bulan Pemilihan Akhir</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["time"]["final_poll"]}}</td>
				</tr>
			<tr>
				<td>Bulan Pemilihan Mulai </td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["time"]["initial_poll"]}}</td>
				</tr>
			<tr>
				<td>Tanggal Perbarui </td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket["time"]["updated"]}}</td>
				</tr>

					
				</table>

			</div>
			
			
		</div>
	</div>
@endsection