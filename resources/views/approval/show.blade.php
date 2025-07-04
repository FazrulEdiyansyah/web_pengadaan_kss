@extends('layouts.dashboard')

@section('content')
<div class="px-8 pt-8">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-extrabold">Detail SPPH untuk Approval</h1>
            <a href="{{ route('approval.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
        </div>
        <div class="mb-4 border-b border-gray-300"></div>

        <!-- SPPH Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-lg font-semibold mb-3">Informasi SPPH</h3>
                <div class="space-y-2">
                    <div>
                        <span class="font-medium">Nama Pekerjaan:</span>
                        <span class="ml-2">{{ $spph->nama_pekerjaan }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Tanggal Penawaran:</span>
                        <span class="ml-2">{{ \Carbon\Carbon::parse($spph->tanggal_penawaran)->format('d/m/Y') }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Tanggal Penutupan:</span>
                        <span class="ml-2">{{ \Carbon\Carbon::parse($spph->tanggal_penutupan)->format('d/m/Y') }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Vendor:</span>
                        <span class="ml-2">{{ $spph->vendor->nama_vendor ?? 'Belum dipilih' }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Status:</span>
                        <span class="ml-2">
                            @if($spph->status == 'approved')
                                <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-semibold">Approved</span>
                            @elseif($spph->status == 'rejected')
                                <span class="px-2 py-1 rounded bg-red-100 text-red-700 text-xs font-semibold">Rejected</span>
                            @elseif($spph->status == 'submitted')
                                <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs font-semibold">Submitted</span>
                            @else
                                <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 text-xs font-semibold">{{ ucfirst($spph->status) }}</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Informasi Vendor</h3>
                @if($spph->vendor)
                    <div class="space-y-2">
                        <div>
                            <span class="font-medium">Nama:</span>
                            <span class="ml-2">{{ $spph->vendor->nama_vendor }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Email:</span>
                            <span class="ml-2">{{ $spph->vendor->email }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Phone:</span>
                            <span class="ml-2">{{ $spph->vendor->phone }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Contact Person:</span>
                            <span class="ml-2">{{ $spph->vendor->contact_person }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Alamat:</span>
                            <span class="ml-2">{{ $spph->vendor->alamat }}</span>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500">Vendor belum dipilih</p>
                @endif
            </div>
        </div>

        <!-- Items List -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Daftar Barang & Jasa</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-3 border-b text-left">No</th>
                            <th class="py-2 px-3 border-b text-left">Deskripsi</th>
                            <th class="py-2 px-3 border-b text-left">Quantity</th>
                            <th class="py-2 px-3 border-b text-left">Satuan</th>
                            <th class="py-2 px-3 border-b text-left">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($spph->items as $i => $item)
                        <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="py-2 px-3 border-b">{{ $i+1 }}</td>
                            <td class="py-2 px-3 border-b">{{ $item->deskripsi }}</td>
                            <td class="py-2 px-3 border-b">{{ $item->qty }}</td>
                            <td class="py-2 px-3 border-b">{{ $item->satuan }}</td>
                            <td class="py-2 px-3 border-b">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-400">Tidak ada item.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        @if($spph->status == 'draft' || $spph->status == 'submitted')
        <div class="flex justify-end space-x-4">
            <form method="POST" action="{{ route('approval.reject', $spph->id) }}" 
                  onsubmit="return confirm('Yakin ingin menolak SPPH ini?')" class="inline">
                @csrf
                <button type="submit" 
                        class="px-6 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition text-sm font-semibold">
                    Tolak SPPH
                </button>
            </form>
            
            <form method="POST" action="{{ route('approval.approve', $spph->id) }}" 
                  onsubmit="return confirm('Yakin ingin menyetujui SPPH ini?')" class="inline">
                @csrf
                <button type="submit" 
                        class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition text-sm font-semibold">
                    Setujui SPPH
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
