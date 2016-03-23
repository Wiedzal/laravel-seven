<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;


class ProfileController extends Controller {
    
    protected $auth;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('auth');
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit()
    {
        $user = $this->auth->user();
        return view('profile/index', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $user = $this->auth->user();
        $model = User::find($user->id);
        
        $data = $request->all();
        $model->fill($data);
        
        if(!$model->validate())
        {        
            return redirect()->route('profile.edit')->withErrors($model->errors());
        };

        User::updating (function ($model) {
            $model->password = bcrypt($model->password);
            unset($model->password_confirmation);
        });
        
        $model->save();
        
        return redirect()->route('profile.edit')->with('message', trans('messages.data_changed_success'));
    }
}
