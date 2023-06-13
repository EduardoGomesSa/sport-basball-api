<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'institution_id',
    ];

    public function getAll($filter = null){
        if($filter == null){
            return $this->paginate(10);
        }

        return $this->where('name', 'LIKE', "$filter%")->get();
    }

    public function institution(){
        return $this->belongsTo(Institution::class);
    }
}
