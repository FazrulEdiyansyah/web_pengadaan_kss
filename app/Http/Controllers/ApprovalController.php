<?php

namespace App\Http\Controllers;

use App\Models\Spph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    /**
     * Tampilkan daftar SPPH yang hanya ditujukan untuk user yang sedang login sebagai penyetuju
     */
    public function index()
    {
        // Pastikan user memiliki role approver
        if (Auth::user()->role !== 'approver') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman approval.');
        }

        // Hanya tampilkan SPPH yang SECARA SPESIFIK memilih user ini sebagai penyetuju
        $spphs = Spph::with(['vendor', 'penyetuju', 'items'])
                    ->where('penyetuju_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('approval.index', compact('spphs'));
    }

    /**
     * Tampilkan detail SPPH yang hanya ditujukan untuk user yang sedang login
     */
    public function show($id)
    {
        // Pastikan user memiliki role approver
        if (Auth::user()->role !== 'approver') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman approval.');
        }

        // Hanya bisa melihat SPPH yang SECARA SPESIFIK memilih user ini sebagai penyetuju
        $spph = Spph::with(['vendor', 'penyetuju', 'items'])
                   ->where('penyetuju_id', Auth::id())
                   ->findOrFail($id);
        
        return view('approval.show', compact('spph'));
    }

    /**
     * Approve SPPH - hanya bisa dilakukan oleh penyetuju yang dipilih
     */
    public function approve(Request $request, $id)
    {
        // Pastikan user memiliki role approver
        if (Auth::user()->role !== 'approver') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses untuk melakukan approval.');
        }

        // Cari SPPH yang SECARA SPESIFIK memilih user ini sebagai penyetuju
        $spph = Spph::where('penyetuju_id', Auth::id())->findOrFail($id);
        
        // Validasi tambahan: pastikan SPPH masih bisa diapprove
        if (!in_array($spph->status, ['draft', 'submitted'])) {
            return redirect()->route('approval.index')->with('error', 'SPPH ini sudah tidak bisa diapprove lagi.');
        }

        $spph->update([
            'status' => 'approved'
        ]);

        return redirect()->route('approval.index')->with('success', 'SPPH berhasil disetujui!');
    }

    /**
     * Reject SPPH - hanya bisa dilakukan oleh penyetuju yang dipilih
     */
    public function reject(Request $request, $id)
    {
        // Pastikan user memiliki role approver
        if (Auth::user()->role !== 'approver') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses untuk melakukan rejection.');
        }

        $request->validate([
            'rejection_reason' => 'nullable|string|max:500'
        ]);

        // Cari SPPH yang SECARA SPESIFIK memilih user ini sebagai penyetuju
        $spph = Spph::where('penyetuju_id', Auth::id())->findOrFail($id);
        
        // Validasi tambahan: pastikan SPPH masih bisa direject
        if (!in_array($spph->status, ['draft', 'submitted'])) {
            return redirect()->route('approval.index')->with('error', 'SPPH ini sudah tidak bisa direject lagi.');
        }

        $spph->update([
            'status' => 'rejected'
        ]);

        return redirect()->route('approval.index')->with('success', 'SPPH berhasil ditolak!');
    }
}
