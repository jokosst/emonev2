@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Kegiatan Perangkat Daerah</h2>

	<!-- FORM SORTIR KEGIATAN -->
	<form action="" class="form-inline" method="GET" role="form" data-toggle="validator" >
		<legend>Sortir Kegiatan</legend>
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
		<div class="form-group">
			<label for="">Program</label>
				<select name="skpd_id" class="form-control" required>
					<option value="">------ Pilih Program ----------</option>
					<!-- Menampilkan Semua SKPD -->
					
				</select>
		</div>
		@else
			<div class="form-group">
				<label for="">Perangkat Daerah</label>
				<input type="text" value="{{$Skpd->skpd}}" disabled="" class="form-control" style="width:500px;">
				<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
			</div>
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
		@endif
		<!-- pilihan memilih Tahun -->
		<div class="form-group">
			<label for="">Tahun</label>
			<select name="tahun_id" class="form-control" required>
				<!-- Menampilkan Semua Tahun -->
				@foreach($Tahun as $tahun)
					<option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
				@endforeach
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
	<!-- END FORM SORTIR KEGIATAN -->

	<!-- Margin Bottom -->
	<div style="margin-bottom:30px;"></div>
	<!-- Menampilkan konten Kegiatan pada tabel -->


	<table id="table_id" class="table table-striped">
	  <thead>
      <tr>
      	<th>No</th>
        <th>Nama Kegiatan</th>
        <th width="150px;">Pagu</th>
        <th width="200px;">Kode Kegiatan</th>
        <th width="120px;">Aksi</th>
      </tr>
    </thead>
    <tbody>
    	@if(isset($idProgram))
     @foreach($Kegiatan as $key=>$data)
	      	<tr>
	      		<td>{{$key + 1}}</td>
	      		<td>{{$data->nama}}</td>
	      		<td>Rp. {{number_format($data->pagu,0,',','.')}}</td>
	      		<td>{{$data->kode_kegiatans}}</td>
	    			
	          <td><a class="btn btn-warning btn-fill btn-xs" href="#" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search"></i> Detail</a>
	          	<a class="btn btn-success btn-fill btn-xs" href="#" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
           
                            
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
	      	</tr>
			@endif
				<script>
                  function confirmSubmit()
                    {
                        var agree=confirm("Apakah anda yakin akan menghapus Data ini?");
                        if (agree)
                            return true ;
                        else
                            return false ;
                    }
                </script>
   
    </tbody>
	</table>
@endsection

@section('script')
<script>
	$('#table_id').DataTable();
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
	
@stop