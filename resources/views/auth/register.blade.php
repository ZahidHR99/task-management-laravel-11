@extends('layouts.guest')

@section('content')

@section('title')
  Registration
@stop


<div class="container">
    <div class="row">
        <div class="col-xl-4"></div>
        <div class="col-xl-4">
            <div class="card shadow mt-5 text-light" style="background-color: rgb(29 21 52);">
                <div class="card-body">
                    <h2 class="text-center p-3">Login Now</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <input id="password" class="form-control"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <input id="password_confirmation" class="form-control"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <a class="text-light" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4"></div>
    </div>
</div>

@endsection