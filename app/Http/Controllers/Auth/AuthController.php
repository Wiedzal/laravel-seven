<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Extensions\LaravelLocalization;


class AuthController extends Controller 
{

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

    public function postRegister(Request $request)
    {
        $data = $request->all();

        $model = new User();
        $model->fill($data);
        
        if(!$model->validate())
        {        
            return redirect()->route('auth.register')->withErrors($model->errors());
        };
        
        $model->fill($data);

        User::creating(function ($model) {
            $model->password = bcrypt($model->password);
            unset($model->password_confirmation);
        });
        
        if($model->save())
        {
            $this->auth->login($model);
            
            $locale = $this->auth->user()->lang;
            LaravelLocalization::setLocale($locale);
            
            return redirect(LaravelLocalization::localizeURL('profile', $locale))
                ->with('message', trans('messages.register_success'));
        }
    }

    public function postLogin(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        
        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            $locale = $this->auth->user()->lang;
            LaravelLocalization::setLocale($locale);
            
            return redirect(LaravelLocalization::localizeURL('profile', $locale));
        }
        
        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => trans('auth.failed')]);
    }
}
