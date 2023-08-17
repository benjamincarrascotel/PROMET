<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

}
