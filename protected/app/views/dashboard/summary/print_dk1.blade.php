<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
td{
	padding-right: 5px;
	padding-left: 5px;
}
</style>
<h2>Format DK1</h2>
<!-- END FORM SORTIR SUMMARY -->
<table class="table table-striped" border="1" id="table-summary">
	<thead>
		<tr>
			 <th>Nama Paket Pekerjaan </th>
	        <th>B/K/S/J</th>
	        <th style="width: 130px">Nilai Kontrak</th>
	        <th>Lokasi Kegiatan</th>
	        <th>Nama KPA/PA/PPK</th>
	        <th>Rekanan</th>
	        <th>Mulai</th>
	        <th>Akhir </th>
		</tr>
	</thead>
	<tbody>
		@foreach($summary as $key => $value)
		<tr>
			<td><strong>{{$key}}</strong></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@for($x = 0; $x < count($value); $x ++)
		<tr>
			<td>{{$value[$x]->paket}}</td>
				<td  align="center">{{ Summary::ubah_jenis_pengadaan($value[$x]->jenis_pengadaan) }}</td>
				<td  align="right">{{ "Rp ".number_format($value[$x]->nilai_kontrak,2,',','.') }}</td>
				<td>{{ Convert::ubah_kab($value[$x]->lokasi) }}</td>
				<td>{{ $value[$x]->pegawai }}</td>
				<td>{{ $value[$x]->rekanan }}</td>
				<td>{{ Convert::tgl_eng_to_ind($value[$x]->tanggal_mulai) }}</td>
				<td>{{ Convert::tgl_eng_to_ind($value[$x]->tanggal_selesai) }}</td>
		</tr>
		@endfor
		@endforeach
	</tbody>
</table>

<script>
		window.print();
	</script>