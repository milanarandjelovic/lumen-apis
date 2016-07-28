<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Transformer\AuthorTransformer;
use Illuminate\Support\Facades\Request;

class AuthorController extends Controller
{

    /**
     * Validate author input.
     *
     * @param Request $request
     */
    public function validateAuthor(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max"255',
            'gender'    => ['required', 'regex:/^(male|female)$/i'],
            'biography' => 'required',
        ], [
            'gender.regex' => " Gender format is invalid: must equal 'male' or 'female' ",
        ]);
    }

    /**
     * Return all author.
     *
     * @return array
     */
    public function index()
    {
        $authors = Author:: with('ratings')->get();

        return $this->collection($authors, new AuthorTransformer());
    }

    /**
     * Return author by id.
     *
     * @param $id
     * @return array
     */
    public function show($id)
    {
        return $this->item(
            Author::findOrFail($id), new AuthorTransformer()
        );
    }

    /**
     * Save author.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $this->validateAuthor($request);

        $author = Author::create($request->all());
        $data = $this->item($author, new AuthorTransformer());

        return response()->json($data, 201, [
            'Location' => route('author.show', ['id' => $author->id]),
        ]);
    }

    /**
     * Update author.
     *
     * @param Request $request
     * @param         $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateAuthor($request);

        $author = Author::findOrFail($id);
        $author->fill($request->all());
        $author->save();

        $data = $this->item($author, new AuthorTransformer());

        return response()->json($data, 200);
    }

    /**
     * Delete author.
     *
     * @param $id
     * @return \Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        Author::findOrFail($id)->delete();

        return response(null, 204);
    }

}
