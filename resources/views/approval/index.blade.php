@extends('layouts.dashboard')

@section('content')
<div class="px-8 pt-8">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h1 class="text-2xl font-extrabold mb-6">Approval SPPH</h1>
        
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-3 border-b text-left">No</th>
                        <th class="py-2 px-3 border-b text-left">Nama Pekerjaan</th>
                        <th class="py-2 px-3 border-b text-left">Tanggal Penawaran</th>
                        <th class="py-2 px-3 border-b text-left">Tanggal Penutupan</th>
                        <th class="py-2 px-3 border-b text-left">Vendor</th>
                        <th class="py-2 px-3 border-b text-left">Status</th>
                        <th class="py-2 px-3 border-b text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($spphs as $i => $spph)
                    <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                        <td class="py-2 px-3 border-b">{{ $i+1 }}</td>
                        <td class="py-2 px-3 border-b">{{ $spph->nama_pekerjaan }}</td>
                        <td class="py-2 px-3 border-b">{{ \Carbon\Carbon::parse($spph->tanggal_penawaran)->format('d/m/Y') }}</td>
                        <td class="py-2 px-3 border-b">{{ \Carbon\Carbon::parse($spph->tanggal_penutupan)->format('d/m/Y') }}</td>
                        <td class="py-2 px-3 border-b">{{ $spph->vendor->nama_vendor ?? '-' }}</td>
                        <td class="py-2 px-3 border-b">
                            @if($spph->status == 'approved')
                                <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-semibold">Approved</span>
                            @elseif($spph->status == 'rejected')
                                <span class="px-2 py-1 rounded bg-red-100 text-red-700 text-xs font-semibold">Rejected</span>
                            @elseif($spph->status == 'submitted')
                                <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs font-semibold">Submitted</span>
                            @else
                                <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 text-xs font-semibold">{{ ucfirst($spph->status) }}</span>
                            @endif
                        </td>
                        <td class="py-2 px-3 border-b">
                            <div class="flex space-x-2">
                                <a href="{{ route('approval.show', $spph->id) }}" 
                                   class="text-blue-600 hover:underline text-xs">Detail</a>
                                
                                @if($spph->status == 'draft' || $spph->status == 'submitted')
                                    <form method="POST" action="{{ route('approval.approve', $spph->id) }}" 
                                          onsubmit="return confirm('Setujui SPPH ini?')" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:underline text-xs">
                                            Approve
                                        </button>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('approval.reject', $spph->id) }}" 
                                          onsubmit="return confirm('Tolak SPPH ini?')" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:underline text-xs">
                                            Reject
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-400">Belum ada SPPH yang perlu disetujui.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
