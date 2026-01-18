@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div style="max-width: 500px; margin: 4rem auto;">
        <div class="card">
            <h2>Login to Your Account</h2>

            @if($errors->any())
                <div style="background: #fee; border: 1px solid #fcc; color: #c33; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <strong>Error:</strong> {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div style="background: #efe; border: 1px solid #cfc; color: #3c3; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom: 1.5rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                        style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;"
                        @focus="this.style.borderColor='#667eea'" @blur="this.style.borderColor='#ddd'">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Password</label>
                    <input id="password" type="password" name="password" required 
                        style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;"
                        @focus="this.style.borderColor='#667eea'" @blur="this.style.borderColor='#ddd'">
                </div>

                <div style="margin-bottom: 1.5rem; display: flex; align-items: center;">
                    <input type="checkbox" name="remember" id="remember" style="width: 18px; height: 18px; cursor: pointer;">
                    <label for="remember" style="margin-left: 0.5rem; color: #666; cursor: pointer; font-weight: 500;">Remember Me</label>
                </div>

                <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Login</button>
                </div>

                <p style="text-align: center; color: #666;">
                    Don't have an account? 
                    <a href="{{ route('register') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">Create one here</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection