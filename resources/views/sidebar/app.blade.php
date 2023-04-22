<ul class="list-group">
         @foreach(\App\Models\Category::all() as $k => $v)
         <a href="{{ route('index',['selflink'=>$v['selflink']] )}}">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{$v['name']}} 
            <span class="badge badge-primary badge-pill">{{\App\Models\QuestionCategory::getCount($v['id'])}}</span> 
          </li></a>
          @endforeach
</ul>