<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\Auth\UserResources;

class LoginController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	// protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	protected function sendLoginResponse(Request $request)
	{
		// $request->session()->regenerate();

		$this->clearLoginAttempts($request);

		if ($response = $this->authenticated($request, $this->guard()->user())) {
			return $response;
		}

		return $request->wantsJson()
			? new Response('', 204)
			: redirect()->intended($this->redirectPath());
	}

	protected function authenticated(Request $request, $user)
	{
		return UserResources::make($user, 200);
	}

	public function loginToken(Request $request)
	{
		$request->validate([
			'email' => 'required|string',
			'password' => 'required|string',
		]);

		$user = User::where('email', $request->email)->first();
		$field = false;
		$message = "";

		if ($user && !Hash::check($request->password, $user->password)) {
			$field = 'password';
			$message = 'La contraseña contiene algún error';
		};
		if (!$user) {
			$field = 'email';
			$message = 'El correo no existe';
		};

		if ($field) {
			throw ValidationException::withMessages([
				$field => [__($message)],
			]);
		}

		$token = $user->createToken('token')->plainTextToken;

		$response = [
			'token' => $token
		];

		return response()->json($response, 201);
	}
	public function logout(Request $request)
	{
		$this->guard()->logout();
		if (method_exists($request->user()->currentAccessToken(), 'delete')) {
			$request->user()->currentAccessToken()->delete();
		}
		if ($response = $this->loggedOut($request)) {
			return $response;
		}

		return $request->wantsJson()
			? new JsonResponse([], 204)
			: redirect('/');
	}

	/**
	 * The user has logged out of the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return mixed
	 */
	protected function loggedOut(Request $request)
	{
		return response()->json([
			'message' => __('Has cerrado sesion.')
		], 200);
	}


	protected function guard()
	{
		return Auth::guard('web');
	}

	public function isAuth(Request $request)
	{
		return UserResources::make($request->user());
	}
}
