<?php

class Apbn extends Eloquent {

	protected $table = 'apbn';
	
	
	public function tahun() {
		return $this->belongsTo('Tahun');
	}
	
	public function program() {
		return $this->belongsTo('Program');
	}
	public function kegiatan() {
		return $this->belongsTo('Kegiatan');
	}
	public function lokasi() {
		return $this->belongsTo('Lokasi');
	}
	public function skpd() {
			return $this->belongsTo('skpd');
		}

	

}

?>