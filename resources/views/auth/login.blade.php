@extends('auth.contenido')

@section('login')

<div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0">
          <div class="card p-4">
          <form class="form-horizontal was-validated" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
              <div class="card-body">
              <div style="padding-left: 28%; padding-bottom: 5%;"> <img src="img/logo.jpg"></div>
              <h2>Iniciar sesión</h2>
              <div style="margin-left: 39%;" class="form-group mb-3 {{$errors->has('usuario' ? 'is-invalid' : '') }}">
                <input type="text" value="{{old('usuario')}}" name="usuario" id="usuario" placeholder="Usuario">
            {!!$errors->first('usuario', '<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div style="margin-left: 39%;" class="form-group mb-4 {{$errors->has('password' ? 'is-invalid' : '') }}">
                <input type="password" name="password" id="password" placeholder="Password">
                {!!$errors->first('password', '<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="row">
                <div style="padding-left: 43%;" class="col-6">
                  <button type="submit" class="btn btn-primary px-4">Ingresar</button>
                </div>
              </div>
            </div>
          </form>
          </div>
    </div>
@endsection
