<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'nama_vendor',
        'email',
        'phone',
        'alamat',
        'contact_person',
        'status'
    ];

    /**
     * Get the SPPHs associated with the vendor.
     */
    public function spphs()
    {
        return $this->hasMany(Spph::class);
    }
}
