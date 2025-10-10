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

    public function cleanerDetail($id)
    {
        $cleaner = Cleaner::with([
            'jobs' => function ($query) {
                $query->with(['service', 'user']);
            }
        ])->findOrFail($id);
        return view('admin.cleaner.detail', compact('cleaner'));
    }
}
