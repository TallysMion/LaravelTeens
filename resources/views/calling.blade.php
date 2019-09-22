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


                    <form method="POST" action="{{ route('calling.add') }}">
                      @csrf
                      <table class="table">
                        <tbody>
                          @foreach($teens as $ukey => $teen)
                            <input name="teen[{{$ukey}}]" value = "{{$teen->id}}" hidden>
                            <tr>
                              <th scope="col col-5" colspan="4" width="100%"><label for="name"  class="col-form-label text-md-right">{{$teen->name}}</label></th>
                            </tr>
                            @foreach($activities as $key => $activity)
                              @if($key%2==0)
                                <tr>
                                  <th scope="col col-5" width="30%"><label for="name"  class="col-form-label text-md-right">{{$activity->name}}</label></th>
                                  <th scope="col col-5" width="20%"><input id="{{$activity->name}}{{$ukey}}" type="{{$activity->type}}" class="form-control @error('$activity.name'.'$ukey') is-invalid @enderror" value=0 name="{{$activity->name}}[{{$ukey}}]" autofocus></th>
                              @else
                                  <th scope="col col-5" width="30%"><label for="name"  class="col-form-label text-md-right">{{$activity->name}}</label></th>
                                  <th scope="col col-5" width="20%"><input id="{{$activity->name}}{{$ukey}}" type="{{$activity->type}}" class="form-control @error('$activity.name'.'$ukey') is-invalid @enderror" value=0 name="{{$activity->name}}[{{$ukey}}]" autofocus></th>
                                </tr>
                              @endif
                            @endforeach
                            <tr>
                              <th scope="col col-5" colspan="4" width="100%"><label for="name"  class="col-form-label text-md-right"></label></th>
                            </tr>
                          @endforeach
                          <tr>
                            <th scope="col col-5" colspan="4" width="100%">
                              <button type="submit" class="col-form-label text-md-right btn btn-primary">Confirmar</button>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
