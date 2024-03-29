<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Paper;
use App\Http\Requests\Api\ArticleRequest;


class ArticleController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Paper::paginate(10);
    }


    // search

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'string|required',
        ]);

        $query = $request->get('query');

        $articles = Paper::search($query)->get();

        return jsonResponse(status: 'success', data: $articles);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        // return $data;
        $paper = Paper::create($data);
        return jsonResponse(status: 'success', data: $paper);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paper $paper)
    {
        return jsonResponse('success', $paper);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Paper $paper)
    {
        $paper->update($request->all());
        return jsonResponse(status: 'success', data: $paper);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paper $paper)
    {
        $paper->delete($paper);
        return jsonResponse('success', ['message' => 'deleted article']);
    }
}
