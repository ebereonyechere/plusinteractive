<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\NewLogin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        try {
            $ipData =
                Http::get('http://ip-api.com/json/' . '1.1.1.1')->json();

            if ($ipData['status'] === 'success') {

                // Get all past user logins
                $userLogins = DB::table('login_user')->where('user_id', auth()->id())->get();

                // build current login data
                $loginLocation = $ipData['city'] . ', ' . $ipData['regionName'] . ', ' . $ipData['country'];
                $loginData = [
                    'user_id' => auth()->id(),
                    'location' => $loginLocation,
                    'login_at' => now(),
                    'user_agent' => $request->userAgent()
                ];

                // check if first login or first login from location / device
                if (!count($userLogins)) {
                    Mail::to(auth()->user())->send(new NewLogin($loginData));
                } elseif (!count($userLogins->filter(function ($data) use ($request, $loginLocation) {
                    return $data->location === $loginLocation && $data->user_agent === $request->userAgent();
                }))) {
                    Mail::to(auth()->user())->send(new NewLogin($loginData));
                }

                // save login data to db
                DB::table('login_user')->insert($loginData);
            }
        } catch (Throwable $th) {
            Log::debug('Error quering ip-api.com ' . $th->getMessage());
        } finally {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
