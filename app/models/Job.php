<?php


class Job extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	
	public function customer()
	{
		return $this->belongsTo('Customer');
	}
	
	public function notes()
	{
		return $this->hasMany('Note');
	}
	
	public function window_totals()
	{
		return $this->hasMany('Window_total');
	}
	
	public function windows()
	{
		return $this->hasMany('Window');
	}
}