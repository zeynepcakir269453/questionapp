<?php

namespace App\Http\Controllers\front\comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Comments;
use App\Models\LikeComment;
use Auth;

class indexController extends Controller
{
    public function store(Request $request){

        $request->validate(['text'=>'required']);
        $id=$request->route('id');
        $c=Questions::where('id',$id)->count();

        if($c!=0){
             $all=$request->except('_token');

             $w=Questions::where('id',$id)->get();
             $control=Comments::where('questionId',$id)->count();
             if($control!=0){
                $wcontrol=Comments::where('questionId',$id)->orderBy('id','desc')->limit(1)->get();
                if($wcontrol[0]['userId']==Auth::id()){
                    return  redirect()->back()->with('status','Üst üste yorum yapamazsın');
                }
             }
             $all['userId']=Auth::id();
             $all['questionId']=$id;
             $create=Comments::create($all);
             if($create){
                return  redirect()->back()->with('status','Yorum başarıyla eklendi');
             }else{
                return  redirect()->back()->with('status','Yorum Ekelnemedi');
             }
            
        } else{
            abort(404);
         }
    }

    public function likeOrDislike($id){
      $c=Comments::where('id',$id)->count();
      if($c!=0){
         $v=Comments::where('id',$id)->get();
         if($w[0]['userId']=Auth::id()){
            return redirect()->back();
         }
       $control=LikeComment::where('commentId',$id)->where('userId',Auth::id())->count();
       if($control==0){
         LikeComment::create(['commentId'=>$id,'userId'=>Auth::id()]);
       }else{
         LikeComment::where('commentId',$id)->where('userId',Auth::id())->delete();
       }
       return redirect()->back();

      }else{
         abort(404);
      }
    }

    public function delete($id){
      $c= Comments::where('id',$id)->where('userId',Auth::id())->count();
      if($c!=0){
         Comments::where('id',$id)->where('userId',Auth::id())->delete();
         LikeComment::where('commentId',$id)->delete();
         return redirect()->back();
      }else{
         abort(404);
      }
    }

    public function correct($id){
      $c= Comments::where('id',$id)->count();
      if($c!=0){
         $w=Comments::where('id',$id)->get();
         $data=Questions::where('id',$w[0]['questionId'])->get();
         if($data[0]['userId']==Auth::id()){
            $control=Comments::where('questionId',$data[0]['id'])->where('isCorrect',1)->count();
            if($control==0){
               Comments::where('id',$id)->update(['isCorrect'=>1]);
               return redirect()->back();
            }

         }else{
            abort(404);
         }

         return redirect()->back();
      }else{
         abort(404);
      }
    }
}
