<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // TODO: definisikan model produk anda disini
        protected $table = 'produks';

    public $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'kategori',
    ];
}
