<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'title', 'slug', 'description', 'url', 'category_id'];

        public function category()
        {
            return $this->belongsTo(Category::class);
        }

        public function technologies()
        {
            return $this->belongsToMany(Technology::class);
        }

}

