@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Program Perangkat Daerah</h2>
	



	<!-- FORM EDIT PROGRAM -->
	<form action="#" method="POST" data-toggle="validator" id="formEditProgram" style="display:none;">
		<legend style="padding-bottom:10px;">Edit Program <i class="fa fa-times icon__close"></i></legend>
		<!-- Input SKPD -->
		<input type="hidden" id="inputEditID" name="id">
		<div class="form-group">
			<label for="">Program</label>
			<input type="text" name="program" id="inputEditProgram" class="form-control" required placeholder="Nama Program">
		</div>

		<button type="submit" class="btn btn-primary btn-lg" style="margin-top: 20px;margin-bottom:30px;">Edit</button>
	</form>

	<!-- FORM SORTIR PROGRAM -->
	<form action="" class="form-inline" method="GET" role="form" data-toggle="validator" style="margin-bottom:20px;">
		<legend>Sortir Program</legend>
		<!-- Jika Masuk sebagai Root || superadmin ada memilih skpd-->
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
				<input type="text" class="form-control" value="{{$Skpd->skpd}}" style="width:500px;" disabled="">
				<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
			</div>
		@endif
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
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>	

	

	<!-- Menampilkan konten Program pada tabel -->
	<table id="table_id" class="table table-striped">
	  <thead>
      <tr>
      	<th>No</th>
        <th>Nama Program</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    	 @if(Auth::user()->level == 'adminskpd' || $data_sirup != "0")
     @foreach($data_sirup as $key=>$data)
	      	<tr>
	      		<td>{{$key + 1}}</td>
	      		<td>{{$data->nama}}</td>
	          	 <td>
	        <a class="btn btn-success btn-fill btn-xs btnEditProgram" href="#" data-id="{{$data->id}}" data-program="{{$data->nama}}" data-toggle="tooltip" data-placement="bottom" title="Edit" onclick="editProgram(this)"><i class="fa fa-pencil"></i> EDIT</a>
           
                            
                               </td> 
	      	</tr>
				@endforeach
				
			@endif	
    
    </tbody>
	</table>
@stop

@section('script')
<script>
	$('#table_id').DataTable();
	/* Button Tambah Program */
		$("#btnAddProgram").click(function() {
			$("#formAddProgram").slideDown(500);
		});
		$(".icon__close").click(function() {
			$("#formAddProgram, #formEditProgram").slideUp();
		});
	
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});

function editProgram(el){
			$("#formEditProgram").slideDown(500);
			var id = $(el).attr('data-id');
			var program = $(el).attr('data-program');
			$("#inputEditID").val(id);
			$("#inputEditProgram").val(program);

			$("html,body").animate({ scrollTop: 0}, "slow");
		}
</script>
	
@stop