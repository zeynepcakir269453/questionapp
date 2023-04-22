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
                <a href="{{ route('view',['selflink'=>$v['selflink'],'id'=>$v['id']])}}" class="mt-0 mb-1">{{$v['title']}}</a> - {{$v['created_at']}}
              </div>
                <div class="description">
                  {{$v['text']}}
                </div>
              <div class="detail">
               <a href="">{{\App\Models\Comments::getCount($v[0]['id'])}} Yorum</a> - <a href="">101 Görüntülenme</a> -<a href="{{ route('view',['selflink'=>$v['selflink'],'id'=>$v['id']] )}}">Devamını Oku</a> 
              </div>

              </div>
            </li>
          @endforeach
          </ul>
          {!! $data->links()!!}
        </div>
        <div class="col-md-4">
          @include('sidebar.app')
        </div>
    </div>
</div>
@endsection
