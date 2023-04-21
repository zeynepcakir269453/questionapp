<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    static function getCount($categoryId){
        return QuestionCategory::where('categoryId',$categoryId)->count();
    }

}
