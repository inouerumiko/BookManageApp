<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;

class BookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function create(BookCreateRequest $request)
    {
        // 著者を作成する.
        $book = Book::create($request->all());

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $book
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function read(BookRequest $request, string $id)
    {
        $book = Book::with('author')
            ->with('publisher')
            ->where('id',$id)
            ->get();

        // レスポンス
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, string $id)
    {
        $book = Book::find($id);

        if ($request->has('isbn')) {
            $book->isbn = $request->isbn;
        }
        if ($request->has('name')) {
            $book->name = $request->name;
        }
        if ($request->has('published_at')) {
            $book->published_at = $request->published_at;
        }
        if ($request->has('author_id')) {
            $book->author_id = $request->author_id;
        }
        if ($request->has('publisher_id')) {
            $book->publisher_id = $request->publisher_id;
        }
        $book->save();

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $book
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(BookRequest $request, string $id)
    {
        $book = Book::find($id);
        $book->delete();

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $book
            ]
        );
    }
}
