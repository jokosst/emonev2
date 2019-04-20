@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">APBN</h2>
	<!-- FORM ADD KEGIATAN -->
	
	<form action="" method="POST" role="form" data-toggle="validator">
		
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Tahun</label>
					<select class="form-control" id="selectTahunGetProgram">
						@foreach($Tahun as $tahun)
						<option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
						@endforeach
				  </select>
					<input type="hidden" name="tahun_id" id="tahunId" value="{{$tahun_id}}">
				</div>
			</div>
			<input type="hidden" name="skpd_id" value="">
			<div class="col-md-12">
				<!-- Input Sumber Dana -->
				<div class="form-group">
					<label for="">Triwulan</label>
					<select class="form-control" name="triwulan">
						<option value="0">-Pilih-</option>
						<option value="1">Triwulan I</option>						
						<option value="2">Triwulan II</option>
						<option value="3">Triwulan III</option>
						<option value="4">Triwulan IV</option>
						
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
								<option value="{{$program->id}}">{{$program->program}}</option>
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
			<option value="">----- Pilih Kegiatan -----</option>
		@foreach($Kegiatan as $kegiatan)
			<option value="{{$kegiatan->id}}">{{$kegiatan->kegiatan}}</option>
		@endforeach
		</select>
		</div> <!-- End Input Kegiatan -->
	</div>

	<div class="col-md-12">
				<!-- Input Sumber Dana -->
				<div class="form-group">
					<label for="">Sumber Dana APBN</label>
					<select class="form-control" name="sumber_dana">
						<option value="urusan-bersama">Urusan Bersama</option>						
						<option value="tugas-pembantuan">Tugas Pembantuan</option>
						<option value="dana-alokasi-khusus">Dana Alokasi Khusus</option>
						
				  </select>
				</div> <!-- End Input KPA -->
			</div> <!-- End Col-4 -->
		<!-- Input KPA -->
		
		
			<div class="col-md-12">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">Anggaran</label>
					<input type="text" name="anggaran" class="form-control" required placeholder="Anggaran" data-error="Tidak boleh kosong">
					<div class="help-block with-errors"></div>
				</div> <!-- End Input Kode Anggaran -->
			</div> <!-- End Col-5 -->
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Total</label>
					<input type="text" id="total" name="total" class="form-control setMoneyPagu"  placeholder="Total Pagu dari Jenis Belanja">
					<!-- <input type="hidden" name="total"> -->
				</div> <!-- END Input Pagu (Disable) -->
			</div>
			<div class="col-md-12">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">No DIPA</label>
					<input type="text" name="no_dipa" class="form-control" required placeholder="No DIPA" data-error="Tidak boleh kosong">
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
						<option value="realisasi-keuangan">Realisasi Keuangan</option>						
						<option value="realisasi-fisik">Realisasi Fisik</option>
						
				  </select>
				</div> <!-- End Input KPA -->
			</div> <!-- End Col-4 -->
			<div class="col-md-12">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">Kendala</label>
					<textarea type="text" name="kendala" class="form-control" required placeholder="Kendala" data-error="Tidak boleh kosong"></textarea>
					<div class="help-block with-errors"></div>
				</div> <!-- End Input Kode Anggaran -->
			</div> <!-- End Col-5 -->
				<div class="col-md-12">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">Tindak Lanjut</label>
					<textarea type="text" name="tindak_lanjut" class="form-control" required placeholder="Tindak Lanjut" data-error="Tidak boleh kosong"></textarea>
					<div class="help-block with-errors"></div>
				</div> <!-- End Input Kode Anggaran -->
			</div> <!-- End Col-5 -->
				<div class="col-md-12">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">Instansi Terkait</label>
					<input type="text" name="instansi_terkait" class="form-control" required placeholder="Instansi Terkait" data-error="Tidak boleh kosong">
					<div class="help-block with-errors"></div>
				</div> <!-- End Input Kode Anggaran -->
			</div> <!-- End Col-5 -->
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary btn-lg" style="margin-bottom:25px;">Submit</button>
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