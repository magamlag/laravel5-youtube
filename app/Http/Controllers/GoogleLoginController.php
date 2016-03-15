<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Services\GoogleLogin;
use Input;
/**
 * Class GoogleLoginController
 * @package App\Http\Controllers
 */
class GoogleLoginController extends Controller
{
	public function __construct(GoogleLogin $gl){
		$this->gl = $gl;
	}
	/**
	 *
	 * @return string
	 */
	public function index()
	{
		/*if (isset($_GET['code'])) {

		}*/

		if ($this->gl->isLoggedIn()) {

			return \Redirect::to('/videos');
		}

		$loginUrl = $this->gl->getLoginUrl();
		return "<a href='{$loginUrl}'>login</a>";
	}

	/**
	 * It's callback method. It handles with response parameters which comes from server
	 */
			public function store()
			{
				// User rejected the request
				if (Input::has('error')) {
					dd(Input::get('error'));
				}
				if (Input::has('code')) {
					$code = Input::get('code');
					$this->gl->login($code);
					return \Redirect::to('/');
				} else {
					throw new \InvalidArgumentException("Code attribute is missing.");
				}
			}

		public function logout()
		{
				$this->gl->logout('/login');
		}
}