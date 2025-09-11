<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'status'];

    public function tags(){
        return $this->belongsToMany(tags::class);
    }
}
