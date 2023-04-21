@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          @if(session("status"))
            <div class="alert alert-success">{{session("status")}}</div>
          @endif
            <div class="card">
                <div class="card-header">Yeni Soru Sor</div>

                <div class="card-body">
                    <form method="POST" action="{{route('question.store')}}">
                        @csrf
                      <div class="form-group row">
                        <div class="col-mb-12">
                            <label>Soru Başlığı</label>
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>
                    
                      <div class="form-group row">
                      <div class="col-md-12">
                      <label>Kategory Seçimi</label>
                      <div class="row">
                      @foreach($category as $key => $value)
                      <div class="col-md-3 m-checkbox">
                      {{ $value['name'] }}
                      <input type="checkbox" name="category[]" value="{{ $value['id'] }}">
                      </div>
                      @endforeach
                      </div>
                     </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-12">
                          <label>Sorunuz</label>
                          <textarea name="text" id="text" cols="30" rows="10"></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-12">
                          <label>Etiketler</label>
                          <input type="text" name="tags"  class="form-control"></input>
                        </div>
                      </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Soru Sor
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection