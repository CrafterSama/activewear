<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Configuration extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'configurations';

	public static function getIva()
	{
		$value = Configuration::where('config_name','=','tax')->pluck('config_value');
		return $value;
	}

	public static function getDiscount()
	{
		$value = Configuration::where('config_name','=','wholesale_discount')->pluck('config_value');
		return $value;
	}

	public static function getMayor()
	{
		$value = Configuration::where('config_name','=','wholesaling')->pluck('config_value');
		return $value;
	}
	public static function getCompanyName()
	{
		$value = Configuration::where('config_name','=','company_name')->pluck('config_value');
		return $value;

	}
	public static function getBuyMessage()
	{
		$value = Configuration::where('config_name','=','cart_buy_message')->pluck('config_value');
		return $value;

	}
	public static function getOrderMessage()
	{
		$value = Configuration::where('config_name','=','cart_order_message')->pluck('config_value');
		return $value;

	}
	public static function getUserLocalAddress()
	{
		$value = Configuration::where('config_name','=','user_local_address_message')->pluck('config_value');
		return $value;

	}
	public static function getAddressConfirmMessage()
	{
		$value = Configuration::where('config_name','=','address_confirm_message')->pluck('config_value');
		return $value;

	}
	public static function getTaxReference()
	{
		$value = Configuration::where('config_name','=','tax_reference')->pluck('config_value');
		return $value;

	}
	public static function getWholesaleDiscountReference()
	{
		$value = Configuration::where('config_name','=','wholesale_discount_reference')->pluck('config_value');
		return $value;

	}
	public static function getMoneySymbol()
	{
		$value = Configuration::where('config_name','=','money_symbol')->pluck('config_value');
		return $value;

	}
	public static function getAdminEmail()
	{
		$value = Configuration::where('config_name','=','email_administrator')->pluck('config_value');
		return $value;

	}
	public static function getSalesEmail()
	{
		$value = Configuration::where('config_name','=','email_sales')->pluck('config_value');
		return $value;

	}
	public static function getContactEmail()
	{
		$value = Configuration::where('config_name','=','email_contact')->pluck('config_value');
		return $value;

	}
	public static function getServiceEmail()
	{
		$value = Configuration::where('config_name','=','email_service')->pluck('config_value');
		return $value;

	}

}