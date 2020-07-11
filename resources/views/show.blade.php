@extends('layouts.master')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    function alertVote(){
        window.alert('Maaf, anda tidak bisa vote milik anda sendiri');
    }
    function udahVote(){
        window.alert('Maaf, anda hanya bisa melakukan satu kali vote!');
    }
    function kurangPoin(){
        window.alert('Maaf, anda membutuhkan 15 poin dulu untuk melakukan downvote');
    }
    function jawabSendiri(){
        window.alert('Maaf, anda tidak bisa menjawab pertanyaan anda sendiri');
    }

</script>
@endpush
@section('content')

<?php $Auth_user_id = isset(Auth::user()->id) ? Auth::user()->id : false ;?>

<div class="container">
    <div class="card mt-4">
            <div class="card-header">
                Judul:&nbsp&nbsp&nbsp&nbsp{{$question->title}}
            </div>
            <div class="card-body" style="padding-right: 0px;">
                <div class="row">
                    <div class="col-1 border-right">
                        <p>Vote: {{$question->votes->sum('upvote')-$question->votes->sum('downvote')}} </p>

                        {{-- mengecek apakah user yg login sudah votes untuk pertanyaan tersebut atau belum --}}
                        <?php $sudah_votes=false;?>
                        @foreach ($question->votes as $votes)
                            @if ($votes->user_id==$Auth_user_id)
                                <?php $sudah_votes=true ;?>
                            @endif
                        @endforeach

                        {{-- jika sudah votes atau pertanyaan tersebut dia sendiri yg buat, 
                            maka tampilkan button tanpa submit (seperti button disabled) --}}
                        @if ($question->user_id===$Auth_user_id)
                            <button class="btn btn-secondary" onclick="alertVote()"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br>
                            <button class="btn btn-secondary" onclick="alertVote()"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                        @elseif ($sudah_votes==true)
                            <button class="btn btn-secondary" onclick="udahVote()"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br>
                            <button class="btn btn-secondary" onclick="udahVote()"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                        @else
                            <form action="/upvote/question/{{$question->id}}" method="post">
                                @csrf
                                <button class="btn btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br>
                            </form>

                            {{-- jika point user kurang dari 15, maka tidak bisa downvote, tampilkan button disabled --}}
                            @if (Auth::user() !== null)
                                @if (Auth::user()->point->point < 15)
                                    <button class="btn btn-secondary" onclick="kurangPoin()"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                                @else
                                    <form action="/downvote/question/{{$question->id}}" method="post">
                                        @csrf
                                        <button class="btn btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                                    </form>
                                @endif
                            @else
                                <form action="/downvote/question/{{$question->id}}" method="post">
                                    @csrf
                                    <button class="btn btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                                </form>
                            @endif
                        @endif
                        
                    </div>
                    <div class="col-8">
                        <h5 class="card-title mb-4">Diposting oleh: {{$question->user->name}} </h5>
                        <p class="card-text">Isi: <br>{!!$question->content!!}</p>
                        @foreach ($question->tag as $tag)
                            <button class="btn btn-success">{{$tag->tag_name}}</button>
                        @endforeach
                    </div>
                    <div class="col-3 border-left">
                        <p>Tanggal dibuat: {{$question->created_at}}</p>
                        <p>Tanggal diubah: {{$question->updated_at}}</p>
                    </div>
                </div>

                <div class="card-body">
                    <p>Komentar:</p>
                    @foreach ($question->comment as $comment)
                        <p class="my-0 border-top border-bottom">{{$comment->user->name}} : {{$comment->content}}</p>
                    @endforeach
                    <form class="form" action="/comment/question/{{$question->id}}" method="post">
                        @csrf
                        <div class="form-row mt-4 d-flex justify-content-end">
                            
                            <div class="col-7">
                                <input type="text" class="form-control" name="comment" placeholder="Tambahkan Komentar">
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary" style=""><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <h4 class="mt-4 ml-4">Jawaban:</h4>
    <div class="col">
        {{-- looping ketika question tidak ada jawaban terbaik --}}
        @if ($question->correct_answer == null)
            @foreach ($answers as $jawab)
            <div class="row ml-4" style="">
                <div class="card mb-4" style="width: 100%;">
                    <div class="card-body">
                        <div class="row border-bottom">
                            <div class="col-1 mb-4">
                                <p>vote: {{$jawab->votes->sum('upvote')-$jawab->votes->sum('downvote')}} </p>

                                {{-- mengecek apakah user yg login sudah votes untuk pertanyaan tersebut atau belum --}}
                                <?php $sudah_votes=false;?>
                                
                                @foreach ($jawab->votes as $votes)
                                    @if ($votes->user_id==$Auth_user_id)
                                        <?php $sudah_votes=true ;?>
                                    @endif
                                @endforeach

                                {{-- jika sudah votes atau jawaban tersebut dia sendiri yg buat, 
                                    maka tampilkan button tanpa submit (seperti button disabled) --}}
                                @if ($jawab->user_id===$Auth_user_id)
                                    <button class="btn btn-secondary" onclick="alertVote()"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br>
                                    <button class="btn btn-secondary" onclick="alertVote()"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                                @elseif($sudah_votes==true)
                                    <button class="btn btn-secondary" onclick="udahVote()"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br>
                                    <button class="btn btn-secondary" onclick="udahVote()"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                                @else
                                    <form action="/upvote/answer/{{$jawab->id}}" method="post">
                                        @csrf
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br/>
                                    </form>

                                    <form action="/downvote/answer/{{$jawab->id}}" method="post">
                                        @csrf
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button><br/>
                                    </form>
                                @endif
                                
                            </div>
                            <div class="col-9 border-left">
                                <p class="card-text" style="display: inline">{!! $jawab->content !!}</p>
                                <p>Dijawab Oleh: {{$jawab->user->name}}  </p>
                            </div>
                            <div class="col-2 border-left d-flex justify-content-center">
                                @if($question->correct_answer == null and $Auth_user_id == $question->user_id)
                                    <form action="answer/{{$jawab->id}}" method="post">
                                        @csrf
                                        <p>Apakah jawaban ini paling membantu?</p>
                                        <button class="btn btn-sm btn-success mt-4" style="margin-left: 1.2cm;"><i class="fas fa-3x fa-check-circle"></i></button>
                                    </form>
                                 @endif
                            </div>
                        </div>
                        <p class="mt-4">Komentar:</p>

                        {{-- menampilkan comment2 untuk setiap jawaban --}}
                        @foreach ($jawab->comment as $comment)
                            <p class="my-0 border-top border-bottom">{{$comment->user->name}} : {{$comment->content}}</p>
                        @endforeach

                        <form class="form" action="/comment/answer/{{$jawab->id}}" method="post">
                            @csrf
                            <div class="form-row d-flex justify-content-end">
                                
                                <div class="col-7">
                                    <input type="text" class="form-control mt-4" name="comment" placeholder="Tambahkan Komentar">
                                </div>
                                <div class="col-1">
                                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>      
            </div>
            @endforeach
        @else
        {{-- menampilkan jawaban terbaiknya saja sehingga jawaban tampil paling atas --}}
            @foreach ($answers as $jawab)
                @if ($question->correct_answer->answer_id == $jawab->id)
                <div class="row ml-4" style="">
                    <div class="card mb-4" style="width: 100%;">
                        <div class="card-body">
                            <div class="row border-bottom">
                                <div class="col-1 mb-4">
                                    <p>vote: {{$jawab->votes->sum('upvote')-$jawab->votes->sum('downvote')}} </p>

                                    {{-- mengecek apakah user yg login sudah votes untuk pertanyaan tersebut atau belum --}}
                                    <?php $sudah_votes=false;?>
                                    
                                    @foreach ($jawab->votes as $votes)
                                        @if ($votes->user_id==$Auth_user_id)
                                            <?php $sudah_votes=true ;?>
                                        @endif
                                    @endforeach

                                    {{-- jika sudah votes atau jawaban tersebut dia sendiri yg buat, 
                                        maka tampilkan button tanpa submit (seperti button disabled) --}}
                                    @if ($jawab->user_id===$Auth_user_id)
                                        <button class="btn btn-secondary" onclick="alertVote()"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br>
                                        <button class="btn btn-secondary" onclick="alertVote()"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                                    @elseif($sudah_votes==true)
                                        <button class="btn btn-secondary" onclick="udahVote()"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br>
                                        <button class="btn btn-secondary" onclick="udahVote()"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                                    @else
                                        <form action="/upvote/answer/{{$jawab->id}}" method="post">
                                            @csrf
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br/>
                                        </form>

                                        <form action="/downvote/answer/{{$jawab->id}}" method="post">
                                            @csrf
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button><br/>
                                        </form>
                                    @endif
                                    
                                </div>
                                <div class="col-9 border-left">
                                    <p class="card-text" style="display: inline">{!! $jawab->content !!}</p>
                                    <p>Dijawab Oleh: {{$jawab->user->name}}  </p>
                                </div>
                                <div class="col-2 border-left d-flex justify-content-center">
                                    <div class="row">
                                        <p class="mb-0 ml-2">Jawaban Terbaik</p>
                                        <i class="fas fa-4x fa-check-circle" style="color: green; margin-left: 1.3cm; margin-top: 0cm"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-4">Komentar:</p>

                            {{-- menampilkan comment2 untuk setiap jawaban --}}
                            @foreach ($jawab->comment as $comment)
                                <p class="my-0 border-top border-bottom">{{$comment->user->name}} : {{$comment->content}}</p>
                            @endforeach

                            <form class="form" action="/comment/answer/{{$jawab->id}}" method="post">
                                @csrf
                                <div class="form-row d-flex justify-content-end">
                                    
                                    <div class="col-7">
                                        <input type="text" class="form-control mt-4" name="comment" placeholder="Tambahkan Komentar">
                                    </div>
                                    <div class="col-1">
                                    
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>      
                </div>
                @endif
            @endforeach
            {{-- menampilkan sisa jawaban selain jawaban terbaik --}}
            @foreach ($answers as $jawab)
            @if ($question->correct_answer->answer_id !== $jawab->id)
                <div class="row ml-4" style="">
                    <div class="card mb-4" style="width: 100%;">
                        <div class="card-body">
                            <div class="row border-bottom">
                                <div class="col-1 mb-4">
                                    <p>vote: {{$jawab->votes->sum('upvote')-$jawab->votes->sum('downvote')}} </p>

                                    {{-- mengecek apakah user yg login sudah votes untuk pertanyaan tersebut atau belum --}}
                                    <?php $sudah_votes=false;?>
                                    
                                    @foreach ($jawab->votes as $votes)
                                        @if ($votes->user_id==$Auth_user_id)
                                            <?php $sudah_votes=true ;?>
                                        @endif
                                    @endforeach

                                    {{-- jika sudah votes atau jawaban tersebut dia sendiri yg buat, 
                                        maka tampilkan button tanpa submit (seperti button disabled) --}}
                                    @if ($jawab->user_id===$Auth_user_id)
                                        <button class="btn btn-secondary" onclick="alertVote()"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br>
                                        <button class="btn btn-secondary" onclick="alertVote()"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                                    @elseif($sudah_votes==true)
                                        <button class="btn btn-secondary" onclick="udahVote()"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br>
                                        <button class="btn btn-secondary" onclick="udahVote()"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button>
                                    @else
                                        <form action="/upvote/answer/{{$jawab->id}}" method="post">
                                            @csrf
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></button><br><br/>
                                        </form>

                                        <form action="/downvote/answer/{{$jawab->id}}" method="post">
                                            @csrf
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-2x fa-arrow-alt-circle-down"></i></button><br/>
                                        </form>
                                    @endif
                                    
                                </div>
                                <div class="col-9 border-left">
                                    <p class="card-text" style="display: inline">{!! $jawab->content !!}</p>
                                    <p>Dijawab Oleh: {{$jawab->user->name}}  </p>
                                </div>
                                <div class="col-2 border-left d-flex justify-content-center">
                                    <div class="row">
                                        
                                    </div>
                                </div>
                            </div>
                            <p class="mt-4">Komentar:</p>

                            {{-- menampilkan comment2 untuk setiap jawaban --}}
                            @foreach ($jawab->comment as $comment)
                                <p class="my-0 border-top border-bottom">{{$comment->user->name}} : {{$comment->content}}</p>
                            @endforeach

                            <form class="form" action="/comment/answer/{{$jawab->id}}" method="post">
                                @csrf
                                <div class="form-row d-flex justify-content-end">
                                    
                                    <div class="col-7">
                                        <input type="text" class="form-control mt-4" name="comment" placeholder="Tambahkan Komentar">
                                    </div>
                                    <div class="col-1">
                                    
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>      
                </div>
            @endif
            @endforeach
        @endif
    </div>
    <h4 class="mt-4" style="margin-left: 4cm">Berikan Jawaban Anda:</h4>
    <form action="/questions/{{$question->id}}" method="post">
        @csrf
        <div class="form-group d-flex justify-content-center">
            <textarea class="form-control my-editor" style="width: 75%" name="content">{!! old('content', $content ?? '') !!}</textarea>
            <input type="hidden" name="question_id" value="{{$question->id}}">
        </div>
        <div class="form-group">
            @if($Auth_user_id == $question->user_id)
                <span class="btn btn-primary" onclick="jawabSendiri()" style="width: 25%; margin-left: 18cm">Kirim</span>
            @else
                <button type="submit" class="btn btn-primary" style="width: 25%; margin-left: 18cm">Kirim</button>
            @endif
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