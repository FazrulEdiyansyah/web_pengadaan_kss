@extends('layouts.admin')

@section('content')
<div class="px-8 pt-8">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h1 class="text-2xl font-extrabold mb-6">Vendor Management</h1>
        
        <!-- Add Vendor Form -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Tambah Vendor Baru</h2>
            <form action="{{ route('admin.vendor.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Vendor</label>
                        <input type="text" name="nama_vendor" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" required rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Person</label>
                        <input type="text" name="contact_person" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        Tambah Vendor
                    </button>
                </div>
            </form>
            </div>
        </div>

        <!-- Vendors List -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Daftar Vendor</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Nama Vendor</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($vendors as $vendor)
                            <tr>
                                <td class="px-4 py-3">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $vendor->nama_vendor }}</div>
                                        <div class="text-sm text-gray-500">{{ $vendor->email }}</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div>
                                        <div class="text-sm text-gray-900">{{ $vendor->contact_person }}</div>
                                        <div class="text-sm text-gray-500">{{ $vendor->phone }}</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm text-gray-900">{{ $vendor->alamat }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($vendor->status === 'active')
                                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                            Active
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button onclick="editVendor({{ $vendor->id }})" 
                                                class="px-3 py-1 text-blue-600 hover:text-blue-800">
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('admin.vendor.delete', $vendor->id) }}" 
                                              onsubmit="return confirm('Yakin ingin menghapus vendor ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 text-red-600 hover:text-red-800">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                    Belum ada vendor yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Edit Vendor Modal -->
<div id="editVendorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg w-full max-w-2xl mx-4">
        <div class="p-6">
            <h3 class="text-lg font-semibold mb-4">Edit Vendor</h3>
            <form id="editVendorForm" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Vendor</label>
                        <input type="text" name="nama_vendor" id="edit_nama_vendor" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="edit_email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" id="edit_phone" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Person</label>
                        <input type="text" name="contact_person" id="edit_contact_person" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" id="edit_alamat" required rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="edit_status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Update Vendor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editVendor(id) {
    // Fetch vendor data and populate form
    fetch(`/admin/vendor/${id}`)
        .then(response => response.json())
        .then(vendor => {
            document.getElementById('edit_nama_vendor').value = vendor.nama_vendor;
            document.getElementById('edit_email').value = vendor.email;
            document.getElementById('edit_phone').value = vendor.phone;
            document.getElementById('edit_contact_person').value = vendor.contact_person;
            document.getElementById('edit_alamat').value = vendor.alamat;
            document.getElementById('edit_status').value = vendor.status;
            
            document.getElementById('editVendorForm').action = `/admin/vendor/${id}`;
            document.getElementById('editVendorModal').classList.remove('hidden');
            document.getElementById('editVendorModal').classList.add('flex');
        });
}

function closeEditModal() {
    document.getElementById('editVendorModal').classList.add('hidden');
    document.getElementById('editVendorModal').classList.remove('flex');
}
</script>
@endpush
@endsection
