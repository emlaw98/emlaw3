<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'category_id',
        'title',
        'image',
        'content',
    ];
    public function imageUrl(){
        return '/image/news/'.$this->image;
    }
    public function category(){
        return $this->belongsTo(Categories::class, 'category_id','id');
    }
}
