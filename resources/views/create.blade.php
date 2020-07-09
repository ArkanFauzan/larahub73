@extends('layouts.master')

@section('content')

<div class="container">
  <form action="/questions" method="post">
    @csrf
  <div class="row justify-content-md-center">
    <div class="col-md-8">
      <label class="mt-4" for="isi">Title</label>
      <input class="form-control" id="isi" name="title" placeholder="Enter Title">

      <label class="mt-4" for="isi">Tag</label>
      <input class="form-control" id="isi" name="tag" placeholder="Enter Tag (*Separate with comma, ex: Tag1, Tag2)">

      <label class="mt-4" for="isi">Content</label>
      <textarea class="form-control" id="isi" name="content" placeholder="Enter Content"></textarea>

      <button type="submit" class="btn btn-primary float-right mt-4">Submit</button>

    </div>
  </div>
  </form>
</div>


@endsection