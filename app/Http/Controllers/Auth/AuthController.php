<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }


    protected function logar(){
        if(Auth::check())
            return view('/');
        else
            return view('auth.login');
    }
    protected function registrar(){
        return view('auth.register');
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(UserRequest $request)
    {
        $data = $request->all();
        $confirmation_code = str_random(30);
        $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmation_code,
        ]);
        Mail::send('mail.verify', ['confirmation_code'=>$confirmation_code], function ($message) use ($data) {
            $message->to($data['email'], $data['name'])
                ->subject('Confirme seu email');
        });

        //  Flash::message('Thanks for signing up! Please check your email.');

        return redirect()->route('auth.register')->with('status', 'Seu cadastro foi salvo,enviamos um email de confirmação, abra e clique no link para confirmar sua conta.');
    }
    protected function getResend(){
        return view('auth.confirm');
    }

    protected function postResend(Request $request)
    {
        $user = $this->user->where(['email' => $request->get('email')])->first();
        if ($user->confirmed == 1) {
            return redirect('auth/resend')->with('error', 'Usuário já confirmado.');
        }
        else{
            Mail::send('mail.verify', ['confirmation_code'=>$user->confirmation_code], function ($message) use ($user) {
                $message->to($user->email, $user->name)
                    ->subject('Confirme seu email');
            });
            return redirect('auth/resend')->with('status', 'Email de confirmação enviado.');
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function acessar(Request $request)
    {
        $remenber = $request->get('remember')=='on';
        $user = $this->user->where(['email' => $request->get('email')])->first();
        if($user->confirmed==1)
            if (Auth::attempt(['email'=>$request->get('email'),'password'=>$request->get('password')],$remenber) ){
                Auth::login($user);
                return redirect('/');
            }else{
                return redirect('auth/login')->with('error', 'Email ou Senha incorretos.');
            }
        else
            return redirect('auth/login')->with('error', 'Usuário não confirmado, verifique  o seu email.');
    }
    protected function sair()
    {
        if (Auth::check())
            Auth::logout();
        return  redirect('/');
    }

    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            //throw new InvalidConfirmationCodeException;
            return "codigo incorreto";
        }

        $user = $this->user->where(['confirmation_code' => $confirmation_code])->first();

        if ( ! $user)
        {
            //throw new InvalidConfirmationCodeException;
            return "codigo invalido";
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        //Flash::message('You have successfully verified your account.');
        return redirect()->route('auth.login')->with('status', 'Email confirmado, proceda com login para acessar a sua conta.');
        return view('auth.login');
    }

}
