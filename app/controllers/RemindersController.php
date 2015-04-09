<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		if(Auth::user()){
			return Redirect::to('/login');
		}else{
	//		return View::make('backend.forgot');
			return View::make('remind');
		}
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$response = Password::remind(Input::only('email'), function($message)
					{ 
						$message->subject('Reinicio de Contraseña')
					});
		switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', 'Hay un error en el correo electrónico o el correo electrónico que proporciono no esta en nuestra base de datos.');

			case Password::REMINDER_SENT:
				return Redirect::back()->with('status', 'Se le ha enviado un correo electrónico, con un link para reiniciar su contraseña.');
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', 'Hay un error en los datos proporcionados.');

			case Password::PASSWORD_RESET:
				return Redirect::to('/login')->with('status','La Contraseña se restableció con éxito.');
		}
	}

}
