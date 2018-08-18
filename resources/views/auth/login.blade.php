@extends('auth.contenido')

@section('login')
    <div class="form-holder has-shadow">
        <div class="row">
        <div class="col-lg-6">
            <div class="info d-flex align-items-center">
            <div class="content">
                <div class="logo">
                <h1>Automotores INKA</h1>
                </div>
                <p>Sistema de Ventas - Intranet</p>
            </div>
            </div>
        </div>
        <div class="col-lg-6 bg-white">
            <div class="form d-flex align-items-center">
            <div class="content">
                <form class="form-horizontal was-validated" method="POST" action="{{ route('login')}}">
                    {{ csrf_field() }}
                    <div class="form-group{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                        <input id="usuario" type="text" name="usuario" value="{{old('usuario')}}" style="text-transform:uppercase" placeholder="Usuario" class="input-material">
                        <!--<label for="login-username" class="label-material">User Name</label>-->
                        {!!$errors->first('usuario','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group{{$errors->has('password' ? 'is-invalid' : '')}}">
                        <input id="password" type="password" name="password" placeholder="PASSWORD" class="input-material">
                        <!--<label for="login-password" class="label-material">Password</label>-->
                        {!!$errors->first('password','<span class="help-block">:message</span>')!!}
                    </div>
                    <button type="submit" class="btn btn-primary">Acceder</button>
                    <!--<a id="login" href="index.html" class="btn btn-primary">Login</a>-->
                </form>
                <!--<a href="#" class="forgot-pass">Forgot Password?</a><br><small>Do not have an account? </small><a href="register.html" class="signup">Signup</a>-->
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection