<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    use HasFactory;
    protected $fillable = ['gallery_id', 'user_id', 'category_id', 'title', 'description', 'status'];

    public function tags(){
        return $this->belongsToMany(tags::class);
    }
    
    public function category(){
        return $this->belongsTo(categories::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function gallery(){
        return $this->belongsTo(Gallery::class);
    }
}
