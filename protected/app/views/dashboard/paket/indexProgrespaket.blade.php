@extends('layout.dashboardLayout')

@section('content')

<h2 class="menu__header">Progres Paket Perangkat Daerah</h2>
<!-- <a href="{{URL::to('emonevpanel/paket-lelang/create')}}" class="btn btn-primary" style="float:right;margin-top:10px;">Tambah Progres Paket</a> -->
<!-- Sortir Tahun -->
<form action="" class="form-inline" method="GET" role="form" data-toggle="validator">
    <!-- Jika Masuk BUKAN sebagai admin skpd maka ada pilihan memilih SKPD -->
    @if(Auth::user()->level != 'adminskpd')
    <div class="form-group">
      <label for="">Perangkat Daerah</label>
        <select name="satker" class="form-control" required>
          <option value="">------ Pilih Perangkat Daerah  ----------</option>
          <!-- Menampilkan Semua SKPD -->
          @foreach($data_satker as $data)
            <option @if(isset($satker) && $satker == "$data[0]") selected  @endif value="{{$data[0]}}">{{$data[1]}}</option>
          @endforeach
        </select>
    </div>
  @else
      <div class="form-group">
      <label for="">Perangkat Daerah</label>
        <select name="satker" class="form-control" disabled>
          <!-- Menampilkan Semua SKPD -->
          @foreach($data_satker as $data)
            <option @if(isset($satker) && $satker == "$data[0]") selected  @endif value="{{$data[0]}}">{{$data[1]}}</option>
          @endforeach
        </select>
    </div>

    @endif

    
    <!-- Jika masuk sebagai admin skpd maka ada pilihan memilih Tahun -->
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
<!-- End Sortir Tahun -->
<!-- Table Paket Lelang -->
<table id="table_id" class="table table-striped">
	<thead>
  <tr>
  	<th>No</th>
    <th>ID</th>
    <th>Nama Kegiatan</th>
    <th>Nama Paket</th>
     <th>Nama Rekanan</th>
    <th>Status</th>
    <th width="120px;">HPS</th>
    <th width="120px;">Aksi</th>
  </tr>
</thead>
<tbody>
	@foreach($data_sirup as $key=>$data)
		<tr>
			<td>{{$key+1}}</td>
    		<td>{{$data[0]}}</td>
        <td></td>
        <td>{{$data[1]}}</td>
<?php
        $paket_id = $data[0];
        $paket_lelang = DB::table('paket_lelang')->where('paket_id',$paket_id)->first();
    		       
        if (isset($paket_lelang->id)) {
          $status = $paket_lelang->status;
           $rekanan = $paket_lelang->rekanan;
          echo"<td>",$rekanan,"</td>";
          echo"<td>",ucfirst(str_replace('-', ' ',$status)),"</td>";
        }else{
          echo"<td>-</td><td>-</td>";
        }
        ?>  
       
    		<td>Rp. {{number_format($data[2])}}</td>
    		
		<td><a class="btn btn-warning btn-fill btn-xs" href="progres-paket/detail/{{$data[0]}}" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search"></i></a>
	          	<a class="btn btn-success btn-fill btn-xs" href="progres-paket/edit/{{$data[0]}}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
           
                            
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