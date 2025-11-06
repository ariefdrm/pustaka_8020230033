<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

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
            $query->orderBy('id', 'desc');

            $students = $query->paginate(10)->appends(request()->query());
            return response()->json($students);
        }

        // Apply sorting (latest by created_at, then ascending by id)
        $query->orderBy('id', "desc");

        // Get the paginated results and append the query parameters
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
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        $student = Student::create($validated);

        // Return response (adjust depending on your front-end setup)
        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        // Return the single student resource requested by route-model binding
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // Use validated data from the form request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        $student->update($validated);

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $student,
        ], 200);

        // return redirect()->route('student.index')->with('message', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
        $student->delete();
        return response()->json([
            'message' => 'Student deleted successfully'
        ], 200);
    }
}
