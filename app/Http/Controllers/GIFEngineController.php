<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\TrendingRequest;
use App\Services\GIFEngine;
use Illuminate\Http\Request;

class GIFEngineController extends Controller
{
    /**
     * The GIFEngine implementation.
     * @var GIFEngine
     */
    protected $gifEngine;

    /**
     * Create a new GIFEngineController instance.
     * @param GIFEngine $gifEngine
     * @return void
     */
    public function __construct(GIFEngine $gifEngine) {
        $this->gifEngine = $gifEngine;
    }

    public function search(SearchRequest $request) {
        $query = $request->input('query');
        $limit = $request->has('limit') ? $request->input('limit') : 20;
        $offset = $request->has('offset') ? $request->input('offset') : 0;
        $data = $this->gifEngine->search(
            $query,
            $limit,
            $offset
        );

        if ($data->meta->status !== 200) {
            return json('error', ['An error occured while retrieving data'], ['error' => $data->meta->msg]);
        }

        return json('success', ['Data retrieved successfully'], [
            'data' => $data->data,
            'pagination' => $data->pagination
        ]);
    }

    public function getTrending(TrendingRequest $request) {
        $limit = $request->has('limit') ? $request->input('limit') : 20;
        $offset = $request->has('offset') ? $request->input('offset') : 0;
        $data = $this->gifEngine->trending(
            $limit,
            $offset
        );

        if ($data->meta->status !== 200) {
            return json('error', ['An error occured while retrieving data'], ['error' => $data->meta->msg]);
        }

        return json('success', ['Data retrieved successfully'], [
            'data' => $data->data,
            'pagination' => $data->pagination
        ]);
    }

    public function getGIFById(Request $request, $id) {
        $data = $this->gifEngine->getById($id);

        if ($data->meta->status !== 200) {
            return json('error', ['An error occured while retrieving data'], ['error' => $data->meta->msg]);
        }
        return json('success', ['Data retrieved successfully'], [
            'data' => $data->data
        ]);
    }
}
