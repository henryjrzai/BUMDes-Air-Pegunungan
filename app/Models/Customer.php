<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeUnit\FunctionUnit;

class Customer extends Model
{
    use HasFactory;

    public function waterTarif()
    {
        return $this->belongsTo(WaterTarif::class);
    }
}
