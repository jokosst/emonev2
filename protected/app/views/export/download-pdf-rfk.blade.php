<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		html {
			margin: 20px;
		}
		.table-rfk-pdf {
			font-size: 8px;
		}
		table {
		    border-collapse: collapse;
		}

		table, th, td {
		    border: 1px solid black;
		    padding-left: 5px;
		}
	</style>
</head>
<body>
	<h3 style="text-align:center;">REKAPITULASI LAPORAN REALISASI FISIK DAN KEUANGAN PELAKSANAAN KEGIATAN PEMBANGUNAN KABUPATEN SANGGAU TAHUN ANGGARAN {{$tahun->tahun}} KEADAAN BULAN {{strtoupper(Convert::ubah_bulan($bulan)) }}</h3>
	<table class="table-rfk-pdf">
		<thead>
			<tr>
				<th rowspan="2">Kode Rekening</th>
				<th rowspan="2" style="width: 80px;">Program</th>
				<th rowspan="2">Kegiatan</th>
				<th colspan="2">Belanja Menurut DIPA/DPA</th>
				<th rowspan="2">Bobot</th>
				<th colspan="3">Realisasi Fisik</th>
				<th colspan="2">Realisasi Keuangan</th>
			</tr>
		<tr>
			<th style="width: 110px">Sebelum</th>
			<th style="width: 110px">Sesudah</th>
			<th>Rencana</th>
			<th>Realisasi</th>
			<th>Tertimbang</th>
			<th>Pengeluaran/SPJ</th>
			<th>Persentase Keuangan</th>
		</tr>
		</thead>
		<tbody>
			@foreach($Kegiatan as $kegiatan)
			<tr>
				<td>{{$kegiatan->kode_anggaran}}</td>
				<td>{{$kegiatan->program}}</td>
				<td>{{$kegiatan->kegiatan}}</td>
				<td align="right">{{ "Rp ".number_format($kegiatan->pagu_awal,2,',','.'); }}</td>
				<td align="right">{{ "Rp ".number_format($kegiatan->pagu_perubahan,2,',','.'); }}</td>
				<td>{{ str_replace('.', ',', round(Kegiatan::hitungBobot($skpd_id,$tahun_id,$kegiatan->kegiatan),2)) .'%'}}</td>
				
				<td>{{ str_replace('.', ',', number_format((float)Kegiatan::getRencanaFisik($tahun_id,$bulan),2)) }} % </td>
				<td>{{ str_replace('.', ',', number_format((float)$kegiatan->fisik,2)) }}%</td>
				<td>{{ str_replace('.', ',', number_format((float)Kegiatan::hitungTertimbang(Kegiatan::hitungBobot($skpd_id,$tahun_id,$kegiatan->kegiatan),$kegiatan->fisik),2)) }}% </td>
				<td align="right">{{ "Rp ".number_format($kegiatan->pengeluaran,2,',','.'); }}</td>
				<td>{{ str_replace('.', ',', number_format((float)$kegiatan->uang,2)) }} %</td>
			</tr>
			@endforeach
			<tr style="background: #f1f1f1;">
				<td colspan="3"><b>Total</b></td>
				<td align="right"> {{ "Rp ".number_format(Kegiatan::hitungPaguAwal($skpd_id,$tahun_id),2,',','.'); }} </td>
				<td align="right"> {{ "Rp ".number_format(Kegiatan::hitungPaguPerubahan($skpd_id,$tahun_id),2,',','.'); }} </td>
				<td> {{ str_replace('.', ',', round(Kegiatan::hitungTotalBobot($skpd_id,$tahun_id),2)).'%' }}</td>
				<td></td>
				<td> {{ str_replace('.', ',', number_format((float)Kegiatan::hitungTotalFisik($skpd_id, $tahun_id, $bulan),2)) }} %</td>
				<td> {{ str_replace('.', ',', number_format((float)Kegiatan::hitungTotalTertimbang($skpd_id, $tahun_id, $bulan),2)) }} %</td>
				
				<td align="right"> {{ "Rp ".number_format(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan),2,',','.'); }} </td>
				<td> {{ str_replace('.', ',', number_format((float)Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan) / Kegiatan::hitungPaguSkpd($skpd_id,$tahun_id) * 100,2)) }} % </td>
			</tr>
		</tbody>
	</table>

	<div style="margin-left: 700px; margin-top: 20px; page-break-inside: avoid;">
		<div>{{$lokasi}}, {{ $tanggal }}</div>
		<div style="margin-bottom: 50px;">{{$jabatan}}</div>
		<div style="text-decoration: underline;">{{$pegawai}}</div>
		<div>NIP. {{$nip}}</div>
	</div>
</body>
</html>