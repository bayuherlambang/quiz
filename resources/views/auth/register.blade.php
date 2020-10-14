@extends('layouts.auth')

@section('content')
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
          {{ csrf_field() }}
        <div class="input-group{{ $errors->has('name') ? ' has-error' : '' }} mb-3">
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full name" required autofocus>
          @if ($errors->has('name'))
              <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }} mb-3">
          <input id="email" type="text" class="form-control" name="email" placeholder="Domain" value="{{ old('email') }}" required>

          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }} mb-3">
          <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} mb-3">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype password" required>
          @if ($errors->has('password_confirmation'))
              <span class="help-block">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
              </span>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @php
        $relations = [
            'roles' => \App\Role::get()->pluck('title', 'id')->prepend('Please select role', ''),
        ];
        @endphp
        <div class="input-group{{ $errors->has('role_id') ? ' has-error' : '' }} mb-3">
          {!! Form::select('role_id', $relations['roles'], old('role_id'), ['class' => 'form-control']) !!}
          @if($errors->has('role_id'))
              <p class="help-block">
                  {{ $errors->first('role_id') }}
              </p>
          @endif
          @if ($errors->has('role_id'))
              <span class="help-block">
                  <strong>{{ $errors->first('role_id') }}</strong>
              </span>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">

            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
@endsection
