<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="margin-top: 100px">
    <div class="col-md-10 col-md-offset-1">
        <h2>{{$post->title}}</h2>
        <h4>{{$post->content}}</h4>
        <hr>
        @include('comments.list',['collections'=>$comments['root']])
        <h3>留下您的评论</h3>
        @include('comments.form',['parentId'=>$post->id])
    </div>
</div>
</body>
</html>
