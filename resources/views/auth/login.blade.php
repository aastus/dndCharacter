@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="page-content">
                    <!-- ***** Login Form Start ***** -->
                    <div class="main-profile">
                        <div class="heading-section text-center">
                            <h4><em>Welcome Back!</em> Please Log In</h4>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="form mt-4">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>

                            <!-- Password -->
                            <div class="form-group mt-3">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4">
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('register') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                @endif

                                    <div class="main-border-button">
                                        <button type="submit">{{ __('Log in') }}</button>
                                    </div>
                            </div>
                            <center>
                                @if (\JoelButcher\Socialstream\Socialstream::show())
                                <p class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                    {{ __('Or login via') }}
                                </p>
                                    <div class="social-login mt-4 mb-5">
                                        <x-socialstream />
                                    </div>
                                @endif
                            </center>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
