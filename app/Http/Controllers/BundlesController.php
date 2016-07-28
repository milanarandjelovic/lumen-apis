<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bundle;
use App\Transformer\BundleTransformer;

class BundlesControllers extends Controller
{

    /**
     * Show bundle by $id.
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        $bundle = Bundle::findOrFail($id);
        $data = $this->item($bundle, new BundleTransformer());

        return response()->json($data);
    }

    /**
     * Add book.
     *
     * @param $bundleId
     * @param $bookId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addBook($bundleId, $bookId)
    {
        $bundle = Bundle::findOrFail($bundleId);
        $book = Book::findOrFail($bookId);

        $bundle->books()->attach($book);
        $data = $this->item($bundle, new BundleTransformer());

        return response()->json($data);
    }

    /**
     * Delete book.
     *
     * @param $bundleId
     * @param $bookId
     * @return \Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function removeBook($bundleId, $bookId)
    {
        $bundle = Bundle::findOrFail($bundleId);
        $book = Book::findOrFail($bookId);

        $bundle->books()->detach($book);

        return response(null, 204);
    }

}
