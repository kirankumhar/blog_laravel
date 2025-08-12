<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    //
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'categories_id', // foreign key
        'status',
    ];


    /**
     * Relationship: Blog belongs to a Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

}
