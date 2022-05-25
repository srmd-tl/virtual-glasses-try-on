<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Glasses extends Model
{
    use HasFactory;

    public function img():Attribute
    {
        return Attribute::make(
            get: fn ($value) => env('APP_URL').'/storage/'.$value,
        );
    }

}
