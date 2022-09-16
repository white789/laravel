@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" value="{{ old('email') }}" required
                   class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" />
            @if($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" required
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" />
            @if($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                value="{{ old('remember') ? 'checked' : '' }}">
                <label for="remember" class="form-check-label">
                    Remember me
                </label>
            </div>
        </div>
        <button class="btn btn-primary btn-block">Login</button>
    </form>
@endsection
