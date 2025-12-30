<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id'];

    // Relation: Quiz belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation: Quiz has many MCQs
    public function mcqs()
    {
        return $this->hasMany(Mcqs::class);
    }
}
