@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="page-content">
                    <!-- ***** Registration Form Start ***** -->
                    <div class="main-profile">
                        <div class="heading-section text-center">
                            <h4><em>Join Us!</em> <br> Please Register</h4>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="form mt-1">
                            @csrf

                            <!-- Name -->
                            <div class="form-group">
                                <p class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mt-4">
                                <x-input-label for="name" :value="__('Name')" />
                                </p>
                                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <p class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                </p>
                                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <p class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mt-4">
                                <x-input-label for="password" :value="__('Password')" />
                                </p>
                                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <p class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                </p>
                                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-4">
                                <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('login') }}">
                                    {{ __('Already have an account?') }}
                                </a>

                                <div class="main-border-button">
                                    <button type="submit">{{ __('Register') }}</button>
                                </div>
                            </div>

                            <!-- Social Login -->
                            <center>
                                @if (\JoelButcher\Socialstream\Socialstream::show())
                                    <p class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mt-4">
                                        {{ __('Or register via') }}
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
