@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Kegiatan Perangkat Daerah</h2>
	<a href="{{URL::to('emonevpanel/kegiatan/create')}}" class="btn btn-primary" style="float:right;margin-top:10px;">Tambah Kegiatan</a>

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
		@else
			<div class="form-group">
				<label for="">Perangkat Daerah</label>
				<input type="text" value="{{$Skpd->skpd}}" disabled="" class="form-control" style="width:500px;">
				<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
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
      @if(Auth::user()->level == 'adminskpd' || $Kegiatan != "0")
	      @foreach($Kegiatan as $key => $kegiatan)
	      	<tr>
	      		<td>{{$key + 1}}</td>
	      		<td>{{$kegiatan->kegiatan}}</td>
	      		<td> {{ "Rp ".number_format($kegiatan->pagu,0,',','.'); }}</td>
	      		<td>{{$kegiatan->kode_anggaran}}</td>
	    			
	          <td><a class="btn btn-warning btn-fill btn-xs" href="kegiatan/detail/{{$kegiatan->id}}" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search"></i></a>
	          	<a class="btn btn-success btn-fill btn-xs" href="kegiatan/edit/{{$kegiatan->id}}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
           <a class="btn btn-danger btn-fill btn-xs" href="kegiatan/hapus/{{$kegiatan->id}}" data-toggle="tooltip" data-placement="bottom" title="Hapus" onclick="return confirmSubmit()"><i class="fa fa-trash"></i></a>
                            
                               </td> 
	      	</tr>
				@endforeach
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
      @endif
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