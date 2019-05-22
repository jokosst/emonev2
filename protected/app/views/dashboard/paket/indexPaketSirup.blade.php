@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Daftar Paket Perangkat Daerah</h2>
	 <a href="{{URL::to('emonevpanel/daftar-paket/create')}}" class="btn btn-primary" style="float:right;margin-top:10px;">Tambah Paket</a>
	<!-- FORM SORTIR DAFTAR PAKET -->
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
					<option @if(isset($tahun->id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
				@endforeach
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
	<!-- Margin Bottom -->
	<div style="margin-bottom:30px;"></div>
	<!-- Menampilkan konten Daftar Paket pada tabel -->
	<table id="table_id" class="table table-striped">
		<thead>
      <tr>
      	<th>No</th>
      	<th>Kode RUP</th>
        <th>Nama Paket</th>
        <th width="150px;">Pagu RUP</th>
        <th width="200px;">Metode Penyedia</th>
        <th width="200px;">Sumber Dana</th>
        <th width="120px;">Aksi</th>
      </tr>
    </thead>
    <tbody>
	    	@foreach($data_sirup as $key=>$data)
	    	<tr>
	    		<td>{{$key+1}}</td>
	    		<td>{{$data[0]}}</td>
	    		<td>{{$data[1]}}</td>
	    		<td>Rp. {{number_format($data[2])}}</td>
	    		<td>{{$data[3]}}</td>
	    		<td align="center">{{$data[4]}}</td>
	    		<td><a class="btn btn-warning btn-fill btn-xs" href="paket_sirup/detail/{{$data[0]}}" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search"></i>Detail</a>
	          	<a class="btn btn-success btn-fill btn-xs" href="paket_sirup/edit/{{$data[0]}}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i>Edit</a>
          
                            
                               </td> 
	      	</tr>
				@endforeach
				
    	
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