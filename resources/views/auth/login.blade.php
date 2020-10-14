@extends('layouts.auth')

@section('content')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>QUEING </b>SMG2 - SMG3
    </a><br>
    <small>Quiz & Briefing</small>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were problems with input:
              <br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <p class="login-box-msg"></p>

      <form class="form-horizontal"
            role="form"
            method="POST"
            action="{{ url('login') }}">
          <input type="hidden"
                 name="_token"
                 value="{{ csrf_token() }}">
        <div class="input-group mb-3">
          <input type="text"
                 class="form-control"
                 name="email"
                 placeholder="Domain"
                 value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password"
                 class="form-control"
                 placeholder="Password"
                 name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <a href="{{ route('auth.register') }}" class="text-center">Register</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection
