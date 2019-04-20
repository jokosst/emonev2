@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail Daftar Paket (SIRUP)</h2>
	
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-2">
				<p><b>Kode RUP</b></p>
				<p><b>Nama Paket </b></p>
				<p><b>KLDI</b></p>
				<p><b>Satuan Kerja</b></p>
				<p><b>Tahun Anggaran</b></p>
				<p><b>Lokasi Pekerjaan</b></p>
				<p><b>Volume</b></p>
				<p><b>Deskripsi</b></p>
				<p><b>Spesifikasi</b></p>
				<p><b>Produk Dalam Negri</b></p>
				<p><b>Usaha Kecil</b></p>
				<p><b>Pra DIPA/DIPA</b></p>
				<p><b>MAK</b></p>
				<p><b>Jenis Pengadaan</b></p>
				<p><b>Jumlah Pagu</b></p>
				<p><b>Pemilihan Penyedia</b></p>
				<p><b>Bulan Pekerjaan Akhir</b></p>
				<p><b>Bulan Pekerjaan Mulai</b></p>
				<p><b>Bulan Pemilihan Akhir</b></p>
				<p><b>Bulan Pemilihan Mulai</b></p>
				<p><b>Tanggal Perbarui </b></p>
			</div>
			<div class="col-md-10">
				<p><span>:</span> {{$kode_urp}}</p>
				<p><span>:</span> {{$nama_paket}}</p>
				<p><span>:</span> {{$kldi}}</p>
				<p><span>:</span> {{$satuan_kerja}}</p>
				<p><span>:</span> {{$tahun_anggaran}}</p>
				<p><span>:</span> {{substr($lokasi_pekerjaan, 65)}}</p>
				<p><span>:</span> {{$volume}}</p>
				<p><span>:</span> {{$deskripsi}}</p>
				<p><span>:</span> {{$spesifikasi}}</p>
				<p><span>:</span> {{$produk_d_negeri}}</p>
				<p><span>:</span> {{$usaha_kecil}}</p>
				<p><span>:</span> {{$pra_dipa_dpa}}</p>
				<p><span>:</span> {{substr($sumber_dana, 180,-58)}}</p>
				<p><span>:</span> {{$jenis_pengadaan}}</p>
				<p><span>:</span> Rp. {{number_format($jumlah_pagu)}}</p>
				<p><span>:</span> {{$pemilihan_penyedia}}</p>
				<p><span>:</span> {{$bulan_pekerjaan_akhir}}</p>
				<p><span>:</span> {{$bulan_pekerjaan_mulai}}</p>
				<p><span>:</span> {{$bulan_pemilihan_akhir}}</p>
				<p><span>:</span> {{$bulan_pemilihan_mulai}}</p>
				<p><span>:</span> {{$tanggal_perbarui}}</p>
			</div>
			
		</div>
	</div>
@endsection