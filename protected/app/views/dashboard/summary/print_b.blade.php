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
<h2>Format B</h2>
<!-- END FORM SORTIR SUMMARY -->
<div class="keterangan-warna" style="margin-bottom:20px;">
	<h4>Keterangan Warna</h4>
	<span style="background:#2196F3">B: Lelang Sudah Selesai</span>
	<span style="background:#009688">H: Lelang Sedang Berjalan</span>
	<span style="background:#FFAB00">K: Belum Siap Lelang</span>
	<span style="background:#795548">C: Lelang Ulang</span>
	<span style="background:#F44336">M: Lelang Gagal</span>
</div>
<table>
	<thead>
		<tr>
			<th rowspan="2" style="width:150px;">Paket Pekerjaan</th>
			<th rowspan="2" style="width: 130px">Pagu <br /> Rp.</th>
			<th rowspan="2" style="width: 130px">HPS <br /> Rp.</th>
			<th rowspan="2">Kualifikasi <br /> (Kecil / Non Kecil)</th>
			<th rowspan="2">Kode Bidang / <br /> Sub Bidang</th>
			<th rowspan="2">Produk Akhir</th>
			<th rowspan="2">Alamat <br />Pendaftaran</th>
			<th rowspan="2" style="width: 80px">Detail<br />Lokasi</th>
			<th rowspan="2">Nama KPA/PPK/PA</th>
			<th rowspan="2">Metode Pengadaan</th>
			<th rowspan="2" style="width:50px;">Sumber Dana</th>
			<th rowspan="2" style="width: 80px">Proses <br> Pengadaan</th>
			<th colspan="5">Status</th>
		</tr>
		<tr>
			<th style="background:#2196F3; color:white;">B</th>
			<th style="background:#009688; color:white;">H</th>
			<th style="background:#FFAB00; color:white;">K</th>
			<th style="background:#795548; color:white;">C</th>
			<th style="background:#F44336; color:white;">M</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><strong>A. Konstruksi (K)</strong></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@foreach($konstruksi as $key => $value)
		<tr>
			<td>{{$value->paket}}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_pagu_paket,2,',','.'); }}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_hps,2,',','.')}}</td>
			<td>{{ Convert::ubah_tanda_strip($value->kualifikasi_lelang) }}</td>
			<td>{{ $value->kode_bidang }}</td>
			<td>{{ $value->produk_akhir }}</td>
			<td>{{ $value->tempat_daftar }}</td>
			<td>{{ Convert::ubah_kab($value->lokasi) }}</td>
			<td>{{ $value->pegawai }}</td>
			<td>{{ Convert::ubah_tanda_strip($value->metode) }}</td>
			<td>{{ $value->sumber_dana }}</td>
			<td>{{ $value->jenis_proses_lelang}}</td>
			<td>@if($value->status == 'lelang-sudah-selesai') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-sedang-berjalan') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'belum-siap-lelang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-ulang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-gagal') <i class="fa fa-check"></i> @else - @endif</td>
		</tr>
		@endforeach
		<tr>
			<td><strong>B. Barang (B)</strong></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@foreach($barang as $key => $value)
		<tr>
			<td>{{$value->paket}}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_pagu_paket,2,',','.'); }}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_hps,2,',','.')}}</td>
			<td>{{ Convert::ubah_tanda_strip($value->kualifikasi_lelang) }}</td>
			<td>{{ $value->kode_bidang }}</td>
			<td>{{ $value->produk_akhir }}</td>
			<td>{{ $value->tempat_daftar }}</td>
			<td>{{ Convert::ubah_kab($value->lokasi) }}</td>
			<td>{{ $value->pegawai }}</td>
			<td>{{ Convert::ubah_tanda_strip($value->metode) }}</td>
			<td>{{ $value->sumber_dana }}</td>
			<td>{{ $value->jenis_proses_lelang}}</td>
			<td>@if($value->status == 'lelang-sudah-selesai') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-sedang-berjalan') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'belum-siap-lelang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-ulang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-gagal') <i class="fa fa-check"></i> @else - @endif</td>
		</tr>
		@endforeach
		<tr>
			<td><strong>C. Konsultasi (S)</strong></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@foreach($konsultan as $key => $value)
		<tr>
			<td>{{$value->paket}}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_pagu_paket,2,',','.'); }}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_hps,2,',','.')}}</td>
			<td>{{ Convert::ubah_tanda_strip($value->kualifikasi_lelang) }}</td>
			<td>{{ $value->kode_bidang }}</td>
			<td>{{ $value->produk_akhir }}</td>
			<td>{{ $value->tempat_daftar }}</td>
			<td>{{ Convert::ubah_kab($value->lokasi) }}</td>
			<td>{{ $value->pegawai }}</td>
			<td>{{ Convert::ubah_tanda_strip($value->metode) }}</td>
			<td>{{ $value->sumber_dana }}</td>
			<td>{{ $value->jenis_proses_lelang}}</td>
			<td>@if($value->status == 'lelang-sudah-selesai') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-sedang-berjalan') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'belum-siap-lelang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-ulang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-gagal') <i class="fa fa-check"></i> @else - @endif</td>
		</tr>
		@endforeach
		<tr>
			<td><strong>D. Jasa Lainnya (J)</strong></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@foreach($lainnya as $key => $value)
		<tr>
			<td>{{$value->paket}}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_pagu_paket,2,',','.'); }}</td>
			<td align="right">{{ "Rp ".number_format($value->nilai_hps,2,',','.')}}</td>
			<td>{{ Convert::ubah_tanda_strip($value->kualifikasi_lelang) }}</td>
			<td>{{ $value->kode_bidang }}</td>
			<td>{{ $value->produk_akhir }}</td>
			<td>{{ $value->tempat_daftar }}</td>
			<td>{{ Convert::ubah_kab($value->lokasi) }}</td>
			<td>{{ $value->pegawai }}</td>
			<td>{{ Convert::ubah_tanda_strip($value->metode) }}</td>
			<td>{{ $value->sumber_dana }}</td>
			<td>{{ $value->jenis_proses_lelang}}</td>
			<td>@if($value->status == 'lelang-sudah-selesai') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-sedang-berjalan') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'belum-siap-lelang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-ulang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-gagal') <i class="fa fa-check"></i> @else - @endif</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
		window.print();
	</script>