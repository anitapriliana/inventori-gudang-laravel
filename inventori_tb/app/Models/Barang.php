<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'kategori',
        'nama_barang',
        'merk',
        'stok',
        'satuan',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
