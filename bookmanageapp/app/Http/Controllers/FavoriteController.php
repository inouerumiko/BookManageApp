<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Book;
use App\Http\Requests\FavoriteRequest;
use App\Http\Requests\FavoriteCreateRequest;
use App\Http\Requests\FavoriteUpdateRequest;
use App\Http\Requests\FavoriteDeleteRequest;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function create(FavoriteCreateRequest $request)
    {

        // insert
        $favorite = Favorite::create($request->all());

        // response
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $favorite
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function read(FavoriteRequest $request)
    {
        $favorite = Book::select('isbn','name', 'published_at')
            ->join('favorites', 'books.id', '=', 'favorites.book_id')
            ->where('favorites.user_id', Auth::id())
            ->get();

        // レスポンス
        return response()->json($favorite);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FavoriteUpdateRequest $request, string $id)
    {
        $favorite = Favorite::find($id);

        if ($request->has('user_id')) {
            $favorite->user_id = $request->user_id;
        }
        if ($request->has('book_id')) {
            $favorite->book_id = $request->book_id;
        }
        $favorite->save();

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $favorite
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(FavoriteDeleteRequest $request, string $id)
    {
        $favorite = Favorite::find($id);
        $favorite->delete();

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $favorite
            ]
        );
    }}
