@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Paket Tender SKPD</h2>
	<!-- FORM EDIT PAKET LELANG -->
	<form action="{{URL::to('emonevpanel/paket-lelang/update')}}" method="POST" role="form" data-toggle="validator">
		<legend>Edit Paket Tender Perangkat Daerah</legend>
		<!-- Input SKPD -->
		<div class="row">
		<div class="col-md-12">
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
			<input type="text" class="form-control" value="{{$lelang->skpd->skpd}}" disabled="">
			<input type="hidden" value="{{$lelang->skpd->id}}" name="skpd_id">
		</div>
	</div>
		<!-- End Input SKPD -->
		<!-- Row -->
	
			<!-- Col-md-6 -->
			<div class="col-md-12">
				<!-- Input Tahun -->
				<div class="form-group">
					<label for="">Tahun</label>
					<input type="text" class="form-control" value="{{$lelang->tahun->tahun}}" disabled="">
					<input type="hidden" value="{{$lelang->tahun->id}}" name="tahun_id">
				</div>
				<!-- End Input Tahun -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-12">
				<!-- Input Jenis Proses Lelang -->
				<label for="">Jenis Proses Pengadaan</label>
				<select name="jenis_proses_lelang" id="jenis_proses_lelang" class="form-control">
					<option @if($lelang->jenis_proses_lelang == 'e-tendering') selected @endif value="e-tendering">Tender</option>
					<option @if($lelang->jenis_proses_lelang == 'e-purchasing') selected @endif value="e-purchasing">E-Purchasing</option>
					<option  @if($lelang->jenis_proses_lelang == 'non-tender') selected @endif value="non-tender">Non-Tender</option>
				</select>
				<!-- End Input Jenis Proses Lelang -->
			</div>
			<!-- End Col-md-6 -->
	
		<!-- End Row -->
		<!-- Input Kegiatan -->
		<div class="col-md-12">
		<div class="form-group">
			<label for="">Kegiatan</label>
			<input type="text" class="form-control" value="{{$lelang->kegiatan->kegiatan}}" disabled="">
			<input type="hidden" value="{{$lelang->kegiatan->id}}" name="kegiatan_id">
		</div>
	</div>
		<div class="col-md-12">
		<div class="form-group">
			<label for="">Paket</label>
			<select name="paket_id" class="form-control selectpicker" data-live-search="true" id="changePaket">
				@foreach($Paket as $paket)
					<option value="{{$paket->id}}" data-pagu="{{$paket->nilai_pagu_paket}}">{{$paket->paket}}</option>
				@endforeach
			</select>
			<input type="hidden" id="limit_anggaran" value="{{$lelang->paket->nilai_pagu_paket}}">
		</div>
	</div>
		<!-- End Input Daftar Paket -->
		<!-- Row -->
		
			<!-- Col-md-6 -->
			<div class="col-md-12">
				<!-- Input HPS -->
				<div class="form-group" id="hps">
					<label for="">HPS</label>
					<input type="text" name="hps" class="form-control setMoney" required value="{{ "Rp ".number_format($lelang->nilai_hps,0,',','.'); }}">
					<p class="validation-text">Nilai Inputan Melebihi Pagu</p>
				</div>
				<!-- End Input HPS -->
			</div>
			
		<!-- End Row -->
		<!-- Row -->
		
			<!-- Col-md-4 -->
			<div class="col-md-12">
				<!-- Input Produk Akhir -->
				<div class="form-group">
					<label for="">Nomor Kontrak</label>
					<input type="text" name="nomor_kontrak" class="form-control" value="{{$lelang->nomor_kontrak}}" required>
				</div>
				<!-- End Input Produk Akhir -->
			</div>
			<!-- End Col-md-4 -->
			<!-- Col-md-4 -->
			<div class="col-md-12">
				<!-- Input Tempat Daftar -->
				<div class="form-group">
					<label for="">Tanggal BAST</label>
					<input type="text" name="tgl_bast" class="datepicker form-control" value="{{ Convert::tgl_eng_to_ind($lelang->tgl_bast)}}" required>
				</div>
				<!-- End Tempat Daftar -->
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Nomor BAST</label>
					<input type="text" name="nomor_bast" class="form-control" value="{{$lelang->nomor_bast}}" placeholder="Nomor BAST" required>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Realisasi Fisik Paket</label>
					<input type="text" name="realisasi-fisik-paket" class="form-control" value="" placeholder="Realisasi Fisik Paket" required>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Realisasi Keuangan Paket</label>
					<input type="text" name="realisasi-keuangan-paket" value="" class="form-control" placeholder="Realisasi Keuangan Paket" required>
				</div>
			</div>
			<!-- End Col-md-4 -->
			<!-- Col-md-4 -->
			<div class="col-md-12">
				<!-- Input Status -->
				<div class="form-group" id="status1">
					<label for="">Status</label>
					<select name="status" class="form-control" id="status">
						<option @if($lelang->status == 'belum-mengajukan-dokumen-tender') selected @endif value="belum-mengajukan-dokumen-tender">Belum Mengajukan Dokumen Tender</option>
						<option @if($lelang->status == 'lelang-sedang-berjalan') selected @endif value="lelang-sedang-berjalan">Tender Sedang Berjalan</option>
						<option @if($lelang->status == 'lelang-sudah-selesai') selected @endif value="lelang-sudah-selesai">Tender Sudah Selesai</option>
						<option @if($lelang->status == 'lelang-ulang') selected @endif value="lelang-ulang">Tender Ulang</option>
						<option @if($lelang->status == 'verifikasi-dokumen') selected @endif value="verifikasi-dokumen">Verifikasi Dokumen</option>
				  </select>
				</div>
				<!-- End Input Status -->
			</div>
			<!-- End Col-md-4 -->
			<div class="col-md-12">
				<div class="form-group" id="status2">
					<label for="">Status</label>
					<select name="status" class="form-control" id="status21">
						<option @if($lelang->status == 'belum-proses') selected @endif value="belum-proses">Belum Proses</option>
						<option @if($lelang->status == 'proses-sedang-berjalan') selected @endif value="proses-sedang-berjalan">proses sedang berjalan</option>
						<option  @if($lelang->status == 'proses-selesai') selected @endif value="proses-selesai">proses selesai</option>
				  </select>
				</div>
			</div>
		
		
			<div class="col-md-12">
			<div class="form-group" id="rekanan1">
				<label for="">Rekanan</label>
				<input type="text" name="rekanan" value="{{$lelang->rekanan}}" class="form-control">
			</div>
		</div>
	<div class="col-md-12">
			<div class="form-group" id="rekanan2">
				<label for="">Rekanan</label>
				<input type="text" name="rekanan" disabled class="form-control">
			</div>
		</div>
		
			<div class="col-md-12">
				<!-- Input Nilai Kontrak -->
				<div class="form-group">
					<label for="">Nilai Kontrak</label>
					<input type="text" class="form-control setMoney" name="nilai_kontrak" value="{{ "Rp ".number_format($lelang->progres->nilai_kontrak,0,',','.'); }}"  required>
					<p class="validation-text">Nilai Inputan Melebihi Pagu</p>
				</div>
				<!-- End Input Nilai Kontrak -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-12">
			<div class="form-group">
				<label for="">Progres Pekerjaan</label>
				<select name="status_kontrak" id="" class="form-control">
					<option @if($lelang->status_kontrak == 'blt') selected @endif value="blt">Belum </option>
					<option @if($lelang->status_kontrak == 'sdt') selected @endif value="sdt">Sedang Pelaksanaan</option>
					<option @if($lelang->status_kontrak == 'sls') selected @endif value="sls">Selesai</option>
				</select>
			</div>
		</div>
			<!-- End Col-md-6 -->
		
		
			<!-- Col-md-6 -->
			<div class="col-md-12">
				<!-- Input Tanggal Mulai -->
				<div class="form-group">
					<label for="">Tanggal Mulai</label>
					<input type="text" class="datepicker form-control" name="tanggal_mulai" value="{{Convert::tgl_eng_to_ind($lelang->progres->tanggal_mulai)}}" required>
				</div>
				<!-- End Input Tanggal Mulai -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-12">
				<!-- Input Tanggal Selesai -->
				<div class="form-group">
					<label for="">Tanggal Selesai</label>
					<input type="text" class="datepicker form-control" name="tanggal_selesai" value="{{Convert::tgl_eng_to_ind($lelang->progres->tanggal_selesai)}}">
				</div>
				<!-- End Input Tanggal Selesai -->
			</div>
			<!-- End Col-md-6 -->
		
		<!-- End Row -->
		<div class="col-md-12">
		<input type="hidden" name="id" value="{{$lelang->id}}">
		<button type="submit" class="btn btn-primary btn-lg" style="margin-bottom: 10px;">Update</button>
	</div>
	</div>
	</form>
	<!-- END FORM PAKET LELANG -->
