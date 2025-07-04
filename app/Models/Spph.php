<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spph extends Model
{
    protected $table = 'spphs';
    protected $fillable = [
        'nama_pekerjaan', 'tanggal_penawaran', 'tanggal_penutupan', 'vendor_id', 'penyetuju_id', 'status', 'created_by'
    ];

    // Tambahkan relasi vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    // Tambahkan relasi penyetuju
    public function penyetuju()
    {
        return $this->belongsTo(User::class, 'penyetuju_id');
    }

    public function items()
    {
        return $this->hasMany(\App\Models\SpphItem::class, 'spph_id');
    }
}