<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;

class AuthorController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function create(AuthorCreateRequest $request)
    {
        // 著者を作成する.
        $author = Author::create($request->all());

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $author
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function read(AuthorRequest $request, string $id)
    {

        $author = Author::with('books')
            ->with('relatedPublishers')
            ->where('id',$id)
            ->get();

        // レスポンス
        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorUpdateRequest $request, string $id)
    {
        $author = Author::find($id);

        $author->name = $request->name;
        $author->save();

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $author
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(AuthorRequest $request, string $id)
    {
        $author = Author::find($id);
        $author->delete();

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $author
            ]
        );
    }
}
