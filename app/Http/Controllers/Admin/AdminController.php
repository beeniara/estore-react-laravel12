<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdminRequest;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Fetch and display orders for different periods.
     */
    public function index(): View
    {
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count(); // Changed to count()
        $yesterdayOrders = Order::whereDate('created_at', Carbon::yesterday())->count(); // Changed to count()
        $monthOrders = Order::whereMonth('created_at', Carbon::now()->month)->count(); // Changed to count()
        $yearOrders = Order::whereYear('created_at', Carbon::now()->year)->count(); // Changed to count()

        return view('admin.index', compact('todayOrders', 'yesterdayOrders', 'monthOrders', 'yearOrders'));
    }

    /**
     * Display the admin login form.
     */
    public function login(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) { // Check if admin is already logged in
            return redirect()->route('admin.index');
        }
        return view('admin.login');
    }

    /**
     * Authenticate the admin.
     */
    public function auth(AuthAdminRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the admin out.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login'); // Redirect to login page after logout
    }
}
