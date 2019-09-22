@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Atividades</div>

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
                            <th scope="col col-5" width="45%"><label for="name"  class="col-form-label text-md-right">Atividade</label></th>
                            <th scope="col col-5" width="25%"><label for="type"  class="col-form-label text-md-right">Tipo</label></th>
                            <th scope="col col-5" width="15%"><label for="value" class="col-form-label text-md-right">Pontos</label></th>
                            <th scope="col col-5" width="15%"><label for="value" class="col-form-label text-md-right">Ação</label></th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route('activity.add') }}">
                      @csrf
                      <table class="table">
                        <tbody>
                          <tr>
                            <th scope="col col-5" width="45%">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="Nome" autofocus>
                            </th>
                            <th scope="col col-5" width="25%">
                              <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
                                  @foreach(App\activity::TYPE as $key => $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                  @endforeach
                              </select>
                            </th>
                            <th scope="col col-5" width="15%">
                              <input id="value" type="number" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autocomplete="Nome" autofocus>
                            </th>
                            <th scope="col col-5" width="15%">
                              <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                    @foreach($activities as $activity)
                      <form method="POST" action="{{ route('activity.add') }}">
                        @csrf
                        <input name="id" value = "{{$activity->id}}" hidden>
                        <input name="type" value = "{{$activity->type}}" hidden>
                        <table class="table">
                          <tr>
                            <td scope="col col-5" width="45%">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$activity->name}}" required autocomplete="Nome" autofocus>
                            </td>
                            <td scope="col col-5" width="25%"><label for="name"  class="col-form-label text-md-right">{{$activity->type}}</label></td>
                            <td scope="col col-5" width="15%"><input id="value" type="number" class="form-control @error('value') is-invalid @enderror" name="value" value="{{$activity->value}}" required autocomplete="Nome" autofocus></td>
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
