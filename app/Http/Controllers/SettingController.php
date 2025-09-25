<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index'); 
        // nanti bikin file: resources/views/admin/settings/index.blade.php
    }
}
