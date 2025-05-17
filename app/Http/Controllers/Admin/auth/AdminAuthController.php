<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.signin',  [
            'showSidebar' => false, 
        ]);    
    
    
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_name' => 'admin'])) {
            return redirect()->route('devices.index');
        }
        return back()->withErrors(['email' => 'Invalid credentials or you are not an admin.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

}
