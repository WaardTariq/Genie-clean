<?php

namespace App\Http\Controllers;

use App\Models\Cleaner;
use Illuminate\Http\Request;

class CleanerController extends Controller
{
    public function cleanerIndex()
    {
        $cleaners = Cleaner::where('status', 1)->get();
        return view('admin.cleaner.list', compact('cleaners'));
    }
}
