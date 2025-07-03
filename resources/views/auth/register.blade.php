@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen" style="background-color: #00a0d2;">
    <div class="w-full max-w-md p-8 space-y-6 bg-white shadow" style="border-radius: 1rem;">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('build/assets/logo_kss.png') }}" alt="Logo KSS" class="w-32 mb-4">
        </div>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input id="name" name="name" type="text" required autofocus
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-300"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="text-red-600 text-sm mt-2">* {{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-300"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-600 text-sm mt-2">* {{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input id="phone" name="phone" type="text" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-300"
                    value="{{ old('phone') }}">
                @error('phone')
                    <div class="text-red-600 text-sm mt-2">* {{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-300">
                @error('password')
                    <div class="text-red-600 text-sm mt-2">* {{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-300">
                @error('password_confirmation')
                    <div class="text-red-600 text-sm mt-2">* {{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-between items-center">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Already Have Account?</a>

                <button type="submit"
                    class="px-6 py-2 text-white"
                    style="background-color: #00a0d2; border-radius: 0.5rem;">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function(e) {
        const value = e.target.value;
        if (/[^0-9]/.test(value)) {
            phoneInput.setCustomValidity('Nomor telepon hanya boleh angka.');
            phoneInput.reportValidity();
        } else {
            phoneInput.setCustomValidity('');
        }
    });
});
</script>
@endsection