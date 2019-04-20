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
<h2>Format A4</h2>
<table>
	<thead>
		<tr class="summary classheader">
			<th rowspan="2">No</th>
			<th rowspan="2">Nama Pekerjaan / Paket Pekerjaan</th>
			<th rowspan="2">Pagu (Rp)</th>
			<th rowspan="2">HPS (Rp)</th>
			<th rowspan="2">No Kontrak</th>
			<th rowspan="2"><span>Penyedia Barang/Jasa</span></th>
			<th colspan="2">Pelaksanaan Pekerjaan</th>
			<th colspan="2">Efisiensi</th>
		</tr>
		<tr>
			<th>Mulai</th>
			<th>Akhir</th>
			<th>Nilai</th>
			<th>%</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td><strong>Konstruksi</strong></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@foreach($konstruksi as $key => $value)
		<tr>
			<td>{{$key+1}}</td>
			<td>{{$value->paket}}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_pagu_paket,2,',','.'); }}</td>
			<td align="right">{{$value->hps}},00</td>
			<td align="center">{{$value->nomor_kontrak}}</td>
			<td align="center">{{Convert::ubah_tanda_strip($value->metode)}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		<tr>
		@endforeach
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><strong></strong></td>
			<td><strong>Barang</strong></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@foreach($barang as $key => $value)
		<tr>
			<td>{{$key+1}}</td>
			<td>{{$value->paket}}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_pagu_paket,2,',','.'); }}</td>
			<td align="right">{{$value->hps}},00</td>
			<td align="center">{{$value->nomor_kontrak}}</td>
			<td align="center">{{Convert::ubah_tanda_strip($value->metode)}}</td>
			<td>{{$value->tanggal_mulai}}</td>
			<td>{{$value->tanggal_selesai}}</td>
			<td></td>
			<td></td>
		<tr>
		@endforeach
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><strong>Konsultasi</strong></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@foreach($konsultan as $key => $value)
		<tr>
			<td>{{$key+1}}</td>
			<td>{{$value->paket}}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_pagu_paket,2,',','.'); }}</td>
			<td align="right">{{$value->hps}},00</td>
			<td align="center">{{$value->nomor_kontrak}}</td>
			<td align="center">{{Convert::ubah_tanda_strip($value->metode)}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		<tr>
		@endforeach
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><strong>Jasa Lainnya</strong></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@foreach($lainnya as $key => $value)
		<tr>
			<td>{{$key+1}}</td>
			<td>{{$value->paket}}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_pagu_paket,2,',','.'); }}</td>
			<td align="right">{{$value->hps}},00</td>
			<td align="center">{{$value->nomor_kontrak}}</td>
			<td align="center">{{Convert::ubah_tanda_strip($value->metode)}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		<tr>
		@endforeach
	</tbody>
</table>
<script>
		window.print();
	</script>