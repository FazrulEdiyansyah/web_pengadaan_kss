@extends('layouts.dashboard')

@section('content')
<div class="px-8 pt-8">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h1 class="text-2xl font-extrabold mb-4">Detail SPPH</h1>
        <div class="mb-4 border-b border-gray-300"></div>
        <form>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Pekerjaan</label>
                    <input type="text" class="w-full px-2 py-1 border border-gray-300 rounded text-sm bg-gray-100" value="{{ $spph->nama_pekerjaan }}" readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Tanggal Penawaran</label>
                    <input type="date" class="w-full px-2 py-1 border border-gray-300 rounded text-sm bg-gray-100" value="{{ $spph->tanggal_penawaran }}" readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Tanggal Penutupan</label>
                    <input type="date" class="w-full px-2 py-1 border border-gray-300 rounded text-sm bg-gray-100" value="{{ $spph->tanggal_penutupan }}" readonly>
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-base font-bold mb-2">Deskripsi Barang</label>
                <div class="border border-gray-300 rounded overflow-x-auto mb-6">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-300 bg-gray-100">
                                <th class="py-1 px-2 text-left w-8">No</th>
                                <th class="py-1 px-2 text-left w-1/3">Deskripsi Barang & Jasa</th>
                                <th class="py-1 px-2 text-left w-24">Quantity Order</th>
                                <th class="py-1 px-2 text-left w-24">Satuan Order</th>
                                <th class="py-1 px-2 text-left w-1/4">Keterangan Lainnya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($spph->items as $i => $item)
                            <tr class="{{ $i % 2 === 1 ? 'bg-gray-50' : '' }}">
                                <td class="py-1 px-2">{{ $i+1 }}</td>
                                <td class="py-1 px-2">
                                    <input type="text" class="w-full px-2 py-1 border border-gray-200 rounded text-sm bg-gray-100" value="{{ $item->deskripsi }}" readonly>
                                </td>
                                <td class="py-1 px-2">
                                    <input type="number" class="w-full px-2 py-1 border border-gray-200 rounded text-sm bg-gray-100" value="{{ $item->qty }}" readonly>
                                </td>
                                <td class="py-1 px-2">
                                    <input type="text" class="w-full px-2 py-1 border border-gray-200 rounded text-sm bg-gray-100" value="{{ $item->satuan }}" readonly>
                                </td>
                                <td class="py-1 px-2">
                                    <input type="text" class="w-full px-2 py-1 border border-gray-200 rounded text-sm bg-gray-100" value="{{ $item->keterangan }}" readonly>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-3 text-center text-gray-400">Tidak ada barang.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-semibold mb-1">Pilih Vendor</label>
                    <input type="text" class="w-full px-2 py-1 border border-gray-300 rounded text-sm bg-gray-100" value="{{ $spph->vendor->name ?? '-' }}" readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Pilih Penyetuju</label>
                    <input type="text" class="w-full px-2 py-1 border border-gray-300 rounded text-sm bg-gray-100" value="{{ $spph->penyetuju->name ?? '-' }}" readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Status</label>
                    <input type="text" class="w-full px-2 py-1 border border-gray-300 rounded text-sm bg-gray-100" value="{{ ucfirst($spph->status) }}" readonly>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection