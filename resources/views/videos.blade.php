<!doctype html>
<html>
	<head>
		<title>Welcome to my site</title>
		@include('partials.head')

	<body>
		<div class="fix column">
			<div class="fix header">
				<div class="fix logo floatleft">
					<a href=""><h1>My Videos</h1></a>
				</div>
				@include('partials.search')
			</div>
			@include('partials.nav')

			<div class="fix blog_feature_area">
				<div class="fix blog_feature">
					<div class="fix feature_videos floatleft">
						<h2>Featuered Videos</h2>
						<div class="fix feature_video_container">
						@foreach($videos as $video)
							<div class="fix single_cat">
								<div class="play-small"></div>
								<img src="{{ $video['snippet']['thumbnails']['medium']['url'] }}" alt="{{ $video['snippet']['title'] }}" />
								<div class="fix single_cat_meta">
									<a href="http://youtube.com/watch?v={{ $video->getId() }}" title="{{ $video['snippet']['title'] }}" target="_blank">
									{{ $video['snippet']['title'] }}
									</a>
									<div class="fix">
										<p class="floatleft">3 days ago</p>
										<p class="floatright">{{ $video['statistics']['viewCount'] }} views</p>
									</div>
								</div>
							</div>
                        @endforeach
						</div>
					</div>
					<div class="fix feature_right_add floatright">
						<h2>Most Popular</h2>
						@foreach($videosPopular as $vp)
								<div class="fix single_feature_right_add">
									<img src="{{ $vp['snippet']['thumbnails']['high']['url'] }}" alt="{{ $vp['snippet']['title'] }}" />
									<div class="fix single_cat_meta">
										<a href="http://youtube.com/watch?v={{ $vp->getId() }}" title="{{ $vp['snippet']['title'] }}" target="_blank">
										{{ $vp['snippet']['title'] }}
										</a>
										<div class="fix">
											<p class="floatleft">3 days ago</p>
											<p class="floatright">{{ $vp['statistics']['viewCount'] }} views</p>
										</div>
									</div>
								</div>
						@endforeach
					</div>
				</div>
				<div class="fix feature_bottom_add"></div>
			</div>


		<div class="fix single_cat_area">
			<div class="single_cat_left_container">
				<!-- single cat horizontal area-->

				@include('partials.watched')

		</div>

		<div class="fix pagination">
			<a href="">1</a>
			<a href="">2</a>
			<a href="">3</a>
			<a href="">4</a>
			<a href="">5</a>
			<a href="">6</a>
			<a href="">7</a>
			<a href="">8</a>
			<a href=""> NEXT </a>
		</div>
		<div>

<ul class="pagination pagination-lg">
    <li @if($videos->getPrevPageToken() == null) class="disabled" @endif>
      <a href="/videos?page={{$videos->getPrevPageToken()}}" aria-label="Previous">
        <span aria-hidden="true">Previous &laquo;</span>
      </a>
    </li>
    <li @if($videos->getNextPageToken() == null) class="disabled" @endif>
      <a href="/videos?page={{$videos->getNextPageToken()}}" aria-label="Next">
        <span aria-hidden="true">Next &raquo;</span>
      </a>
    </li>
</ul>
		</div>
	</div>

			<!--blog post end-->


			<div class="fix blog_bottom">
				<div class="fix blog_bottom_add"></div>
			</div>

			<div class="fix home_addbar">
				<h2>Most Hot Videos</h2>
				<div class="fix single_addbar_container">
					<div class="fix single_addbar"></div>
					<div class="fix single_addbar"></div>
					<div class="fix single_addbar"></div>
				</div>
			</div>
			<div class="fix category">
				<h2>Categories</h2>
					<a href="">Big Tits</a>
					<a href="">Small Tits</a>
					<a href="">Big Bob</a>
					<a href="">Asian</a>
			</div>
			<div class="fix footer_area">
				<ul>
					<li><a href="">Home</a></li>
					<li><a href="">About us</a></li>
					<li><a href="">Disclaimer</a></li>
					<li><a href="">Contact us</a></li>
				</ul>
			</div>
		</div>

		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/jquery.bxslider.min.js"></script>
		<script type="text/javascript">
			$('.bxslider').bxSlider({
			  minSlides: 4,
			  maxSlides: 4,
			  slideWidth: 300,
			  slideMargin: 10,
			  captions : false,
			  pager:true,
			  auto: true,
			  controls:false

			});
		</script>

		<script type="text/javascript" src="js/selectnav.min.js"></script>
		<script type="text/javascript">
			selectnav('nav', {
			  label: '-Navigation-',
			  nested: true,
			  indent: '-'
			});
		</script>
	</body>
</html>