<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sentimental extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name'
    ];

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class,  'sentimental_id', 'id');
    }
}
