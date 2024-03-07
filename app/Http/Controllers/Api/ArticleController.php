<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paper;
use Illuminate\Http\Request;
use App\Traits\ResponseFormat;

class ArticleController extends Controller
{

    use ResponseFormat;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Paper::paginate(10);
    }


    // search 

    public function search(Request $request){
        $request->validate([
            'query' => 'string|required',
        ]);

        $query = $request->get('query');

        $articles = Paper::search($query)->get();

        return $this->jsonResponse(status: 'success',data: $articles);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Paper $paper)
    {
        return $paper;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paper $paper)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paper $paper)
    {
        //
    }
}
