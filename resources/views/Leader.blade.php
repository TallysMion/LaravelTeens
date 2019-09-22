@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lideres</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                           @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                           @endforeach
                         </ul>
                       </div>
                    @endif
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col col-5" width="45%"><label for="name"  class="col-form-label text-md-right">Nome</label></th>
                            <th scope="col col-5" width="25%"><label for="type"  class="col-form-label text-md-right">Email</label></th>
                            <th scope="col col-5" width="15%"><label for="value" class="col-form-label text-md-right">Senha</label></th>
                            <th scope="col col-5" width="15%"><label for="value" class="col-form-label text-md-right">Ação</label></th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route('leader.add') }}">
                      @csrf
                      <table class="table">
                        <tbody>
                          <tr>
                            <th scope="col col-5" width="45%">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="Nome" autofocus>
                            </th>
                            <th scope="col col-5" width="25%">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="Email" autofocus>
                            </th>
                            <th scope="col col-5" width="15%">
                              <input id="password" type="password" class="form-control @error('Password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="Senha" autofocus>
                            </th>
                            <th scope="col col-5" width="15%">
                              <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                    @foreach($leaders as $leader)
                      <form method="POST" action="{{ route('leader.add') }}">
                        @csrf
                        <input name="id" value = "{{$leader->id}}" hidden>
                        <input name="email" value = "{{$leader->email}}" hidden>
                        <table class="table">
                          <tr>
                            <td scope="col col-5" width="45%">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$leader->name}}" required autocomplete="Nome" autofocus>
                            </td>
                            <td scope="col col-5" width="25%">
                              <label for="email"  class="col-form-label text-md-right">{{$leader->email}}</label></td>
                            <td scope="col col-5" width="15%">
                              <input id="password" type="password" class="form-control @error('passwprd') is-invalid @enderror" name="password" value="" required autocomplete="Nome" autofocus>
                            </td>
                            <th scope="col col-5" width="15%"><button type="submit" class="col-form-label text-md-right btn btn-primary">Atualizar</button>
                            </th>
                          </tr>
                        </table>
                      </form>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
