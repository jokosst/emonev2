@extends('layout.dashboardLayout')
@section('content')


@if($paket_lelang !=null)
	
	@if($paket_lelang->jenis_proses_lelang == 'e-tendering')
<h2 class="menu__header">Aktifitas Tender APBD Kabupaten Sanggau TA. <?php echo date('Y'); ?></h2>
@elseif($paket_lelang->jenis_proses_lelang == 'non-tender' || $paket_lelang->jenis_proses_lelang == 'e-purchasing')
<h2 class="menu__header">Aktifitas Non Tender APBD Kabupaten Sanggau TA. <?php echo date('Y'); ?></h2>
@else
<h2 class="menu__header">Selamat Datang</h2>
@endif

@else
<h2 class="menu__header">Selamat Datang</h2>
@endif
<div class="row">
<div class="col-md-6">
<div id="grafik-realisasi-detail" style="width: calc( 100% - 50px);"></div>
<div id="table-realisasi-bulanan">
	{{ $table_realisasi_bulanan }}
</div>
</div>
	<div class="col-md-6">
	<div id="grafik-realisasi" style="width: calc( 100% - 50px);"></div>
<div id="table-realisasi" class="table-responsive">
	{{ $table_realisasi }}
</div>
</div>



</div>
	<div class="row" style="margin-top: 15px">
		<div class="col-md-4">
			<div class="box__section">
				<h3>{{Auth::user()->pegawai->pegawai}}</h3>
				<p style="margin-bottom:0;"><b>Nip :</b>{{Auth::user()->pegawai->nip}}</p>
				<p><b>Level :</b> {{ucfirst(Auth::user()->level)}}</p>
			</div>
		</div>
		@if(Auth::user()->level == 'adminskpd')
		<div class="col-md-6">
			<div class="box__section">
				<h3>{{Auth::user()->pegawai->skpd->skpd}}</h3>
				<p style="margin-bottom:0;"><b>Jumlah Program :</b> {{$jmlProgram}}</p>
				<p><b>Jumlah Kegiatan :</b> {{$jmlKegiatan}}</p>
			</div>
		</div>
		<div class="col-md-4">
			<a href="{{URL::to('emonevpanel/copy-realisasi')}}"><div class="box__section">
				<h3>Copy Realisasi</h3>
			</div></a>
		</div>
			@endif
	</div>
	
	
	<!-- <div class="row">
		
	</div>
	<div class="row">
		
	</div> -->

	@if(Auth::user()->level != 'adminskpd')
	<div class="row">
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/skpd')}}"><div class="box__section">
				<h3>Perangkat Daerah</h3>
			</div></a>
		</div>
		<div class="col-md-2">
			<a href="{{URL::to('emonevpanel/lokasi')}}"><div class="box__section">
				<h3>Lokasi</h3>
			</div></a>
		</div>
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/tahun-baru')}}"><div class="box__section">
				<h3>Tahun Baru</h3>
			</div></a>
		</div>
		<div class="col-md-4">
			<a href="{{URL::to('emonevpanel/realisasi')}}"><div class="box__section">
				<h3>Realisasi Keuangan</h3>
			</div></a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<a href="{{URL::to('emonevpanel/anggaran-perubahan')}}"><div class="box__section">
				<h3>Tetapkan Anggaran Perubahan</h3>
			</div></a>
		</div>
	</div>


	<div class="row">
	</div>
	@endif
	
@endsection
@section('script')
<script>
	$( document ).ready( function(){
		$( '#btn-lihat-data' ).click( function(){
			getData();
		});

		$( function(){
			$( '#grafik-realisasi' ).highcharts( highcharts_config );
		});

		$( function(){
			$( '#grafik-realisasi-detail' ).highcharts( detail_highcharts_config );
		})

	});

	function getData(){
		var data = {
						tahun_id: $( '#select-tahun' ).val(),
						skpd_id: $( '#select-skpd' ).val()
					};

		$.ajax({
			url: '{{ URL::to("get-data/realisasi-skpd") }}',
			type: 'post',
			data: data,
			success: function( result ){
				highcharts_config.title.text = result.chart_title;
				highcharts_config.xAxis.categories = $.parseJSON(result.categories);
				highcharts_config.series = $.parseJSON(result.series);

				$( '#grafik-realisasi' ).highcharts( highcharts_config );
				$( '#table-realisasi' ).html( result.table_realisasi );

				detail_highcharts_config.title.text = result.chart_title;
				detail_highcharts_config.series = $.parseJSON(result.series_bulanan);

				$( '#grafik-realisasi-detail' ).highcharts( detail_highcharts_config );
				$( '#table-realisasi-bulanan' ).html( result.table_realisasi_bulanan );
			},
			error: function(){
				console.log( 'error get data!' );
			}
		});
	}

	var highcharts_config = {
		chart: {
		},
		title: {
			text: '{{ $chart_title }}'
		},
		subtitle: {
			text: 'Sumber: SKPD Kabupaten Sanggau'
		},
		xAxis: {
			categories: {{ $categories }}
		},
		yAxis: {
			title: {
				text: 'Realisasi Dalam Persentase (%)',
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}],
			labels: {
				overflow: 'justify',
			}
		},
		legend : {
			// layout: 'horizontal',
			// align: 'bottom',
			// verticalAlign: 'bottom',
			borderWidth: 1
		},
		tooltip: {
			valueSuffix: '%',
		},
		plotOptions: {
			series: {
				// pointPadding: 0,
				// groupPadding: 0.1,
				// pointWidth: 15
			}
		},
		series: {{ $series }}
	};

	var detail_highcharts_config = {
		chart: {
			type: 'column',
		},
		title: {
			text: '{{ $chart_title }}'
		},
		subtitle: {
			text: 'Sumber: SKPD Kabupaten Sanggau'
		},
		xAxis: {
			categories: ['BTL Keu', 'BTL Fis', 'BL Keu', 'BL Fis', 'Total Keu', 'Total Fis']
		},
		yAxis: {
			title: {
				text: 'Data Dalam Persentase (%)',
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}],
			labels: {
				overflow: 'justify',
			},
			stackLabels: {
				enabled: true,
				style: {
					fontWeight: 'bold'
				}
			}
		},
		legend : {
			// layout: 'horizontal',
			// align: 'bottom',
			// verticalAlign: 'bottom',
			borderWidth: 1
		},
		tooltip: {
			valueSuffix: '%',
		},
		plotOptions: {
			series: {
				// pointPadding: 0,
				// groupPadding: 0.1,
				// pointWidth: 15
			},
			column: {
				stacking: 'normal'
			}
		},
		series: {{ $series_bulanan }}
	};
</script>
<script type="text/javascript" src="{{URL::to('source/plugins/HighCharts/js/highcharts.js')}}"></script>
<script type="text/javascript" src="{{URL::to('source/plugins/HighCharts/js/modules/exporting.js')}}"></script>

@stop