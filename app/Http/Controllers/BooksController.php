<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Transformer\BookTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BooksController extends Controller
{

    /**
     * Return all books.
     * @return array
     */
    public function index()
    {
        return $this->collection(Book::all(), new BookTransformer());
    }

    /**
     * Return book.
     * @param  integer $id
     * @return mixed
     */
    public function show($id)
    {
        // try {
        //     return Book::findOrFail($id);
        // } catch (ModelNotFoundException $e) {
        //     return response()->json([
        //         'error' => [
        //             'message' => 'Book not found'
        //         ]
        //     ], 404);
        // }
        return ['data' => Book::findOrFail($id)->toArray()];
    }

    /**
     * Save book.
     * @param  Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        // Validate input request
        $this->validate($request, [
            'title'       => 'required|max:255',
            'description' => 'required',
            'author'      => 'required',
            'author_id'   => 'required|exists:authors,id',
        ], [
            'description.required' => 'Please fill out the :attribute.'
        ]);

        $book = Book::create($request->all());
        $data = $this->item($book, new BookTransformer());

        return response()->json($data, 201, [
            'Location' => route('books.show', ['id' => $book->id])
        ]);
    }

    /**
     * Update book.
     * @param  Request $request
     * @param  integer $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Book not found'
                ]
            ], 404);
        }

        // Validate input request
        $this->validate($request, [
            'title'       => 'required|max:255',
            'description' => 'required',
            'author'      => 'required',
            'author_id'   => 'required|exists:authors,id'
        ], [
            'description.required' => 'Please fill out the :attribute.'
        ]);

        $book->fill($request->all());
        $book->save();

        return $this->item($book, new BookTransformer());
    }

    /**
     * Delete book
     * @param  integer $id
     * @return \Illuminate\HttpJsonResponse
     */
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Book not found'
                ]
            ], 404);
        }
        $book->delete();

        return response(null, 204);
    }

}
