<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Inertia\Inertia;

class TestController extends Controller
{
    //
    public function index()
    {
        $query = Student::query();

        // Apply search filter if provided
        if (request()->filled('search')) {
            $query->where('nama', 'like', '%' . request()->search . '%');
        }

        // Order and paginate the results, append current query params so links keep the search
        $data = $query->latest()->paginate(20)->appends(request()->only('search'));

        return Inertia::render('Test', [
            'students' => $data,
            'filters' => [
                'search' => request()->search,
            ],
        ]);
    }
}
