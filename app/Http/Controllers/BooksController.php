<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Start the query builder for the Books model
        $query = Books::query();

        // Support search by either 'title' (frontend)  (database/legacy)
        $searchTerm = request()->input('title', request()->input('title', ''));
        if (!empty($searchTerm)) {
            // Apply the WHERE LIKE clause and return paginated results
            $query->where('title', 'like', '%' . $searchTerm . '%');

            // Keep ordering consistent
            $query->orderBy('id', 'desc');

            $students = $query->paginate(10)->appends(request()->query());
            return response()->json($students);
        }

        // Apply sorting (latest by created_at, then ascending by id)
        $query->orderBy('id', "desc");

        // Get the paginated results and append the query parameters
        $books = $query->paginate(10)->appends(request()->query());

        // Return the JSON response
        return response()->json($books);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $books = Books::query();
        $books->create($validate);

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $books
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $books = Books::query();
        return response()->json($books->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Books $books, $id)
    {
        //
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $books->where('id', $id)->update($validate);

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $books,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $books, $id)
    {
        $books->destroy($id);
        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }
}
