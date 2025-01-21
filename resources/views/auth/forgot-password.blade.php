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
                    <h2 class="text-center p-3">Forget Password</h2>

                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="btn btn-danger">
                                {{ __('Email Password Reset Link') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-xl-4"></div>
    </div>
</div>

