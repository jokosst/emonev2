@extends('layout.dashboardLayout')

@section('content')

<h2 class="menu__header">Progres Paket Perangkat Daerah</h2>
<a href="{{URL::to('emonevpanel/paket-lelang/create')}}" class="btn btn-primary" style="float:right;margin-top:10px;">Tambah Progres Paket</a>
<!-- Sortir Tahun -->
<div class="form-group form-inline">
	<label for="">Tahun</label>
	<select id="selectGetPaketTable" class="form-control" style="margin-bottom:10px;">
		<option value="">------ Pilih Tahun ----------</option>
		<!-- Menampilkan Semua SKPD -->
		@foreach($Tahun as $tahun)
			<option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
		@endforeach
	</select>
</div>
<!-- End Sortir Tahun -->
<!-- Table Paket Lelang -->
<table id="table_id" class="table table-striped">
	<thead>
  <tr>
  	<th>No</th>
    <th>Nama Kegiatan</th>
    <th>Nama Paket</th>
     <th>Nama Rekanan</th>
    <th>Status Kontrak</th>
    <th>Status</th>
    <th width="120px;">HPS</th>
    <th width="120px;">Aksi</th>
  </tr>
</thead>
<tbody>
	@foreach($Lelang as $key => $lelang)
		<tr>
			<td>{{$key+1}}</td>
    		<td>{{$lelang->kegiatan->kegiatan}}</td>
        <td>{{$lelang->paket->paket}}</td>
    		<td>{{$lelang->rekanan}}</td>
    		<td>{{$lelang->status_kontrak}}</td>
    		<td>{{ucwords(str_replace('-',' ', $lelang->status))}}</td>
    		<td>{{$lelang->hps}}</td>
    		
		<td><a class="btn btn-warning btn-fill btn-xs" href="paket-lelang/detail/{{$lelang->id}}" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search"></i></a>
	          	<a class="btn btn-success btn-fill btn-xs" href="paket-lelang/edit/{{$lelang->id}}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
           <a class="btn btn-danger btn-fill btn-xs" href="paket-lelang/hapus/{{$lelang->id}}" data-toggle="tooltip" data-placement="bottom" title="Hapus" onclick="return confirmSubmit()"><i class="fa fa-trash"></i></a>
                            
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
	
   </tbody>
</table>
<!-- End Table Paket Lelang -->

@endsection

@section('script')
	<script>
	$('#table_id').DataTable();
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@endsection