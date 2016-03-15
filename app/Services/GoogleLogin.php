<?php
namespace App\Services;

use Config;

/**
 * Class GoogleLogin
 * @package App\Services
 */
class GoogleLogin
{
    /**
     * @var \Google_Client
     */
    protected $client;

    /**
     * @param \Google_Client $client
     */
    public function __construct( \Google_Client $client )
    {
        $this->client = $client;
        $this->client->setClientId( Config::get( 'google.client_id' ) );
        $this->client->setClientSecret( Config::get( 'google.client_secret' ) );
        $this->client->setDeveloperKey( Config::get( 'google.api_key' ) );
        $this->client->setRedirectUri( Config::get( 'app.url' ) . "/loginCallback" );
        $this->client->setApprovalPrompt(  Config::get( 'google.approval_prompt' ) );
        $this->client->setScopes( [
            'https://www.googleapis.com/auth/youtube',
        ] );
        $this->client->setAccessType( 'offline' );
    }

    /**
     * @return string
     */
    public function isLoggedIn()
    {
        if (\Session::has( 'token' )) {
            $this->client->setAccessToken( \Session::get( 'token' ) );
        }

        if ($this->client->isAccessTokenExpired()) {
            $currentTokenData = json_decode(\Session::get('token'));
            if (isset($currentTokenData->refresh_token)) {
                $this->client->refreshToken($currentTokenData->refresh_token);
                \Session::set( 'token', $this->client->getAccessToken() );
            }
        }
        return !$this->client->isAccessTokenExpired();
    }

    /**
     * @param $code
     *
     * @return string
     */
    public function login( $code )
    {
        if(isset($code))
        $this->client->authenticate( $code );

        $token = $this->client->getAccessToken();
        \Session::put( 'token', $token );
        return $token;
    }

    /**
     * Logout, revoke access token and redirect to location
     *
     * @param string $redirect
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout($redirect = 'login')
    {
//            \Session::forget('token');
        echo \Session::get('token');
//        $this->client->revokeToken($this->getToken());
            return \Redirect::to($redirect);
    }

    /**
     * @return string
     */
    public function getLoginUrl()
    {
        $authUrl = $this->client->createAuthUrl();
        return $authUrl;
    }

    /**
     * Get parsed token element
     * @param  $key - The key to parse
     * @return string - mixed key value
     */
    public function parseToken($key = 'access_token')
    {
        if ( $token = $this->getToken() )
        {
            $token_array = json_decode($token, true);
            return $token_array[$key];
        }
    }

    /**
     * Get the access token
     * @return string token
     */
    public function getToken()
    {
        return \Session::get('token');
    }
}