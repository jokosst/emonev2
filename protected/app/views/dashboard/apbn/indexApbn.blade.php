@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">APBN</h2>
	<a href="{{URL::to('emonevpanel/apbn/create')}}" class="btn btn-primary" style="float:right;margin-top:10px;">Tambah APBN</a>

	<!-- FORM SORTIR KEGIATAN -->
	<form action="" class="form-inline" method="GET" role="form" data-toggle="validator" >
		<legend>Sortir APBN</legend>
	
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
	
		<div class="form-group" style="margin-left: 20px;margin-right: 20px;">
			<label for="">Triwulan</label>
			<select class="form-control" name="triwulan">
				<option value="0">-Pilih-</option>
						<option value="1">I</option>						
						<option value="2">II</option>
						<option value="3">III</option>
						<option value="4">IV</option>
						
				  </select>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	
		
	</form>
	<!-- END FORM SORTIR KEGIATAN -->

	<!-- Margin Bottom -->
	<div style="margin-bottom:30px;padding-top: 10px"></div>
	<!-- Menampilkan konten Kegiatan pada tabel -->


	<table id="table_id" class="table table-striped">
	  <thead>
      <tr>
      	<th>No</th>
        <th>Kegiatan</th>
        <th>Program</th>
        <th>Anggaran</th>
        <th>Lokasi</th>
        <th width="120px;">Aksi</th>
      </tr>
    </thead>
    <tbody>
     
	      	<tr>
	      		<td></td>
	      		<td></td>
	      		<td></td>
	      		<td></td>
	      		<td></td>
	    			<td><select class="form-control" data-id="" onchange="actionKegiatan(this)">
	    				<option value="">--Aksi--</option>
	          	<option value="detail">Detail</option>
	          	<option value="edit">Edit</option>
	          	<option value="hapus">Hapus</option>
	          </select></td>
	      	</tr>
				
     
    </tbody>
	</table>
@endsection

@section('script')
	<script type="text/javascript">
		/* Deklarasi Datatable */
		$('#table_id').DataTable();
		/* Fungsi Aksi Kegiatan */
		function actionKegiatan(el){
			var id = $(el).attr('data-id');
			var action = $(el).val();
			switch(action) {
				case "detail":
					window.location = baseUrl+"/apbn/detail/"+id;
					break;
				case "edit":
					window.location = baseUrl+"/apbn/edit/"+id;
					break;
				case "hapus":
					var c = confirm("Apakah Anda ingin menghapus apbn ini?");
					if (c == true) {
						window.location = baseUrl+"/apbn/hapus/"+id;
					}
					return false;
					break;
			}
		}
	</script>
@stop