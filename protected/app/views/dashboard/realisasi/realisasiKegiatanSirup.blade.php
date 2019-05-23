@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Realisasi Perangkat Daerah</h2>
	<!-- Kita Coba hilangkan,
			 karena sebenarnya ndak perlu, semua sudah di handle oleh proses update
	<a href="{{URL::to('emonevpanel/realisasi/create')}}" class="btn btn-primary" style="float:right;">Tambah Realisasi</a>
	-->
	<!-- Sortir Realisasi -->
	<div class="row">
	<form action="" method="GET" role="form" data-toggle="validator" style="margin-bottom:30px;">
		<div class="col-md-12">
		<legend>Sortir Realisasi</legend>
		<!-- Jika selain adminskpd (root || superadmin) -->
		</div>
		@if(Auth::user()->level != 'adminskpd')
		<div class="col-md-12">
			<div class="form-group">
				<label for="">Perangkat Daerah</label>
				<select name="skpd_id" class="form-control" required >
					<option value="">------ Pilih Perangkat Daerah ----------</option>
					<!-- Menampilkan Semua SKPD -->
					@foreach($Skpd as $skpd)
						<option @if(isset($skpd_id) && $skpd_id == "$skpd->id") selected  @endif value="{{$skpd->id}}">{{$skpd->skpd}}</option>
					@endforeach
				</select>
			</div>
</div>
<div class="form-group">
			<label for="">Program</label>
				<select name="skpd_id" class="form-control" required>
					<option value="">------ Pilih Program ----------</option>
					<!-- Menampilkan Semua SKPD -->
					
				</select>
		</div>
		<!-- Jika adminskpd -->
		@else
		<div class="col-md-12">
			<!-- Menampilkan 1 SKPD -->
			<div class="form-group">
				<input type="text" class="form-control" value="{{$Skpd->skpd}}" disabled>
				<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
			</div>
		</div>
		<div class="col-md-12">
		<div class="form-group">
				<label for="">Program</label>
				<select name="program_id" class="form-control" required>
					<option value="">------ Pilih Program ----------</option>					
					@foreach($Program as $program)
					@if(isset($idProgram))
					<option @if(isset($program->id) && $idProgram == "$program->id") selected  @endif value="{{$program->id}}">{{$program->nama}}</option>
					@else
						<option value="{{$program->id}}">{{$program->nama}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		@endif
		<!-- Row -->
		
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Tahun -->
				<div class="form-group">
					<label for="">Tahun</label>
					<select name="tahun_id" class="form-control" required>
						<option value="">------ Pilih Tahun ----------</option>
						<!-- Menampilkan Semua Tahun -->
						@foreach($Tahun as $tahun)
							<option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Bulan -->
					<div class="form-group">
						<label for="">Bulan</label>
						<select name="bulan" class="form-control" required>
							<option value="">------ Pilih Bulan ----------</option>
							<!-- Menampilkan Semua Bulan -->
							<option @if(isset($bulan) && $bulan == "1") selected  @endif value="1">Januari</option>
							<option @if(isset($bulan) && $bulan == "2") selected  @endif value="2">Februari</option>
							<option @if(isset($bulan) && $bulan == "3") selected  @endif value="3">Maret</option>
							<option @if(isset($bulan) && $bulan == "4") selected  @endif value="4">April</option>
							<option @if(isset($bulan) && $bulan == "5") selected  @endif value="5">Mei</option>
							<option @if(isset($bulan) && $bulan == "6") selected  @endif value="6">Juni</option>
							<option @if(isset($bulan) && $bulan == "7") selected  @endif value="7">Juli</option>
							<option @if(isset($bulan) && $bulan == "8") selected  @endif value="8">Agustus</option>
							<option @if(isset($bulan) && $bulan == "9") selected  @endif value="9">September</option>
							<option @if(isset($bulan) && $bulan == "10") selected  @endif value="10">Oktober</option>
							<option @if(isset($bulan) && $bulan == "11") selected  @endif value="11">November</option>
							<option @if(isset($bulan) && $bulan == "12") selected  @endif value="12">Desember</option>
						</select>
					</div>
				<!-- End Input Bulan -->
			</div>
			<!-- End Col-md-6 -->
		
		<!-- End Row -->
		<div class="col-md-12">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
	</form>
</div>
	<!-- End Sortir Realisasi -->
	<!-- Table Realisasi -->
	<table id="table_id" class="table table-striped">
		<thead>
      <tr>
      	<th>No</th>
        <th>Nama Kegiatan</th>
        <th width="120px;">Pagu</th>
        <th width="120px;">Pengeluaran</th>
        <th width="50px;">Fisik</th>
        <th width="50px;">Keuangan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
	@if(isset($idProgram))
     @foreach($Kegiatan as $key=>$data)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{$data->nama}}</td>
			<td>{{ "Rp ".number_format($data->pagu,0,',','.'); }}</td>
			<?php
			$kegiatan_id = $data->id;
			$realisasi_kegiatan = DB::table('realisasi_kegiatan')->where('kegiatan_id',$kegiatan_id)->first();
			if (isset($realisasi_kegiatan->id)) {
				$pengeluaran = $realisasi_kegiatan->pengeluaran;
				$fisik = $realisasi_kegiatan->fisik;
				$uang = $realisasi_kegiatan->uang;
				 echo"<td>Rp. ",number_format($pengeluaran,0,',','.'),"</td>";
				 echo"<td>",$fisik,"%</td>";
				 echo"<td>",$uang,"%</td>";

			}else{
				 echo"<td>Rp. 0</td><td>0%</td><td>0%</td>";
			}


			?>
			<td><a class="btn btn-warning btn-fill btn-xs" href="realisasi/detail/{{$data->id}}?id_program={{$data->id_program}}&nama_kegiatan={{$data->nama}}&pagu_kegiatan={{$data->pagu}}" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search"></i></a>
	          	<a class="btn btn-success btn-fill btn-xs" href="realisasi/edit/{{$data->id}}?id_program={{$data->id_program}}&nama_kegiatan={{$data->nama}}&pagu_kegiatan={{$data->pagu}}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
           </td> 
		</tr>
	@endforeach	
			@else
			<tr>
	      	<td></td>	
	      	<td></td>
	      	<td></td>
	      	<td></td>
	      	<td></td>
	      	<td></td>
	      	<td></td>
	      	</tr>
			@endif
    </tbody>
	</table>
	<!-- End Table Realisasi -->
@endsection

@section('script')
	<script type="text/javascript">
		/* Deklarasi Datatable */
		$('#table_id').DataTable({"iDisplayLength": 25});
		$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
	</script>
@endsection