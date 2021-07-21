@extends('ticketit::layouts.master')
@section('page', 'Alterar Dados')

@section('ticketit_content')
@if (!isset($users) || $users->isEmpty())
<h3 class="text-center">{{ 'Ocorreu um problema' }}</h3>
@else
    @php $us = $users->first(); @endphp
<div class="row">
    <div class="row form-login">
        <div class="col-md-12">
            <form class="form-cadastro" method="POST" action="{{ route('userUpdate') }}">
            <input type="hidden" name="id" value="{{ $us->id }}">
                @csrf
                <!-- Inicio do formulario   -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label class="ml-auto">* Nome Completo</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                required="required" name="name" value="{{$us->name}}" />
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <div class="form-group">
                            <label class="ml-auto">* CPF</label> <!--  -->
                            <input id="cpf" type="tel" placeholder="___.___.___-__" data-mask="999.999.999-99"
                                class="form-control cpf" required="required" alt="cpf" name="cpfcnpj" value="{{$us->cpfcnpj}}" />
                        </div>
                    </div>

                    <div class=" form-group col-md-3">
                        <div class="form-group">
                            <label>* Data de Nascimento</label>
                            <input type="text" placeholder="__/__/____" class="form-control date" name="dnascimento"
                                value="{{!! date('d-m-Y', strtotime($us->dnascimento)); !!}}" />
                        </div>
                    </div>

                    <!--  ---------------------------------------------------------  -->
                    <div class="form-group col-md-2">
                        <div class="form-group">
                            <label>* Sexo</label>
                            <select class="form-control" name="sexo" value="" required="required">
                                <option @if($us->sexo=='M') selected="selected" @endif value="M">Masculino</option>
                                <option @if($us->sexo=='F') selected="selected" @endif value="F">Feminino</option>
                                <option @if($us->sexo=='O') selected="selected" @endif value="O">Outro</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>* Escolaridade</label>
                            <select class="form-control" name="escolaridade" value="" required="required">
                                @if ((isset($esc)))
                                @foreach ($esc as $record)
                                <option @if($us->escolaridade == $record->id) selected="selected" @endif value={{$record->id}}>{{$record->descricao}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>* Profissão</label>
                            <label>* Profissão</label>
                            <select class="form-control" name="profissao" value="" required="required">
                                @if ((isset($prof)))
                                @foreach ($prof as $record)
                                <option @if($us->profissao == $record->id) selected="selected" @endif value={{$record->id}}>{{$record->descricao}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <p>Digite o CEP para completar o endereço automaticamente</p>
                <div class="row">
                    <div class="form-group col-md-2">

                        <div class="form-group">
                            <label>* CEP</label>
                            <input type="text" class="form-control cep" required="required" name="cep" id="cep" value="{{$us->cep}}"
                                onblur="pesquisacep(this.value);" />
                        </div>

                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>* Endereço</label>
                            <input type="text" class="form-control" placeholder="(exemplo: Avenida Marechal Rondon)"
                                required="required" name="endereco" id="endereco" value="{{$us->endereco}}" /></div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label>* Bairro</label>
                            <input type="text" class="form-control" required="required" name="bairro" id="bairro"
                                value="{{$us->bairro}}" />
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <div class="form-group">
                            <label>* UF</label>
                            <input type="text" class="form-control" readonly required="required" name="uf" id="uf"
                                value="{{$us->uf}}" />
                        </div>
                    </div>

                    <div class="form-group col-md-8">
                        <div class="form-group">
                            <label>* Cidade</label>
                            <input type="text" class="form-control" readonly id="cidade" required="required"
                                name="cidade" id="cidade" value="{{$us->cidade}}" />
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <div class="form-group">
                            <label>* Número</label>
                            <input type="text" class="form-control" id="numero" required="required" name="numero"
                                value="{{$us->numero}}" />
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label>* Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" value="{{$us->complemento}}" />
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <div class="form-group">
                            <label>* Celular</label>
                            <input type="text" class="form-control sp_celphones" placeholder="(00) 00000-0000"
                                required="required" name="celular" value="{{$us->celular}}" />
                        </div>
                    </div>


                    <div class="form-group col-md-3">
                        <div class="form-group">
                            <label>Telefone Fixo</label>

                            <input type="text" class="form-control phone_with_ddd" placeholder="(00) 0000-0000" name="celfixo" value="{{$us->celfixo}}" />
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>* E-mail</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email" value="{{$us->email}}" required>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label>* Senha</label>
                            <input type="password" class="form-control" autocomplete="off" name="password" onpaste="return false" required/>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label>* Confirmar Senha</label>
                            <input type="password" autocomplete="off" class="form-control" name="password_confirmation" required />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning" value="Save">Alterar Dados</button>
            </form>
        </div>
    </div>
</div>
@endif
@stop
