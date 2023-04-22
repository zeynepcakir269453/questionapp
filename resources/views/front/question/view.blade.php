@extends('layouts.app')

@section('content')
<div class="container">
@if(session("status"))
            <div class="alert alert-success">{{session("status")}}</div>
          @endif
    <div class="row">
        <div class="col-md-8">
        <ul class="list-unstyled">
            <li class="media">
              <img class="mr-3" src="..." alt="Generic placeholder image">
              <div class="media-body">
                <div class="title">
                <a href="#" class="mt-0 mb-1">{{$data[0]['title']}}</a> - {{$data[0]['created_at']}}
              </div>
                <div class="description">
                </div>
              <div class="detail">
               <a href="">{{\App\Models\Comments::getCount($data[0]['id'])}} Yorum</a> - <a href="">101 Görüntülenme</a>
               @if(Auth::id()==$data[0]['userId'])
               <a href="#">Düzenle</a> - <a href="">Sil</a>
               @endif
              </div>

              </div>
            </li>
          </ul>
          <div class="category--title">CEVAPLAR</div>
         @if(\App\Models\Comments::getCount($data[0]['id'])!=0)
         <ul class="list-unstyled">
           @foreach($comments as $k => $v )
           <li class="media">
              <img class="mr-3" src="..." alt="Generic placeholder image">
              <div class="media-body">
                <div class="title">
                <a href="#" class="mt-0 mb-1">{{\App\Models\User::getName($v['userId'])}}</a> - {{$v['created_at']}}
                @if  ($v['isCorrect']==1)
                @endif
                <span class="isCorrect">Doğru Cevap</span>
              </div>
                <div class="description">
                  {{$v['text']}}
                </div>
              <div class="detail">
              @if  (\Illuminate\Support\Facades\Auth::id()!=$v['userId'])
               <a href="{{ route('comment.likeordislike',['id'=>$v['id']])}}">Begen ({{\App\Models\LikeComment::getCount($v['id'])}}) </a>
             @else
              <a href="{{ route('comment.delete',['id'=>$v['id']])}}">Sil</a>
              @endif
               @if(\Illuminate\Support\Facades\Auth::id()==$data[0]['userId'] and \App\Models\Comments::isCorrectVariable($data[0]['id']==0) )
                 <a href="{{ route('comment.correct',['id'=>$v['id']])}}">Bu Cevap Doğru</a>
               @endif
              </div>

              </div>
            </li>
           @endforeach
        </ul>
        @else
        <div class="alert alert-info">Henüz cevap yazılmamış ilk olmak istermisin...</div>
         @endif
          <div class="card">
                <div class="card-header">Cevap Yaz</div>

                <div class="card-body">
                    <form method="POST" action="{{route('comment.store',['id'=>$data[0]['id']])}}">
                        @csrf

                      <div class="form-group row">
                        <div class="col-md-12">
                          <label>Cevabınız</label>
                          <textarea name="text" id="text" cols="30" rows="10"></textarea>
                        </div>
                      </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Cevap Ver
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-4">
        @include('sidebar.app')
        </div>
    </div>
</div>
@endsection
