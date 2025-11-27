<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Person::query();

        // Support search by either 'title' (frontend)  (database/legacy)
        $searchTerm = request()->input('name', request()->input('name', ''));
        if (!empty($searchTerm)) {
            // Apply the WHERE LIKE clause and return paginated results
            $query->where('name', 'like', '%' . $searchTerm . '%');

            // Keep ordering consistent
            $query->orderBy('id', 'desc');

            $persons = $query->paginate(10)->appends(request()->query());
            return response()->json($persons);
        }

        // Apply sorting (latest by created_at, then ascending by id)
        $query->orderBy('id', "desc");

        // Get the paginated results and append the query parameters
        $persons = $query->paginate(10)->appends(request()->query());

        // Return the JSON response
        return response()->json($persons);
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
        //
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
        ]);

        $person = Person::query();
        $person->create($validate);


        return response()->json([
            'message' => 'Person created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
        ]);

        $person = Person::query();

        $person->where('id', $id)->update($validate);

        return response()->json([
            'message' => 'Person updated successfully',
            'data' => $person
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        //
        $person->delete();
        return response()->json([
            'message' => 'Person deleted successfully'
        ], 200);
    }
}
