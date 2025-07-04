@extends('layouts.dashboard')

@section('content')
<div class="px-8 pt-8">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h1 class="text-2xl font-extrabold mb-4">Draft: Surat Permintaan Penawaran Harga</h1>
        <div class="mb-4 border-b border-gray-300"></div>
        <form method="POST" action="{{ route('spph.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-semibold mb-1" for="nama_pekerjaan">Nama Pekerjaan</label>
                    <input type="text" id="nama_pekerjaan" name="nama_pekerjaan" class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none" placeholder="Nama Pekerjaan">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1" for="tanggal_penawaran">Tanggal Penawaran</label>
                    <input type="date" id="tanggal_penawaran" name="tanggal_penawaran" class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none" placeholder="Tanggal Penawaran">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1" for="tanggal_penutupan">Tanggal Penutupan</label>
                    <input type="date" id="tanggal_penutupan" name="tanggal_penutupan" class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none" placeholder="Tanggal Penutupan">
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-base font-bold mb-2">Deskripsi Barang</label>
                <div class="border border-gray-300 rounded overflow-x-auto mb-6" x-data="{
                    rows: [],
                    addRow() {
                        this.rows.push({
                            deskripsi: '', qty: '', satuan: '', keterangan: ''
                        });
                    },
                    removeRow(idx) {
                        this.rows.splice(idx, 1);
                    }
                }">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-300 bg-gray-100">
                                <th class="py-1 px-2 text-left w-8">No</th>
                                <th class="py-1 px-2 text-left w-1/3">Deskripsi Barang & Jasa</th>
                                <th class="py-1 px-2 text-left w-24">Quantity Order</th>
                                <th class="py-1 px-2 text-left w-24">Satuan Order</th>
                                <th class="py-1 px-2 text-left w-1/4">Keterangan Lainnya</th>
                                <th class="py-1 px-2 text-left w-12"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(row, idx) in rows" :key="idx">
                                <tr :class="idx % 2 === 1 ? 'bg-gray-50' : ''">
                                    <td class="py-1 px-2" x-text="idx + 1"></td>
                                    <td class="py-1 px-2">
                                        <input type="text" :name="'barang['+idx+'][deskripsi]'" x-model="row.deskripsi" class="w-full px-2 py-1 border border-gray-300 rounded text-sm" placeholder="Deskripsi">
                                    </td>
                                    <td class="py-1 px-2">
                                        <input type="number" min="1" :name="'barang['+idx+'][qty]'" x-model="row.qty" class="w-full px-2 py-1 border border-gray-300 rounded text-sm" placeholder="Qty">
                                    </td>
                                    <td class="py-1 px-2">
                                        <input type="text" :name="'barang['+idx+'][satuan]'" x-model="row.satuan" class="w-full px-2 py-1 border border-gray-300 rounded text-sm" placeholder="Satuan">
                                    </td>
                                    <td class="py-1 px-2">
                                        <input type="text" :name="'barang['+idx+'][keterangan]'" x-model="row.keterangan" class="w-full px-2 py-1 border border-gray-300 rounded text-sm" placeholder="Keterangan">
                                    </td>
                                    <td class="py-1 px-2 text-center">
                                        <button type="button" @click="removeRow(idx)" class="text-red-500 hover:underline text-xs">Hapus</button>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="rows.length === 0">
                                <td colspan="6" class="py-3 text-center text-gray-400">Belum ada barang, klik "Add Table" untuk menambah.</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="p-2 bg-gray-50 text-right">
                        <button type="button" @click="addRow()" class="px-3 py-1 text-sm bg-gray-200 rounded hover:bg-gray-300 transition">Add Table</button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-semibold mb-1" for="vendor">Pilih Vendor</label>
                    <select id="vendor" name="vendor" class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none">
                        <option value="">Pilihan Vendor</option>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1" for="penyetuju">Pilih Penyetuju Spesifik</label>
                    <select id="penyetuju" name="penyetuju" class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none" required>
                        <option value="">-- Pilih Penyetuju yang Akan Mengapprove --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} (Approver)</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end justify-end mt-2 md:mt-0">
                    <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition text-sm font-semibold">Ajukan Draft SPPH</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
