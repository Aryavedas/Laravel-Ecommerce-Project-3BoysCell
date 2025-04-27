<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Keranjang extends Model
{
    protected $guarded = [];

    // Relasi ke User (Setiap keranjang dimiliki oleh satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Barang (Setiap keranjang memiliki satu barang)
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'keranjang_id');
    }
}