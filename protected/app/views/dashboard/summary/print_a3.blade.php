<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
td{
	padding-right: 5px;
	padding-left: 5px;
}
</style>
<!-- END FORM SORTIR SUMMARY -->
<h2>Format A3</h2>
<table>
	<thead>
		<tr>
			<th width="200px" rowspan="3">Lokasi Kegiatan (Kabupaten / Kecamatan)</th>
			<th rowspan="2" colspan="2">Total</th>
			<th colspan="8">Sumber Dana</th>
			<th colspan="12">Metode Pengadaan (BL Non Pegawai)</th>
		</tr>
		<tr>
			<th colspan="2">APBD</th>
			<th colspan="2">APBN</th>
			<th colspan="2">APBD-P</th>
			<th colspan="2">APBN-P</th>
			<th colspan="2">LU/SU/LT</th>
			<th colspan="2">LS/PML/SS</th>
			<th colspan="2">PL</th>
			<th colspan="2">SY</th>
			<th colspan="2">PK/E-Purchasing</th>
			<th colspan="2">SWA</th>
		</tr>
		<tr>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><strong>Total Pagu Paket</strong></td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlPaket,2))  }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguPaket) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlAPBD,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($total_paket->paguAPBD),2))}}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlAPBN,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($total_paket->paguAPBN),2))}}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlAPBD_P,2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($total_paket->paguAPBD_P),2))}}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlAPBN_P,2))  }}</td>
			<td>{{str_replace('.', ',', number_format((float)Summary::ubah_milyar($total_paket->paguAPBN_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlMetode1,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($total_paket->paguMetode1),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlMetode2,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($total_paket->paguMetode2),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlMetode3,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($total_paket->paguMetode3),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlMetode4,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($total_paket->paguMetode4),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlMetode5,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($total_paket->paguMetode5),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$total_paket->jmlMetode6,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($total_paket->paguMetode6),2)) }}%</td>
		</tr>
		<tr>
			<td><strong>Belanja Tidak Langsung</strong></td>
			<td>{{ str_replace('.', ',', number_format((float)$BTL->jmlPaket,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BTL->paguPaket),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BTL->jmlAPBD,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BTL->paguAPBD),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BTL->jmlAPBN,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BTL->paguAPBN),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BTL->jmlAPBD_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BTL->paguAPBD_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BTL->jmlAPBN_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BTL->paguAPBN_P),2)) }}%</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		<tr>
			<td>A. Pegawai</td>
			<td>{{ str_replace('.', ',', number_format((float)$BTLP->jmlPaket,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BTLP->paguPaket),2))}}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BTLP->jmlAPBD,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BTLP->paguAPBD),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BTLP->jmlAPBN,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BTLP->paguAPBN),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BTLP->jmlAPBD_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BTLP->paguAPBD_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BTLP->jmlAPBN_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BTLP->paguAPBN_P),2)) }}%</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		<tr>
			<td><strong>Belanja Langsung (BL)</strong></td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlPaket,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguPaket),2))}}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlAPBD,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguAPBD),2))}}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlAPBN,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguAPBN),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlAPBD_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguAPBD_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlAPBN_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguAPBN_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlMetode1,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguMetode1),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlMetode2,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguMetode2),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlMetode3,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguMetode3),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlMetode4,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguMetode4),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlMetode5,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguMetode5),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BL->jmlMetode6,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BL->paguMetode6),2)) }}%</td>
		</tr>
		<tr>
			<td>Belanja Pegawai</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlPaket,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguPaket),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlAPBD,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguAPBD),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlAPBN,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguAPBN),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlAPBD_P ,2))}}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguAPBD_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlAPBN_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguAPBN_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlMetode1,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguMetode1),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlMetode2,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguMetode2),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlMetode3,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguMetode3),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlMetode4,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguMetode4),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlMetode5,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguMetode5),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLP->jmlMetode6,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLP->paguMetode6),2)) }}%</td>
		</tr>
		<tr>
			<td>Belanja Non Pegawai</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlPaket,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguPaket),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlAPBD,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguAPBD),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlAPBN,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguAPBN),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlAPBD_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguAPBD_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlAPBN_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguAPBN_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlMetode1,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguMetode1),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlMetode2,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguMetode2),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlMetode3,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguMetode3),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlMetode4,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguMetode4),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlMetode5,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguMetode5),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$BLNP->jmlMetode6,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($BLNP->paguMetode6),2)) }}%</td>
		</tr>
		@foreach($Lokasi as $key => $lokasi)
		<tr>
			<td><strong>{{$key}}</strong></td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlPaket,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguPaket),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlAPBD,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguAPBD),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlAPBN,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguAPBN),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlAPBD_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguAPBD_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlAPBN_P,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguAPBN_P),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlMetode1,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguMetode1),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlMetode2,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguMetode2),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlMetode3,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguMetode3),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlMetode4,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguMetode4),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlMetode5,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguMetode5),2)) }}%</td>
			<td>{{ str_replace('.', ',', number_format((float)$lokasi[0]->jmlMetode6,2)) }}</td>
			<td>{{ str_replace('.', ',', number_format((float)Summary::ubah_milyar($lokasi[0]->paguMetode6),2)) }}%</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
		window.print();
	</script>