<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
class AdminController extends Controller
{
    public function login(){
        return view('admin/login');
    }

    public function index(){
        return view('admin/index');
    }
}