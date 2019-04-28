@foreach($collections as $comment)
    @include('comments.comment',['comments.comment'=>$comment])
@endforeach