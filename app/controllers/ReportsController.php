<?php

class ReportsController extends \BaseController {

	public function getDates()
	{
		return View::make('admin.reports');
	}
	public function get_Dates($date1,$date2=null)
	{
				
	}
	
	public function postDates()
	{
		$stDate = Input::get('first-date');
		$ndDate = Input::get('second-date');

		
	}
}
