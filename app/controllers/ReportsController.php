<?php

class ReportsController extends \BaseController {

	public function getDates()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		return View::make('admin.reports');
	}
	public function postDates()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		
		$dateStart 	= Input::get('date-start');
		$dateEnd 	= Input::get('date-end');
		$porcent 	= Input::get('porcentual');
		$type 		= Input::get('type');
		

	}
}
