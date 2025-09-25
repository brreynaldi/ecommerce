<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index'); 
        // nanti buat file: resources/views/admin/reports/index.blade.php
    }
}
