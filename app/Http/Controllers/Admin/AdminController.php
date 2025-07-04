<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalApprovers = User::where('role', 'approver')->count();
        $totalVendors = Vendor::count();
        
        return view('admin.dashboard', compact('totalUsers', 'totalApprovers', 'totalVendors'));
    }

    // Approver Management
    public function approverManagement()
    {
        $users = User::where('role', 'user')->get();
        $approvers = User::where('role', 'approver')->get();
        
        return view('admin.approver-management', compact('users', 'approvers'));
    }

    public function makeApprover(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->update(['role' => 'approver']);

        return redirect()->back()->with('success', 'User berhasil dijadikan approver!');
    }

    public function removeApprover(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->update(['role' => 'user']);

        return redirect()->back()->with('success', 'Approver berhasil dikembalikan menjadi user!');
    }

    // Vendor Management
    public function vendorManagement()
    {
        $vendors = Vendor::orderBy('created_at', 'desc')->get();
        return view('admin.vendor-management', compact('vendors'));
    }

    public function storeVendor(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string',
            'contact_person' => 'required|string|max:255',
        ]);

        Vendor::create([
            'nama_vendor' => $request->nama_vendor,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'contact_person' => $request->contact_person,
            'status' => 'active'
        ]);

        return redirect()->back()->with('success', 'Vendor berhasil ditambahkan!');
    }

    public function updateVendor(Request $request, $id)
    {
        $request->validate([
            'nama_vendor' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());

        return redirect()->back()->with('success', 'Vendor berhasil diupdate!');
    }

    public function deleteVendor($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->back()->with('success', 'Vendor berhasil dihapus!');
    }
}