@endsection

@section('script')

<!-- Plugin Mask Money -->
<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('source/plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
<!-- Custom -->
<script>
	$('.datepicker').datepicker({
		format: "dd-mm-yyyy"
	});
	$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
	$("select[name='jenis_proses_lelang']").change(function() {
		var jenis = $(this).val();
		if(jenis == 'e-tendering') {
			$("input[name='tempat_daftar']").val("Unit Layanan Pengadaan (ULP)");
		} else if(jenis == 'e-purchasing') {
			$("input[name='tempat_daftar']").val("");
		}
	});
	$('#changePaket').change(function() {
		pagu = $(this).find(':selected').data('pagu');
		$("#limit_anggaran").val(pagu);
	});
	$("input[name='hps']").on("keyup", function() {
		var limit = $('#limit_anggaran').val();
		var input = Number($(this).val().replace(/[Rp.]+/g,""));
		if(input > limit) {
			$(".validation-text").fadeIn("fast");
		} else {
			$(".validation-text").fadeOut("fast");
		}
	});
	/* onjenis proses lelang  */
	$("#status2").hide();
	$("#jenis_proses_lelang").change(function() {
		$("#status2").hide();
		var jenis_proses_lelang = $(this).val();
		if(jenis_proses_lelang == "e-tendering") {
			$("#hps").show();
			$("#status1").show();
			$("#status2").hide();
		} else {
			$("#hps").hide();
			$("#status2").show();
			$("#status1").hide();
		}
	});
	$("#rekanan1").hide();
	$("#status").change(function() {
		
		var status = $(this).val();
		if(status == "lelang-sudah-selesai"){
			$("#rekanan1").show();
			$("#rekanan2").hide();
		}else{
			$("#rekanan2").show();
			$("#rekanan1").hide();
		}
	});
	$("#status21").change(function() {		
		var status = $(this).val();
		if(status == "proses-selesai"){
			$("#rekanan1").show();
			$("#rekanan2").hide();
		}else{
			$("#rekanan2").show();
			$("#rekanan1").hide();
		}
	});
</script>
@stop