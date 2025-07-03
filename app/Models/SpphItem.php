<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpphItem extends Model
{
    protected $table = 'spph_items';
    protected $fillable = [
        'spph_id', 'deskripsi', 'qty', 'satuan', 'keterangan'
    ];
}