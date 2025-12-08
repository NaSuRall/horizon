@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen ">
        <img src="{{ asset('img/horizonmoto.png') }}" class="absolute w-45 top-10 left-10" alt="">
        <div class="w-full max-w-md bg-gray-900 text-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-center  mb-6">Login - Admin</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium">Email :</label>
                    <input id="email" type="email"
                           class="mt-1 block w-full h-10 p-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium ">Password</label>
                    <input id="password" type="password"
                           class="mt-1 block w-full rounded-lg h-10 p-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 @error('password') border-red-500 @enderror"
                           name="password" required autocomplete="current-password">
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember" type="checkbox" name="remember"
                           class="h-4 w-4 text-red-500 border-gray-300 h-10 p-2 rounded focus:ring-red-500"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="ml-2 block text-sm ">Remember Me</label>
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-between">
                    <button type="submit"
                            class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Login
                    </button>
                </div>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="text-center mt-4">
                        <a class="text-sm text-red-600 hover:text-red-800" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
