<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class DashboardAdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('admin.index');
    }
    public function form()
    {
        return view('admin.form');
    }
        public function error()
    {
        return view('admin.error');  
    }
    public function buttons()
    {
        return view('admin.button');
    }
    public function blank()
    {
        return view('admin.blank');
    }
    public function chart()
    {
        return view('admin.chart');
    }
    public function element()
    {
        return view('admin.element');
    }
    public function signin()
    {
        return view('admin.signin',  [
            'showSidebar' => false, 
        ]);
    }
    public function signup()
    {
        return view('admin.signup',  [
            'showSidebar' => false, 
        ]);
    }
    public function table ()
    {
        return view('admin.table');
    }
    public function typography ()
    {
        return view('admin.typography');
    }
    public function widget ()
    {
        return view('admin.widget');
    }
}
