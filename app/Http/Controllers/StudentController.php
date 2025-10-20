<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Start the query builder for the Student model
        $query = Student::query();

        // Support search by either 'name' (frontend) or 'nama' (database/legacy)
        $searchTerm = request()->input('name', request()->input('nama', ''));
        if (!empty($searchTerm)) {
            // Apply the WHERE LIKE clause and return paginated results
            $query->where('nama', 'like', '%' . $searchTerm . '%');

            // Keep ordering consistent
            $query->orderBy('id', 'asc');

            $students = $query->paginate(10)->appends(request()->query());
            return response()->json($students);
        }

        // Apply sorting (latest by created_at, then ascending by id)
        // You might want to pick one sorting method; 'latest()' sorts by created_at DESC.
        // If you want to sort by 'id' ASC as primary:
        $query->orderBy('id', "asc");

        // Get the paginated results and append the query parameters
        // The 'appends()' method is crucial for passing the search term to the frontend
        $students = $query->paginate(10)->appends(request()->query());

        // Return the JSON response
        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
