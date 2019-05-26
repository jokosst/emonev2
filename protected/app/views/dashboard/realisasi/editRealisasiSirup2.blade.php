@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Realisasi Kegiatan Perangkat Daerah</h2>
	<!-- FORM REALISASI KEGIATAN -->
	<form action="{{URL::to('emonevpanel/realisasi/update')}}" method="POST" role="form" data-toggle="validator">
		<legend>Edit Realisasi</legend>
		<!-- Input SKPD -->
		<div class="row">
			<div class="col-md-12">
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
			<input type="text"class="form-control" value="{{$Skpd->skpd}}" disabled="true">
			<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
		</div>
	</div>
		<!-- End Input SKPD -->
		<!-- Row -->
		
			<!-- Col-md-6 -->
			<div class="col-md-4">
				<!-- Input Tahun -->
				<div class="form-group">
					<label for="">Tahun</label>
					<input type="text"class="form-control" value="{{$Tahun->tahun}}" disabled="true">
					<input type="hidden" name="tahun_id" value="{{$Tahun->id}}">
				</div>
				<!-- End Input Tahun -->
			</div>
			<!-- End Col-md-4 -->
			<!-- Col-md-4 -->
			<div class="col-md-4">
				<!-- Input Bulan -->
				<div class="form-group">
					<label for="">Bulan</label>
					<input type="text"class="form-control" value="{{ Convert::ubah_bulan($realisasi_kegiatan->bulan) }}" disabled="true">
					<input type="hidden" name="bulan" value="{{$realisasi_kegiatan->bulan}}">
				</div>
				<!-- End Input Bulan -->
			</div>
			<!-- End Col-md-4 -->
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Pagu Kegiatan</label>
					<?php
$kegiatan_id_sirup = $kegiatan_id;
$kegiatan = DB::table('kegiatan')->where('kegiatan_id_sirup',$kegiatan_id_sirup)->first();
if (isset($kegiatan->id)) {
	$pagu = $kegiatan->pagu;
	echo"<input type='text' class='form-control' value='Rp. ",number_format($pagu,0,',','.'),"'  disabled>";
	}else{
		echo"<input type='text' class='form-control' value='Rp. ",number_format($pagu_kegiatan,0,',','.'),"'  disabled>";	
	}
			?>
				</div>
			</div>
		
		
			<div class="col-md-12">
		<div class="form-group">
			<label for="">Kegiatan</label>
			<input type="text"class="form-control" value="{{$nama_kegiatan}}" disabled="true">
			<input type="hidden" name="kegiatan_id" value="{{$kegiatan_id}}">
		</div>
		</div>
		<!-- Row -->
		
			<!-- Col-md-6 -->
			<div class="col-md-4">
				<!-- Input Realisasi Fisik -->
				<div class="form-group">
					<label for="">Realisasi Fisik</label>
					<input type="text" name="fisik" value="{{$realisasi_kegiatan->fisik}}" class="form-control" required placeholder="%">
				</div>
				<!-- End Input Realisasi Fisik -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-4">
				<!-- Input Realisasi Keuangan -->
				<div class="form-group">
					<label for="">Realisasi Keuangan</label>
					<input type="text" name="uang" value="{{$realisasi_kegiatan->uang}}" class="form-control" required placeholder="%">
				</div>
				<!-- End Input Realisasi Keuangan -->
			</div>
			<div class="col-md-4">
				<!-- Input Realisasi Keuangan -->
				<div class="form-group">
					<label for="">Realisasi Keuangan</label>
					<input type="text" name="pengeluaran" value="Rp. {{number_format($realisasi_kegiatan->pengeluaran,0,',','.')}}" class="form-control setMoney" required placeholder="Rp">
				</div>
				<!-- End Input Realisasi Keuangan -->
			</div>
			<!-- End Col-md-6 -->
			<input type="hidden" name="id_program" value="{{$id_program}}">
			<button type="submit" class="btn btn-primary btn-lg">Update</button>
		</div>
		<!-- End Row -->
		
	</form>
	<!-- END FORM REALISASI KEGIATAN -->
@endsection

@section('script')

<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<script type="text/javascript">
$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
$("input[name='pengeluaran']").on("keyup", function() {
	var limit = Number($("#limit_anggaran").val().replace(/[Rp.]+/g,""));
	var input = Number($(this).val().replace(/[Rp.]+/g,""));
	if(input > limit) {
		$(".validation-text").fadeIn("fast");
	} else {
		$(".validation-text").fadeOut("fast");
	}
});
</script>

@endsection