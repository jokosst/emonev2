@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">APBN</h2>
	<!-- FORM ADD KEGIATAN -->
	
	<form action="{{URL::to('emonevpanel/apbn/update')}}" method="POST" role="form" data-toggle="validator">
		
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Tahun</label>
					<input type="text" class="form-control" value="{{$Tahun->tahun}}" disabled="">
				<input type="hidden" name="tahun_id" value="{{$Tahun->id}}">
				</div>
			</div>
			<div class="col-md-12">
				<!-- Input Sumber Dana -->
				<div class="form-group">
					<label for="">Triwulan</label>
					<select class="form-control" name="triwulan">
						<option value="1" @if($apbn->triwulan == '1') selected @endif>Triwulan I</option>
						<option value="2" @if($apbn->triwulan == '2') selected @endif>Triwulan II</option>
						<option value="3" @if($apbn->triwulan == '3') selected @endif>Triwulan III</option>
						<option value="4" @if($apbn->triwulan == '4') selected @endif>Triwulan IV</option>
					
				  </select>
				</div> <!-- End Input KPA -->
			</div> <!-- End Col-4 -->
			<div class="col-md-12">
				<!-- Input Program -->
				<div class="form-group">
					<label for="">Program</label>
					<select name="program_id" class="form-control selectpicker" data-live-search="true">
						<!-- Jika selain adminskpd tarik data pake json -->
						@if(Auth::user()->level == 'adminskpd')
							@foreach($Program as $program)
								<option @if($program->id == $apbn->program_id) selected @endif value="{{$program->id}}">{{$program->program}}</option>
							@endforeach
						@endif
					</select>
				</div>
				<!-- End Input Program -->
			</div>
		
		<!-- Input Kegiatan -->
		<div class="col-md-12">
		<div class="form-group">
			<label>Kegiatan</label>
			<select name="kegiatan_id" class="form-control selectpicker" data-live-search="true" id="changeKegiatan">
			@if(Auth::user()->level == 'adminskpd')
		@foreach($Kegiatan as $kegiatan)
			<option @if($kegiatan->id == $apbn->kegiatan_id) selected @endif value="{{$kegiatan->id}}">{{$kegiatan->kegiatan}}</option>
		@endforeach
		@endif
		</select>
		</div> <!-- End Input Kegiatan -->
	</div>

	<div class="col-md-12">
				<!-- Input Sumber Dana -->
				<div class="form-group">
					<label for="">Sumber Dana APBN</label>
					<select class="form-control" name="sumber_dana">
						<option value="1" @if($apbn->sumber_dana == 'urusan-bersama') selected @endif>Urusan Bersama</option>
						<option value="1" @if($apbn->sumber_dana == 'tugas-pembantuan') selected @endif>Tugas Pembantuan</option>					
						<option value="1" @if($apbn->sumber_dana == 'dana-alokasi-khusus') selected @endif>Dana Alokasi Khusus</option>
						
				  </select>
				</div> <!-- End Input KPA -->
			</div> <!-- End Col-4 -->
		<!-- Input KPA -->
		
		
			<div class="col-md-12">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">Anggaran</label>
					<input type="text" name="anggaran" class="form-control" required placeholder="Anggaran" data-error="Tidak boleh kosong" value="{{$apbn->anggaran}}">
					<div class="help-block with-errors"></div>
				</div> <!-- End Input Kode Anggaran -->
			</div> <!-- End Col-5 -->
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Total</label>
					<input type="text" id="total" name="total" class="form-control" value="Rp. {{$apbn->total}}">
				</div> <!-- END Input Pagu (Disable) -->
			</div>
			<div class="col-md-12">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">No DIPA</label>
					<input type="text" value="{{$apbn->no_dipa}}" name="no_dipa" class="form-control" required placeholder="No DIPA" data-error="Tidak boleh kosong">
					<div class="help-block with-errors"></div>
				</div> <!-- End Input Kode Anggaran -->
			</div> <!-- End Col-5 -->
		
		<div class="col-md-12">
			<!-- Input lokasi -->
			<div class="form-group">
				<label for="">Lokasi</label>
				<select name="lokasi_id" class="form-control">
					@foreach($Lokasi as $lokasi)
						<option value="{{$lokasi->id}}">{{$lokasi->lokasi}}</option>
					@endforeach
				</select>
			</div>
			<!-- End Input lokasi -->
		</div>
		<div class="col-md-12">
				<!-- Input Sumber Dana -->
				<div class="form-group">
					<label for="">Realisasi</label>
					<select class="form-control" name="realisasi">
						<option value="1" @if($apbn->realisasi == 'realisasi-keuangan') selected @endif>Realisasi Keuangan</option>
						<option value="1" @if($apbn->realisasi == 'realisasi-fisik') selected @endif>Realisasi Fisik</option>
						
				  </select>
				</div> <!-- End Input KPA -->
			</div> <!-- End Col-4 -->
			<div class="col-md-12">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">Kendala</label>
					<textarea type="text" name="kendala" class="form-control" required placeholder="Kendala" data-error="Tidak boleh kosong">{{$apbn->kendala}}</textarea>
					<div class="help-block with-errors"></div>
				</div> <!-- End Input Kode Anggaran -->
			</div> <!-- End Col-5 -->
				<div class="col-md-12">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">Tindak Lanjut</label>
					<textarea type="text" name="tindak_lanjut" class="form-control" required placeholder="Tindak Lanjut" data-error="Tidak boleh kosong">{{$apbn->tindak_lanjut}}</textarea>
					<div class="help-block with-errors"></div>
				</div> <!-- End Input Kode Anggaran -->
			</div> <!-- End Col-5 -->
				<div class="col-md-12">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">Instansi Terkait</label>
					<input type="text" name="instansi_terkait" value="{{$apbn->instansi_terkait}}" class="form-control" required placeholder="Instansi Terkait" data-error="Tidak boleh kosong">
					<div class="help-block with-errors"></div>
				</div> <!-- End Input Kode Anggaran -->
			</div> <!-- End Col-5 -->
			<input type="hidden" name="id" value="{{$apbn->id}}">
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary btn-lg" style="margin-bottom:25px;">Update</button>
			</div>	
		</div><!-- End Row -->
	</form>
	<!-- END FORM ADD KEGIATAN -->
@stop

@section('script')
<!-- Plugin Mask Money -->
<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<!-- Custom -->
<script>
	$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
	$('#total').maskMoney({prefix:'Rp ', thousands:'.', decimal:','});

	$('#changeTahun').change(function() {
		var tahun_id = $(this).val();
		$("input[name='tahun_id']").val(tahun_id);
	});




</script>
@stop