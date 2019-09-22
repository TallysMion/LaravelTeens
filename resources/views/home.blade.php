@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

              @if(Auth::user()->type == 'teen')
                <div class="card-header">Teens</div>
                <div class="card-body">
                  Bem Vindo Teen<br>
                  Sua atualmente possui {{Auth::user()->getScore()}} Pontos
                </div>
              @else
                <div class="card-header">Teens</div>
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
                            <th scope="col col-5" width="30%"><label for="name"  class="col-form-label text-md-right">Nome</label></th>
                            <th scope="col col-5" width="30%"><label for="type"  class="col-form-label text-md-right">Email</label></th>
                            <th scope="col col-5" width="15%"><label for="value" class="col-form-label text-md-right">Senha</label></th>
                            <th scope="col col-5" width="10%"><label for="value" class="col-form-label text-md-right">Pontuação</label></th>
                            <th scope="col col-5" width="15%"><label for="value" class="col-form-label text-md-right">Ação</label></th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    @if(Auth::user()->type=='leader')
                    <form method="POST" action="{{ route('teen.add') }}">
                      @csrf
                      <table class="table">
                        <tbody>
                          <tr>
                            <th scope="col col-5" width="30%">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="Nome" autofocus>
                            </th>
                            <th scope="col col-5" width="30%">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="Email" autofocus>
                            </th>
                            <th scope="col col-5" width="25%">
                              <input id="password" type="password" class="form-control @error('Password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="Senha" autofocus>
                            </th>
                            <th scope="col col-5" width="15%">
                              <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                    @endif
                    @foreach($teens as $teen)
                      <form method="POST" action="{{ route('teen.add') }}">
                        @csrf
                        <input name="id" value = "{{$teen->id}}" hidden>
                        <input name="email" value = "{{$teen->email}}" hidden>
                        <table class="table">
                          <tr>
                            <td scope="col col-5" width="30%">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$teen->name}}" required autocomplete="Nome" autofocus>
                            </td>
                            <td scope="col col-5" width="30%">
                              <label for="email"  class="col-form-label text-md-right">{{$teen->email}}</label></td>
                            <td scope="col col-5" width="15%">
                              <input id="password" type="password" class="form-control @error('passwprd') is-invalid @enderror" name="password" value="" required autocomplete="Nome" autofocus>
                            </td>
                            <td scope="col col-5" width="10%">
                              <label for="score"  class="col-form-label text-md-right">{{$teen->score}}</label></td>
                            </td>
                            <th scope="col col-5" width="15%"><button type="submit" class="col-form-label text-md-right btn btn-primary">Atualizar</button>
                            </th>
                          </tr>
                        </table>
                      </form>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
