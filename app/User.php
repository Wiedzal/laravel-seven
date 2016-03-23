<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Validator;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lang', 'login', 'email', 'name', 'password', 'password_confirmation'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    private $errors;
    
    private $rules = [
        'lang' => 'required|max:2',
        'login' => 'required|max:25|unique:users',
        'email' => 'required|email|max:128|unique:users',
        'name' => 'required|max:128',
        'password' => 'required|confirmed|min:6',
    ];

    public function validate()
    {
        if($this->exists)
        {
            $this->rules['login'] = 'required|max:25|unique:users,login,' . $this->id;
            $this->rules['email'] = 'required|email|max:128|unique:users,email,' . $this->id;
        }
        
        $validator = Validator::make($this->attributes, $this->rules);
        if ($validator->fails())
        {
            $this->errors = $validator->errors();
            return false;
        }
        return true;
    }
    
    public function errors()
    {
        return $this->errors;
    }
}
