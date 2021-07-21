<?php

namespace App\Http\Controllers;
use App\user;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Kordy\Ticketit\Models\Escolaridade;
use Kordy\Ticketit\Models\Profissao;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $current = (\Auth::user()->id);
        if ($current==$id) {
            $users = User::where('id', $id)->get();
            $esc  = Escolaridade::get();
            $prof = Profissao::get();
                if ($users) {
                return view('user.edit', compact('users', 'esc', 'prof'));
            }
        }else
            return view('user.edit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($data)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cpfcnpj' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);
        $update = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cpfcnpj'=> $request->cpfcnpj,
            'sexo'=> $request->sexo,
            'celular'=> $request->celular,
            'celfixo'=> $request->celfixo,
            'dnascimento'=> date("Y-m-d",strtotime(str_replace('/','-',$request->dnascimento))),
            'escolaridade'=> $request->escolaridade,
            'profissao'=> $request->profissao,

            "cep" => $request->cep,
            "endereco" => $request->endereco,
            "bairro" => $request->bairro,
            "uf" => $request->uf,
            "cidade" => $request->cidade,
            "numero" => $request->numero,
            "complemento" => $request->complemento
        ];
        //dd($request);
        //$u = User::where('id', $request->id)->get();
        //dd($u);
        User::where('id', $request->id)->update($update);

        //return Redirect::to('user.edit')->with('success','Great! Product updated successfully');
       return view('user.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
