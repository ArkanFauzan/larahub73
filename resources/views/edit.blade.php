@extends('layouts.master')

@section('content')

<div class="container">
    <form method="POST" action="/questions/{{$question->id}}">
      @csrf
      @method('PUT')
        <div class="row justify-content-md-center">
        <div class="col-md-8">
            <label class="mt-4" for="isi">Title</label>
            <input class="form-control" id="isi" name="title" value="{{$question->title}}">
    
            <label class="mt-4" for="isi">Content</label>
            <textarea class="form-control" id="isi" name="content">{{$question->content}}"</textarea>
    
            <button type="submit" class="btn btn-primary float-right mt-4">Update</button>
    
        </div>
        </div>
    </form>
</div>

@endsection