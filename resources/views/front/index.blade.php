@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
        <ul class="list-unstyled">
          @foreach($data as $k => $v)
            <li class="media">
              <img class="mr-3" src="..." alt="Generic placeholder image">
              <div class="media-body">
                <div class="title">
                <a href="#" class="mt-0 mb-1">{{$v['title']}}</a> - {{$v['created_at']}}
              </div>
                <div class="description">
                  {{$v['text']}}
                </div>
              <div class="detail">
               <a href="">1 Yorum</a> - <a href="">101 Görüntülenme</a> -<a href="">Devamını Oku</a> 
              </div>

              </div>
            </li>
          @endforeach
          </ul>
          {!! $data->links()!!}
        </div>
        <div class="col-md-4">
        <ul class="list-group">
         @foreach(\App\Models\Category::all() as $k => $v)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{$v['name']}}
            <span class="badge badge-primary badge-pill">{{\App\Models\QuestionCategory::getCount($v['id'])}}</span>
          </li>
          @endforeach
        </ul>
        </div>
    </div>
</div>
@endsection
