<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $guarded = [];
    
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }    
}
