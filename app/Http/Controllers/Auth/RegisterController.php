<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Kordy\Ticketit\Models\Escolaridade;
use Kordy\Ticketit\Models\Profissao;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    public function showRegistrationForm(){
        $esc  = Escolaridade::get();
        $prof = Profissao::get();
        return view('auth.register', compact('esc', 'prof'));
    }
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'cpf' => ['required', 'string', 'cpf', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cpfcnpj'=> $data['cpfcnpj'],
            'sexo'=> $data['sexo'],
            'celular'=> $data['celular'],
            'celfixo'=> $data['celfixo'],
            'dnascimento'=> date("Y-m-d",strtotime(str_replace('/','-',$data['dnascimento']))),
            'escolaridade'=> $data['escolaridade'],
            'profissao'=> $data['profissao'],
            //endereço

            "cep" => $data['cep'],
            "endereco" => $data['endereco'],
            "bairro" => $data['bairro'],
            "uf" => $data['uf'],
            "cidade" => $data['cidade'],
            "numero" => $data['numero'],
            "complemento" => $data['complemento']

        ]);
    }
}
