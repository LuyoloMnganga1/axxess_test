@extends('layout.auth')
@section('tile')
    Login
@endsection
@section('content')
<div class="containr-fluid">
    <div class="card border-3 shadow-lg" style="margin:10% 30% 0% 30%">
        <div class="card header" style="background-color: #8935c9;color:#fff">
            <h1 class="text-center">Operator Login</h1>
        </div>
        <form action="{{ route('login') }}" method="post">
            @csrf
        <div class="card-body" style="color: #8935c9">
            @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                   @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <p>{{ $message }}</p>
                            </div>
                     @endif
            <div class="col-lg-12">
                <div class="form-group">
                  <label for="name">Username</label>
                  <input type="email" class="form-control" name="username" id="username" placeholder="john@example.com">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="name">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="**********">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <input type="submit" class="form-control"  value="Login" class="btn-sm btn" style="background-color: #8935c9;color:#fff">
                </div>
              </div>
              <a href="{{ route('forgot_password') }}">forgot password?</a>
            </form>
        </div>
    </div>
</div>
@endsection