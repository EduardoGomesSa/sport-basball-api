<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'league_id',
        'edition_id',
    ];

    public function league(){
        return $this->belongsTo(League::class);
    }

    public function editions(){
        return $this->hasMany(Edition::class);
    }
}
