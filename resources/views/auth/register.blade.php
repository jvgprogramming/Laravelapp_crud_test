@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <div style="max-width: 500px; margin: 4rem auto;">
        <div class="card">
            <h2>Create Account</h2>

            @if($errors->any())
                <div style="background: #fee; border: 1px solid #fcc; color: #c33; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <strong>Errors:</strong>
                    <ul style="margin: 0.5rem 0 0 1.5rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div style="margin-bottom: 1.5rem;">
                    <label for="name" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                        style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;"
                        @focus="this.style.borderColor='#667eea'" @blur="this.style.borderColor='#ddd'">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                        style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;"
                        @focus="this.style.borderColor='#667eea'" @blur="this.style.borderColor='#ddd'">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Password</label>
                    <input id="password" type="password" name="password" required 
                        style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;"
                        @focus="this.style.borderColor='#667eea'" @blur="this.style.borderColor='#ddd'">
                    <small style="color: #666; display: block; margin-top: 0.5rem;">At least 8 characters, including uppercase, lowercase, and numbers</small>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="password_confirmation" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required 
                        style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;"
                        @focus="this.style.borderColor='#667eea'" @blur="this.style.borderColor='#ddd'">
                </div>

                <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Create Account</button>
                </div>

                <p style="text-align: center; color: #666;">
                    Already have an account? 
                    <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">Login here</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
