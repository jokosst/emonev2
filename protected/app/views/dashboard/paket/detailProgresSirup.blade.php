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
				<td>{{$paket_lelang->skpd->skpd}}</td>
			</tr>
			<tr>
				<td>Tahun Anggaran</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket_lelang->tahun->tahun}}</td>
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
				<td>Rp. {{number_format($progres->nilai_kontrak,0,',','.')}}</td>
			</tr>
			<tr>
				<td>Nomor Kontrak</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket_lelang->nomor_kontrak}}</td>
				</tr>
			<tr>
			<tr>
				<td>Rekanan</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket_lelang->rekanan}}</td>
			</tr>
			<tr>
				<td>Jenis Proses Pengadaan</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket_lelang->jenis_proses_lelang}}</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{str_replace('-', ' ',$paket_lelang->status)}}</td>
			</tr>
			<tr>
				<td>Tanggal BAST</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{Convert::tgl_eng_to_ind($paket_lelang->tgl_bast)}}</td>
				</tr>
				<tr>
				<td>Nomor BAST</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket_lelang->nomor_bast}}</td>
				</tr>
			<tr>
				<td>Realisasi Fisik Paket</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket_lelang->realisasi_fisik_paket}}</td>
				</tr>
			<tr>
				<td>Realisasi Keuangan Paket</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{$paket_lelang->realisasi_keuangan_paket}}</td>
				</tr>
			<tr>
				<td>Progres Pekerjaan</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{Convert::ubah_status_kontrak($progres->status_kontrak)}}</td>
				</tr>
			<tr>
				<td>Tanggal Mulai</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{Convert::tgl_eng_to_ind($progres->tanggal_mulai)}}</td>
				</tr>
				<tr>
				<td>Tanggal Selesai</td>
				<td>&nbsp;:&nbsp;</td>
				<td>{{Convert::tgl_eng_to_ind($progres->tanggal_selesai)}}</td>
				</tr>
			

					
				</table>

			</div>
			
			
		</div>
	</div>
@endsection