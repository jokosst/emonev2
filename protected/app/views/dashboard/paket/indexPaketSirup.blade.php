@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Daftar Paket Perangkat Daerah</h2>
	 <a href="{{URL::to('emonevpanel/daftar-paket/create')}}" class="btn btn-primary" style="float:right;margin-top:10px;">Tambah Paket</a>
	<!-- FORM SORTIR DAFTAR PAKET -->
	<form action="" class="form-inline" method="GET" role="form" data-toggle="validator">
		<legend>Sortir Kegiatan</legend>
		<!-- Jika Masuk BUKAN sebagai admin skpd maka ada pilihan memilih SKPD -->
		
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
	
			<!-- <div class="form-group">
				<label for="">Perangkat Daerah</label>
				<input type="text" value="" class="form-control" disabled="" style="width:500px;">
				<input type="hidden" name="skpd_id" value="">
			</div> -->

		
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
	    		<td><select class="form-control" data-id="{{$data[0]}}" onchange="actionPaket(this)">
	  				<option value="">--Aksi--</option>
	        	<option value="detail">Detail</option>
	        </select></td>
	    	</tr>
	    	@endforeach
    	
    </tbody>
	</table>
@endsection

@section('script')
	<script type="text/javascript">
		/* Deklarasi Datatable */
		$('#table_id').DataTable();
		/* Fungsi Aksi Kegiatan */
		function actionPaket(el){
			var id = $(el).attr('data-id');
			var action = $(el).val();
			switch(action) {
				case "detail":
					window.location = baseUrl+"/paket_sirup/detail/"+id;
					break;
				case "edit":
					window.location = baseUrl+"/sirup-paket/edit/"+id;
					break;
				case "hapus":
					var c = confirm("Apakah Anda ingin menghapus sirup paket ini?");
					if (c == true) {
						window.location = baseUrl+"/sirup-paket/hapus/"+id;
					}
					return false;
					break;
			}
		}
	</script>
@stop