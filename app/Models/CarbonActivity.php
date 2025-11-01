<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarbonActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'type',
        'name',
        'emission',
        'details'
    ];

    protected $casts = [
        'date' => 'date',
        'emission' => 'decimal:2',
        'details' => 'array'
    ];

    public static function emissionFactors()
    {
        return [
            'motor' => 0.15,
            'mobil' => 0.25,
            'busway' => 0.05,
            'kereta' => 0.04,
            'sepeda' => 0,
            'daging_sapi' => 27,
            'daging_ayam' => 6.9,
            'ikan' => 5.1,
            'vegetarian' => 2.0,
            'ac_per_hour' => 0.9,
            'tv_per_hour' => 0.1
        ];
    }
}