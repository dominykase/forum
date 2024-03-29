<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $threadId = request()->query('tid', null);
        $topicId = request()->query('toid', null);
        $page = request()->query('p', null);

        return view('auth.login', ['threadId' => $threadId, 'page' => $page, 'topicId' => $topicId]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->toid && $request->p) {
            return redirect()->route('topic', ['topicId' => $request->toid, 'page' => $request->p]);
        }

        if ($request->tid && $request->p) {
            return redirect()->route('thread', ['threadId' => $request->tid, 'page' => $request->p]);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
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
