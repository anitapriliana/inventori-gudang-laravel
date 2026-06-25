<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    // kasih tau Laravel nama tabelnya
    protected $table = 'barang_masuk';

    protected $fillable = ['barang_id', 'merk', 'jumlah', 'tanggal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
