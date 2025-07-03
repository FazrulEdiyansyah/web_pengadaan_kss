@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen" style="background-color: #00a0d2;">
    <div class="w-full max-w-md p-8 space-y-6 bg-white shadow" style="border-radius: 1rem;">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('build/assets/logo_kss.png') }}" alt="Logo KSS" class="w-32 mb-4">
        </div>
        @if(session('error'))
            <div class="text-red-600 text-sm mb-4">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input id="phone" name="phone" type="text" required autofocus
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-300"
                    value="{{ old('phone') }}">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" class="mr-2">
                <label for="remember" class="text-sm text-gray-600">Remember me</label>
            </div>
            <div class="flex justify-between items-center">
                <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:underline">Dont Have Account?</a>
                <button type="submit"
                    class="px-6 py-2 text-white"
                    style="background-color: #00a0d2; border-radius: 0.5rem;">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
@endsection