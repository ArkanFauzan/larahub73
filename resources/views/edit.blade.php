@extends('layouts.master')
@push('script-head')
<script src="https://cdn.tiny.cloud/1/qjvmcn9ayqiy33ts51urklmpnfrk7du450ywpxzxtv478g4q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endpush
@section('content')

<div class="container">
    <form method="POST" action="/questions/{{$question->id}}">
      @csrf
      @method('PUT')
        <div class="row justify-content-md-center">
        <div class="col-md-8">
            <label class="mt-4" for="isi">Title</label>
            <input class="form-control" id="isi" name="title" value="{{$question->title}}">
    
            <label class="mt-4" for="isi">Tag</label>
            @php
                foreach ($question->tag as $value) {
                  $arr[] = $value->tag_name;
                }
                $tagnya = implode(', ', $arr);
            @endphp
            
            <input class="form-control" id="isi" name="tag" value="{{$tagnya}}">
            <label class="mt-4" for="isi">Content</label>
            <textarea class="form-control my-editor" id="isi" name="content">{{$question->content}}</textarea>
            <button type="submit" class="btn btn-primary float-right mt-4">Update</button>
        </div>
        </div>
    </form>
</div>

@endsection

@push('script-body')
<script>
    var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endpush