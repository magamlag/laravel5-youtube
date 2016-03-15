<div class="row">
    <h2>{{ $video["snippet"]["title"] }}</h2>
</div>
 
<div class="row">
    <iframe type='text/html' src='http://www.youtube.com/embed/{{ $video->getId() }}' width='100%' height='500' frameborder='0' allowfullscreen='true'></iframe>
</div>
 
<div class="row">
    (<span>{{ $video["statistics"]["likeCount"] }} <i class="glyphicon glyphicon-thumbs-up"></i></span>)
    (<span>{{ $video["statistics"]["dislikeCount"] }} <i class="glyphicon glyphicon-thumbs-down"></i></span>)
    (<span>{{ $video["statistics"]["favoriteCount"] }} <i class="glyphicon glyphicon-heart"></i></span>)
    (<span>{{ $video["statistics"]["commentCount"] }} <i class="glyphicon glyphicon-bullhorn"></i></span>)
</div>
 
<hr/>
 
<div class="row">
    <p>{{ $video["snippet"]["description"] }}</p>
</div>