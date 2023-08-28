<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    public function getAll($filter = null){
        if($filter == null){
            return $this->paginate();
        }

        return $this->where('name', 'LIKE', "$filter%")->paginate();
    }

    public function leagues(){
        return $this->hasMany(League::class);
    }
}
