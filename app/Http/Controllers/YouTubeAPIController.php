<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\GoogleLogin;

class YouTubeAPIController extends Controller
{
    protected $youtube = '';
    protected $gl = '';

    public function __construct(GoogleLogin $gl){
        $this->youtube = \App::make( 'youtube' );
        $this->gl = $gl;
    }

    public function categories()
    {
        $categories = $this->youtube->videoCategories->listVideoCategories( 'snippet', [ 'regionCode' => 'US' ] );

        dump( $categories );
    }

    public function videos()
    {
        if($this->gl->isLoggedIn()) {
            $options          = [
            /*'chart' => 'mostPopular', */
                'myRating'   => 'like',
                'maxResults' => 6
            ];
            $options_popular = [
                'chart' => 'mostPopular',
                'maxResults' => 2
            ];

            $regionCode       = 'US';
            $selectedCategory = 0;

            if (\Input::has( 'page' )) {
                $options['pageToken'] = \Input::get( 'page' );
            }
            $channelsResponse      = $this->youtube->channels->listChannels( 'snippet,contentDetails,statistics', array(
                'mine' => 'true',
            ) );
            $playlistItemsResponse = [ ];
//            dd( $channelsResponse );

            foreach ($channelsResponse['items'] as $channel) {
                // Extract the unique playlist ID that identifies the list of videos
                // uploaded to the channel, and then call the playlistItems.list method
                // to retrieve that list.
                $uploadsListId = $channel['contentDetails']['relatedPlaylists']['watchHistory'];

                $playlistItemsResponse = $this->youtube->playlistItems->listPlaylistItems( 'id, snippet, contentDetails', array(
                    'playlistId' => $uploadsListId,
                    'maxResults' => 10
                ) );
            }
            $watched = $playlistItemsResponse;
            $watchedVideosId = [ ];
            foreach($playlistItemsResponse as $playlistItem){
                $watchedVideosId[]  = $playlistItem['snippet']['resourceId']['videoId'];
            }

            $categories = $this->youtube->videoCategories->listVideoCategories( 'snippet',
                [ 'regionCode' => $regionCode ] )->getItems();
            $videos     = $this->youtube->videos->listVideos( 'id, snippet, statistics', $options );
            $videosPopular     = $this->youtube->videos->listVideos( 'id, snippet, statistics', $options_popular );
//            dd( $videosPopular );
        return view('videos', [
            'videos' => $videos,
            'videosPopular' => $videosPopular,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'watched' => $watched
        ]);
        }
        return \Redirect::to( '/' );
    }

    public function search()
    {
        if (!\Input::has('query')) {
            return view("search");
        }

        $options = ['maxResults' => 16, 'q' => \Input::get("query")];
        if (\Input::has('page')) {
            $options['pageToken'] = \Input::get('page');
        }

        $videos = $this->youtube->search->listSearch("snippet", $options);

        return view('search', ['videos' => $videos, 'query' => \Input::get('query')]);
    }

    public function video( $id )
    {
        $options = [ 'maxResults' => 1, 'id' => $id ];

        $videos  = $this->youtube->videos->listVideos( 'id, snippet, player, contentDetails, statistics, status', $options );
        $relatedVideos = $this->youtube->search->listSearch("snippet", ['maxResults' => 16, 'type' => 'video', 'relatedToVideoId' => $id]);
        if (count( $videos->getItems() ) == 0) {
            return redirect( '404' );
        }

        return view( 'video', [ 'video' => $videos[0], 'relatedVideos'=>$relatedVideos ] );
    }

}
