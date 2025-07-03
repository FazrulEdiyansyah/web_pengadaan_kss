@extends('layouts.dashboard')

@section('content')
<div class="px-8 pt-8">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h1 class="text-2xl font-extrabold mb-6">Overview SPPH</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-3 border-b text-left">No</th>
                        <th class="py-2 px-3 border-b text-left">Nama Pekerjaan</th>
                        <th class="py-2 px-3 border-b text-left">Tanggal Penawaran</th>
                        <th class="py-2 px-3 border-b text-left">Tanggal Penutupan</th>
                        <th class="py-2 px-3 border-b text-left">Vendor</th>
                        <th class="py-2 px-3 border-b text-left">Penyetuju</th>
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
                        <td class="py-2 px-3 border-b">{{ $spph->vendor->name ?? '-' }}</td>
                        <td class="py-2 px-3 border-b">{{ $spph->penyetuju->name ?? '-' }}</td>
                        <td class="py-2 px-3 border-b">
                            @if($spph->status == 'approved')
                                <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-semibold">Approved</span>
                            @elseif($spph->status == 'draft')
                                <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 text-xs font-semibold">Draft</span>
                            @else
                                <span class="px-2 py-1 rounded bg-gray-100 text-gray-700 text-xs font-semibold">{{ ucfirst($spph->status) }}</span>
                            @endif
                        </td>
                        <td class="py-2 px-3 border-b">
                            <a href="{{ route('spph.show', $spph->id) }}" class="text-blue-600 hover:underline text-xs">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-4 text-center text-gray-400">Belum ada data SPPH.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection