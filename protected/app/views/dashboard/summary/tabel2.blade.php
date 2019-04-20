@extends('layout.dashboardLayout')

@section('content')

<style>
	#table-summary {
		font-size: 12px;
	}
</style>

<h2 class="menu__header">Tabel Paket Perkecamatan</h2>
<!-- FORM SORTIR SUMMARY -->
<form action="" style="margin-bottom: 30px;" class="form-inline" method="GET" role="form" data-toggle="validator">

      
  <legend>Sortir Summary</legend>
  <!-- Jika Masuk BUKAN sebagai admin skpd maka ada pilihan memilih SKPD -->
  
  @if(Auth::user()->level != 'adminskpd')
  
  <div class="form-group">
    <label for="">Perangkat Daerah</label>
      <select name="skpd_id" class="form-control" required>
        <option value="">------ Pilih Perangkat Daerah ----------</option>
        <!-- Menampilkan Semua SKPD -->
        @foreach($Skpd as $skpd)
          <option @if(isset($skpd_id) && $skpd_id == "$skpd->id") selected  @endif value="{{$skpd->id}}">{{$skpd->skpd}}</option>
        @endforeach
      </select>
  </div>


  @else
  
    <div class="form-group">
      <label for="">Perangkat Daerah</label>
    <input type="text" value="{{$Skpd->skpd}}" disabled class="form-control" style="width:500px;">
      <input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
    </div>
  
  @endif
  <!-- pilihan memilih Tahun -->
  
  <div class="form-group">
    <label for="">Tahun</label>
    <select name="tahun_id" class="form-control" required>
      <option value="">------ Pilih Tahun ----------</option>
      <!-- Menampilkan Semua Tahun -->
      @foreach($Tahun as $tahun)
        <option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
      @endforeach
    </select>
  


<button type="submit" name="pilihan" value="sortir" class="btn btn-primary">Submit</button>
<button type="submit" name="pilihan" value="print" class="btn btn-warning" ><i class="fa fa-print"></i> Print</button>
</div>
</form>
<!-- END FORM SORTIR SUMMARY -->
<table class="table table-striped" border="1" id="table-summary">
	<thead>
		<tr>
			<th rowspan="2">No</th>
			 <th rowspan="2">Kecamatan / Nama Paket </th>
	        <th rowspan="2" style="width: 130px">Pagu (Rp)</th>
	        <th colspan="6">Tender</th>
	        <th colspan="3">Non Tender</th>
	        <th rowspan="2">Nama KPA/PA/PPK</th>
	       
		</tr>
		<tr>
			<th>BMDT</th>
			<th>VD</th>
			<th>TSB</th>
			<th>TS</th>
			<th>TU</th>
			<th>TG</th>
			<th>BP</th>
			<th>P</th>
			<th>PS</th>
		</tr>
		<tr>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>6</th>
			<th>7</th>
			<th>8</th>
			<th>9</th>
			<th>10</th>
			<th>11</th>
			<th>12</th>
			<th>13</th>
				
		</tr>
	</thead>
	<tbody>
		@foreach($summary as $key => $value)
		<tr>
			<td></td>
			<td><b>{{$key}}</b></td>
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
			<td></td>
</tr>
@for($x = 0; $x < count($value); $x ++)
<tr>
			<td>{{$x+1}}</td>
			<td>{{$value[$x]->paket}}</td>
			<td align="right">{{$value[$x]->pagu_paket}},00</td>
			<td>
				@if($value[$x]->status == 'belum-mengajukan-dokumen-tender')
				<b>&#8730;</b>
				@endif
			</td>
			<td>@if($value[$x]->status == 'verifikasi-dokumen')
				<b>&#8730;</b>
				@endif</td>
			<td>@if($value[$x]->status == 'lelang-sedang-berjalan')
				<b>&#8730;</b>
				@endif</td>
			<td>@if($value[$x]->status == 'lelang-sudah-selesai')
				<b>&#8730;</b>
				@endif</td>
			<td>@if($value[$x]->status == 'lelang-ulang')
				<b>&#8730;</b>
				@endif</td>
			<td>@if($value[$x]->status == 'lelang-gagal')
				<b>&#8730;</b>
				@endif</td>
			<td>@if($value[$x]->status == 'belum-proses')
				<b>&#8730;</b>
				@endif</td>
			<td>@if($value[$x]->status == 'proses-sedang-berjalan')
				<b>&#8730;</b>
				@endif</td>
			<td>@if($value[$x]->status == 'proses-selesai')
				<b>&#8730;</b>
				@endif</td>
			<td>{{ $value[$x]->pegawai }}</td>
</tr>
@endfor
		@endforeach

		
	</tbody>

</table>
<h5>Keterangan :</h5>
<table>
	<tr>
	<td>BMDT</td>
	<td>=</td>
	<td>Belum Mengajukan Dokumen Tender</td>
</tr>
<tr>
	<td>VD</td>
	<td>=</td>
	<td>Verifikasi Dokumen</td>
</tr>
<tr>
	<td>TSD</td>
	<td>=</td>
	<td>Tender Sedang Berjalan</td>
</tr>
<tr>
	<td>TS</td>
	<td>=</td>
	<td>Tender Selesai</td>
</tr>
<tr>
	<td>TU</td>
	<td>=</td>
	<td>Tender Ulang</td>
</tr>
<tr>
	<td>TG</td>
	<td>=</td>
	<td>Tender Gagal</td>
</tr>
<tr>
	<td>BP</td>
	<td>=</td>
	<td>Belum Proses</td>
</tr>
<tr>
	<td>P</td>
	<td>=</td>
	<td>Proses Sedang Berjalan</td>
</tr>
<tr>
	<td>PS</td>
	<td>=</td>
	<td>Proses Selesai</td>
</tr>
</table>
@endsection