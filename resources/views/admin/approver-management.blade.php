@extends('layouts.admin')

@section('content')
<div class="px-8 pt-8">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h1 class="text-2xl font-extrabold mb-6">Approver Management</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Users List -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Regular Users</h2>
                <div class="space-y-3">
                    @forelse($users as $user)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <h3 class="font-medium">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $user->phone }}</p>
                            </div>
                            <form method="POST" action="{{ route('admin.make.approver') }}" class="inline">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button type="submit" 
                                        class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition"
                                        onclick="return confirm('Jadikan {{ $user->name }} sebagai approver?')">
                                    Make Approver
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Tidak ada user regular.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Approvers List -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Current Approvers</h2>
                <div class="space-y-3">
                    @forelse($approvers as $approver)
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div>
                                <h3 class="font-medium">{{ $approver->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $approver->phone }}</p>
                                <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Approver</span>
                            </div>
                            <form method="POST" action="{{ route('admin.remove.approver') }}" class="inline">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $approver->id }}">
                                <button type="submit" 
                                        class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition"
                                        onclick="return confirm('Hapus {{ $approver->name }} dari approver?')">
                                    Remove
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada approver yang ditunjuk.</p>
                    @endforelse
                </div>
            </div>
        </div>
        </div>

        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex">
                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Information</h3>
                    <p class="text-sm text-blue-700 mt-1">
                        Approvers dapat melihat dan menyetujui SPPH yang memilih mereka sebagai penyetuju. 
                        User yang dijadikan approver akan memiliki akses ke halaman approval.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
