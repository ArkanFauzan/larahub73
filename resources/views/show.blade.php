@extends('layouts.master')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section('content')

<div class="container">
    <div class="card mt-4">
            <div class="card-header">
                Title:&nbsp&nbsp&nbsp&nbsp{{$question->title}}
            </div>
            <div class="card-body" style="padding-right: 0px;">
                <div class="row">
                    <div class="col-1 border-right">
                        <p>Vote: </p>
                        <form action="/questions/{{$question->id}}/voteup" method="post">
                            @csrf
                            <button class="btn btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br>
                        </form>
                        <form action="/questions/{{$question->id}}/votedown" method="post">
                            @csrf
                            <button class="btn btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                        </form>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title mb-4">Posted by: {{$question->user->name}} </h5>
                        <p class="card-text">Content: <br>{!!$question->content!!}</p>
                        <?php 
                            $misah = explode(", ", $question->tag);
                            foreach ($misah as $ms){
                                echo '<button class="btn btn-success mt-4">' . $ms . '</button>' . ' ';
                            }
                        ?>
                    </div>
                    <div class="col-3 border-left">
                        <p>Created at: {{$question->created_at}}</p>
                        <p>Updated at: {{$question->updated_at}}</p>
                    </div>
                </div>
            </div>
    </div>
    <h4 class="mt-4 ml-4">Answers:</h4>

    <div class="col">
        @foreach ($answers as $jawab)
        <div class="row ml-4" style="">
            <div class="card mb-4" style="width: 100%;">
                <div class="card-body">
                    <p class="card-text" style="display: inline">{!! $jawab->content !!}</p>
                    <p>Answered By: {{$jawab->user->name}}  </p>
                    <p>Comments:</p>

                    {{-- menampilkan comment2 untuk setiap jawaban --}}
                    @foreach ($jawab->comment as $comment)
                        <p class="my-0 border-top border-bottom">{{$comment->user->name}} : {{$comment->content}}</p>
                    @endforeach

                    <form class="form" action="/comment/{{$jawab->id}}" method="post">
                        @csrf
                        <div class="form-row d-flex justify-content-end">
                            
                            <div class="col-7">
                                <input type="text" class="form-control mt-4" name="comment" placeholder="Tambahkan Komentar">
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary mt-4" style=""><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>      
        </div>
        @endforeach
    </div>
    <h4 class="mt-4 ml-4">Berikan Jawaban Anda:</h4>
    <form action="/questions/{id}" method="post">
        @csrf
        <div class="form-group">
        <textarea class="form-control my-editor" name="content">{!! old('content', $content ?? '') !!}</textarea>
        <input type="hidden" name="question_id" value="{{$question->id}}">
        </div>
        <button type="submit" class="btn btn-primary" style="">Submit</button>
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