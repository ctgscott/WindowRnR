<?php

class Appointment extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	
	public function job()
	{
		return $this->belongsTo('Job');
	}
}
