<?php

namespace App\Http\Controllers;

use App\Models\Spph;
use App\Models\SpphItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpphController extends Controller
{
    public function create()
    {
        return view('spph.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'tanggal_penawaran' => 'required|date',
            'tanggal_penutupan' => 'required|date',
            'vendor' => 'nullable',
            'penyetuju' => 'required',
            'barang' => 'required|array|min:1',
            'barang.*.deskripsi' => 'required|string',
            'barang.*.qty' => 'required|integer',
            'barang.*.satuan' => 'required|string',
            'barang.*.keterangan' => 'nullable|string',
        ]);

        $spph = Spph::create([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'tanggal_penawaran' => $request->tanggal_penawaran,
            'tanggal_penutupan' => $request->tanggal_penutupan,
            'vendor_id' => $request->vendor,
            'penyetuju_id' => $request->penyetuju,
            'status' => 'draft',
            'created_by' => Auth::id(),
        ]);

        foreach ($request->barang as $item) {
            SpphItem::create([
                'spph_id' => $spph->id,
                'deskripsi' => $item['deskripsi'],
                'qty' => $item['qty'],
                'satuan' => $item['satuan'],
                'keterangan' => $item['keterangan'] ?? null,
            ]);
        }

        return redirect()->route('spph.create')->with('success', 'Draft SPPH berhasil disimpan!');
    }

    public function overview()
    {
        $spphs = \App\Models\Spph::with(['vendor', 'penyetuju'])->orderBy('created_at', 'desc')->get();
        return view('spph.overview', compact('spphs'));
    }

    public function show($id)
    {
        $spph = \App\Models\Spph::with(['vendor', 'penyetuju'])->findOrFail($id);
        return view('spph.show', compact('spph'));
    }
}