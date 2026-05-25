<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

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

    // riwayat barang masuk (FK: barang_masuk.barang_id)
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    // riwayat barang keluar (FK: barang_keluar.barang_id)
    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }

    public function getKategoriDisplayAttribute(): string
    {
        if (!empty($this->kategori_id) && $this->kategoriData) {
            return $this->kategoriData->nama_kategori;
        }

        return $this->kategori ?: '-';
    }
}
