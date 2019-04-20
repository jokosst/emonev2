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
<h2>Format A1</h2>
<!-- FORM SORTIR SUMMARY -->
<!-- END FORM SORTIR SUMMARY -->

<table border="1" >
	<thead>
		<tr><th>No</th>
			<th style="width:200px;">Metode Pemilihan / Paket Pekerjaan</th>
			<th>Volume</th>
			<th style="width:150px;">Pagu (Rp)</th>
			<th>Jenis Pengadaan</th>
			<th>Lokasi</th>
			<th>Nama KPA/PPK/PA</th>
		</tr>
		<tr><th>1</th>
			<th style="width:200px;">2</th>
			<th>3</th>
			<th style="width:150px;">4</th>
			<th>5</th>
			<th>6</th>
			<th>7</th>
		</tr>
	</thead>
	<tr><td></td>
			<td style="width:200px;">Paket Tender</td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>

		<tr><td></td>
			<td style="width:200px;"><b>Tender</b></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@foreach($Tender as $key=>$tender)
		<tr><td>{{$key+1}}</td>
			<td style="width:200px;">{{$tender->paket}}</td>
			<td align="center">{{$tender->volume}}</td>
			<td style="width:150px;" align="right">{{$tender->pagu_paket}},00</td>
			<td align="center">{{$tender->jenis_pengadaan}}</td>
			<td align="center">{{$tender->lokasi}}</td>
			<td align="center">{{$tender->pegawai}}</td>
		</tr>
		@endforeach
		<tr><td></td>
			<td style="width:200px;"></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr><td></td>
			<td style="width:200px;"><b>Tender Cepat</b></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@foreach($Tender_cepat as $key=>$tender_cepat)
		<tr><td>{{$key+1}}</td>
			<td style="width:200px;">{{$tender_cepat->paket}}</td>
			<td align="center">{{$tender_cepat->volume}}</td>
			<td style="width:150px;" align="right">{{$tender_cepat->pagu_paket}},00</td>
			<td align="center">{{$tender_cepat->jenis_pengadaan}}</td>
			<td align="center">{{$tender_cepat->lokasi}}</td>
			<td align="center">{{$tender_cepat->pegawai}}</td>
		</tr>
		@endforeach
		<tr><td></td>
			<td style="width:200px;"></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr><td></td>
			<td style="width:200px;"><b>Seleksi</b></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@foreach($Seleksi as $key=>$seleksi)
		<tr><td>{{$key+1}}</td>
			<td style="width:200px;">{{$seleksi->paket}}</td>
			<td align="center">{{$seleksi->volume}}</td>
			<td style="width:150px;" align="right">{{$seleksi->pagu_paket}},00</td>
			<td align="center">{{$seleksi->jenis_pengadaan}}</td>
			<td align="center">{{$seleksi->lokasi}}</td>
			<td align="center">{{$seleksi->pegawai}}</td>
		</tr>
		@endforeach
		<tr><td></td>
			<td style="width:200px;"></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr><td></td>
			<td style="width:200px;"><b>Penunjukan Langsung</b></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@foreach($Penunjukan_langsung as $key=>$penunjukan_langsung)
		<tr><td>{{$key+1}}</td>
			<td style="width:200px;">{{$penunjukan_langsung->paket}}</td>
			<td align="center">{{$penunjukan_langsung->volume}}</td>
			<td style="width:150px;" align="right">{{$penunjukan_langsung->pagu_paket}},00</td>
			<td align="center">{{$penunjukan_langsung->jenis_pengadaan}}</td>
			<td align="center">{{$penunjukan_langsung->lokasi}}</td>
			<td align="center">{{$penunjukan_langsung->pegawai}}</td>
		</tr>
		@endforeach
		<tr><td></td>
			<td style="width:200px;"></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		
		<tr><td></td>
			<td style="width:200px;">Paket Non Tender</td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr><td></td>
			<td style="width:200px;"><b>Pengadaan Langsung</b></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@foreach($Pengadaan_langsung as $key=>$pengadaan_langsung)
		<tr><td>{{$key+1}}</td>
			<td style="width:200px;">{{$pengadaan_langsung->paket}}</td>
			<td align="center">{{$pengadaan_langsung->volume}}</td>
			<td style="width:150px;" align="right">{{$pengadaan_langsung->pagu_paket}},00</td>
			<td align="center">{{$pengadaan_langsung->jenis_pengadaan}}</td>
			<td align="center">{{$pengadaan_langsung->lokasi}}</td>
			<td align="center">{{$pengadaan_langsung->pegawai}}</td>
		</tr>
		@endforeach
		<tr><td></td>
			<td style="width:200px;"></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr><td></td>
			<td style="width:200px;"><b>E-Purchasing</b></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@foreach($E_purchasing as $key=>$e_purchasing)
		<tr><td>{{$key+1}}</td>
			<td style="width:200px;">{{$e_purchasing->paket}}</td>
			<td align="center">{{$e_purchasing->volume}}</td>
			<td style="width:150px;" align="right">{{$e_purchasing->pagu_paket}},00</td>
			<td align="center">{{$e_purchasing->jenis_pengadaan}}</td>
			<td align="center">{{$e_purchasing->lokasi}}</td>
			<td align="center">{{$e_purchasing->pegawai}}</td>
		</tr>
		@endforeach
		<tr><td></td>
			<td style="width:200px;"></td>
			<td></td>
			<td style="width:150px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	<tbody>
		
		
	</tbody>
</table>
<script>
		window.print();
	</script>

