<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\BarangMasuk;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'merk',
        'supplier',
        'kategori',
        'kategori_id',
        'stok',
        'satuan',
        'gambar', // opsional
    ];

    public function kategoriData()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function getKategoriDisplayAttribute(): string
    {
        if (!empty($this->kategori_id) && $this->kategoriData) {
            return $this->kategoriData->nama_kategori;
        }

        return $this->kategori ?: '-';
    }
}
