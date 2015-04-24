<?php

class ConfigurationsController extends BaseController {

	public function edit()
	{
		$config = Configuration::all();
		return View::make('admin.config',compact('config'));
	}
	public function update()
	{
		$params = ['tax','wholesale_discount','address_confirm_message','cart_buy_message','cart_order_message','company_name','user_local_address_message','tax_reference','wholesale_discount_reference','money_symbol','email_administrator','email_sales','email_contact','social_facebook','social_twitter','social_instagram','contac_phone','quantities_discount'];

		foreach ($params as $key => $param) {
			DB::table('configurations')
	            ->where('config_name', $param)
	            ->update(array('config_value' => Input::get($param)));
		}
		
		return Redirect::back()->with('notice','Configuracion guardada de forma satisfactoria');;
	}
	/* SETTINGS */
    public function settings()
    {
        return View::make('backend.pages.settings');
    }
    public function settings_post()
    {
        $inputs = Input::all();
        $inputs['app_export'] = Input::has('app_export');
        foreach ($inputs as $key => $value) {
            $setting = Setting::firstOrNew(['key' => $key]);
            $setting->value = $value;
            $setting->save();
        }
        return Redirect::to('/dashboard/settings')->with('alert', ['type' => 'success', 'message' => 'Configuración guardada.']);
    }

}
