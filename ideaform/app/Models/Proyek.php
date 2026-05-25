<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    // kolom yang boleh diisi lewat create()/update()
    protected $fillable = [
        'nama_proyek',
        'lokasi',
        'tanggal_mulai',
        'keterangan',
    ];

    // relasi: satu proyek punya banyak barang_keluar
    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }
}
