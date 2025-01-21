@extends('layouts.guest')

@section('content')

@section('title')
  Login
@stop


<div class="container">
    <div class="row">
        <div class="col-xl-4"></div>
        <div class="col-xl-4">
            <div class="card shadow mt-5 text-light" style="background-color: rgb(29 21 52);">
                <div class="card-body">
                    <h2 class="text-center p-3">Login Now</h2>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password">Password</label>

                            <input id="password" class="form-control"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="text-center">

                            <button type="submit" class="btn btn-primary mt-2">
                                {{ __('Log in') }}
                            </button>
                        </div>

                            @if (Route::has('password.request'))
                                <div class="mt-3 text-center">
                                    <a class="text-light" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                </div>
                            
                            @endif

                            <div style="text-align: center; margin-top: 10px;">
                                <a class="text-light underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                                        {{ __('You have no account? Registration now') }}
                                </a>
                            </div>


                        </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4"></div>
    </div>
</div>


@endsection