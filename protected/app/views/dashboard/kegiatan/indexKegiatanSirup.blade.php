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
	      		<?php
			$kegiatan_id_sirup = $data->id;
$kegiatan = DB::table('kegiatan')->where('kegiatan_id_sirup',$kegiatan_id_sirup)->first();
if (isset($kegiatan->id)) {
	$pagu = $kegiatan->pagu;
	echo"<td>Rp. ",number_format($pagu,0,',','.'),"</td>";
	}else{
	echo"<td>Rp. ",number_format($data->pagu,0,',','.'),"</td>";	
	}
			?>
	      		<td>{{$data->kode_kegiatans}}</td>
	    			
	          <td><a class="btn btn-warning btn-fill btn-xs" href="#" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search"></i> Detail</a>
	          	<a class="btn btn-success btn-fill btn-xs" href="{{$data->id}}" data-placement="bottom" title="Edit" data-toggle="modal" data-target="#myModal{{$data->id}}"><i class="fa fa-pencil"></i> Edit Pagu</a>
           
                            
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
	@if(isset($idProgram))
@foreach($Kegiatan as $key=>$data)
	<div class="modal fade" id="myModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel" style="color: red;"><center>EDIT PAGU</center></h3>
                  </div>
                  
 <form action="{{URL::to('emonevpanel/kegiatan/updatePagu')}}" method="post" enctype="multipart/form-data">
                  <div class="modal-body col-md-12">
                  <div class="col-md-12">
          <div class="form-group">
              <label>Nilai Pagu</label>
              <?php
			$kegiatan_id_sirup = $data->id;
$kegiatan = DB::table('kegiatan')->where('kegiatan_id_sirup',$kegiatan_id_sirup)->first();
if (isset($kegiatan->id)) {
	$pagu = $kegiatan->pagu;
	echo"<input type='text' name='pagu' class='form-control border-input' id='pagu' value='Rp. ",number_format($pagu,0,',','.'),"'  style='border: 2px solid #009688;'>";
	}else{
		echo"<input type='text' name='pagu' class='form-control border-input' id='pagu' value='Rp. ",number_format($data->pagu,0,',','.'),"'  style='border: 2px solid #009688;'>";	
	}
			?>
          
          </div>
      </div>
      <input type="hidden" name="kegiatan" value="{{$data->nama}}">
      <input type="hidden" name="kode_kegiatan" value="{{$data->kode_kegiatans}}">
      <input type="hidden" name="id" value="{{$data->id}}">
      <input type="hidden" name="id_program" value="{{$data->id_program}}">
                  </div>
                  <div class="modal-footer">
                  	 <button type="submit" name="save" class="btn btn-success btn-fill">Ubah</button>
                    <button type="button" class="btn btn-info btn-fill" data-dismiss="modal">Kembali</button>
                   
                  </div>
                </form>
             
                </div>
              </div>
            </div> <!-- batas modal -->
            @endforeach
            @else
            @endif


@endsection

@section('script')
<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<script>
	$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
	$('#pagu').maskMoney({prefix:'Rp ', thousands:'.', decimal:',',precision:0});
	$('#table_id').DataTable();
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
	
@stop