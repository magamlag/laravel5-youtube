<!doctype html>
<html>
	<head>
		<title>Welcome to my site</title>
		@include('partials.head')

	<body>
		<div class="fix column">
			<div class="fix header">
				<div class="fix logo floatleft">
					<a href=""><h1>My Video</h1></a>
				</div>
                @include('partials.search')
			</div>
            @include('partials.nav')
<div class="fix blog_feature_area">
    <div class="fix blog_feature">
        <div class="fix feature_videos floatleft">
            <h2>Search Result</h2>
@if(isset($videos))
    <div class="fix feature_video_container">

    <ul class="list-unstyled video-list-thumbs row">
    @foreach($videos as $video)
        <li class="col-lg-3 col-sm-4 col-xs-6">
            <a href="{{ URL::route('video', ['id' => $video->getId()->getVideoId()]) }}" title="{{ $video['snippet']['title'] }}" target="_blank">
                <img src="{{ $video['snippet']['thumbnails']['medium']['url'] }}" alt="{{ $video['snippet']['title'] }}" class="img-responsive" height="130px" />
                <h2 class="truncate">{{ $video['snippet']['title'] }}</h2>
                <span class="glyphicon glyphicon-play-circle"></span>
            </a>
        </li>
    @endforeach
    </ul>
    </div>
    <nav class="text-center">
      <ul class="pagination pagination-lg">
        <li class="left" @if($videos->getPrevPageToken() == null) class="disabled" @endif>
          <a href="/search?page={{$videos->getPrevPageToken()}}&query={{ $query }}" aria-label="Previous">
            <span aria-hidden="true">Previous &laquo;</span>
          </a>
        </li>
        <li class="right" @if($videos->getNextPageToken() == null) class="disabled" @endif>
          <a href="/search?page={{$videos->getNextPageToken()}}&query={{ $query }}" aria-label="Next">
            <span aria-hidden="true">Next &raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
@else
    <h2>No result.</h2>
@endif