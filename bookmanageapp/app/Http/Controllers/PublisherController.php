<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Http\Requests\PublisherRequest;
use App\Http\Requests\PublisherCreateRequest;
use App\Http\Requests\PublisherUpdateRequest;

class PublisherController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function create(PublisherCreateRequest $request)
    {
        // 著者を作成する.
        $publisher = Publisher::create($request->all());

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $publisher
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function read(PublisherRequest $request, string $id)
    {
        $publisher = Publisher::with('books')
            ->with('relatedAuthors')
            ->where('id',$id)
            ->get();

        // レスポンス
        return response()->json($publisher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublisherUpdateRequest $request, string $id)
    {
        $publisher = Publisher::find($id);

        $publisher->name = $request->name;
        $publisher->save();

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $publisher
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(PublisherRequest $request, string $id)
    {
        $publisher = Publisher::find($id);
        $publisher->delete();

        // レスポンス
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
                'data' => $publisher
            ]
        );
    }
}
