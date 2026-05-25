<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';

    protected $fillable = [
        'barang_id',
        'proyek_id',
        'jumlah',
        'tanggal',
        'keterangan',
        'status',
        'alasan'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // relasi satu barang_keluar dimiliki satu proyek
    public function proyek()
    {
        return $this->belongsTo(Proyek::class);
    }
}
