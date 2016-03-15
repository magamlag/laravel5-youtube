<div class="fix single_cat_horizontal">
					<h2>Watched Videos</h2>
					<div class="fix single_cat_horizontal_container">
						@foreach($watched as $w)
						<div class="fix single_cat">
							<div class="play-small"></div>
							<img src="{{ $w['snippet']['thumbnails']['medium']['url'] }}" alt="{{ $video['snippet']['title'] }}"/>
							<div class="fix single_cat_meta">
								<a>{{ $w['snippet']['title'] }}</a>
								<div class="fix">
									<p class="floatleft">3 days ago</p>
								</div>
							</div>
							<div class="fix single_cat_rating">
								<span>Ratings</span>
								<div class="single_cat_star">
									<a href=""></a>
									<a href=""></a>
									<a href=""></a>
									<a href=""></a>
									<a href=""></a>
								</div>
							</div>
						</div>
						@endforeach
				</div>
			</div>