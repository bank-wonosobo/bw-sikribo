<?php

namespace App\Http\Controllers;

use App\Helper\AuthUser;
use App\Models\FileArchive;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        // $file_archives = FileArchive::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.dashboard.index');
    }

    public function faq() {
        return view('admin.faq');
    }

    public function contact() {
        return view('admin.contact');
    }
}
