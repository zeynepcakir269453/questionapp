<?php

namespace App\Http\Controllers\front\question;

use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Auth;
use App\Models\Questions;
use App\Models\QuestionCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function create(){
        $category= Category::all();
        return view('front.question.create',['category'=>$category]);
    }

    public function store(Request $request){

        $request->validate([
            'title'=>'required',
            'text'=>'required'
        ]);

        $all=$request->except('_token');

        $category=$all['category'];
        unset($all['category']);

        $tags =explode(',',$all['tags']);
        unset($all['tags']);

        $all['userId']= Auth::id();
        $all['selflink']='www';
        $create=Questions::create($all);
        if($create){
         /* foreach($category as $k => $v){
            QuestionCategory::create(['questionId'=>$create->id,'categoryId'=>$v]);
          }*/
          return redirect()->back()->with('status','Soru Başarı ile Soruldu : /');

        }else{
            return redirect()->back()->with('status','Soru Sorulamadı : /');
        }

        dd($all);
    }
}
