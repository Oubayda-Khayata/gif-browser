<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GIFEngine
{
    protected const BASE_URL = 'https://api.giphy.com/v1/gifs';
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * A keyword search.
     * @param string $query
     * @param int $limit
     * @param int $offset
     * @return mixed
     */

    public function search($query, $limit = 20, $offset = 0)
    {
        $url = GIFEngine::BASE_URL . '/search?' . 'api_key=' . $this->apiKey . '&q=' . $query . '&limit=' . $limit . '&offset=' . $offset;
        $response = Http::get($url);
        if ($response->status() !== 200) {
            $meta = new \stdClass;
            $result = new \stdClass;

            $meta->status = $response->status();
            $meta->msg = $response['message'];
            $result->meta = $meta;

            return $result;
        }
        $gifs = $response['data'];
        $gifsData = [];
        foreach ($gifs as $gif) {
            $gifObj = new \stdClass;
            $gifObj->id = $gif['id'];
            $gifObj->title = $gif['title'];
            $gifObj->url = $gif['url'];
            $gifObj->image = $gif['images']['original_still']['url'];
            $gifsData[] = $gifObj;
        }

        $meta = new \stdClass;
        $pagination = new \stdClass;

        $meta->status = $response['meta']['status'];
        $meta->msg = $response['meta']['msg'];

        $pagination->total_count = $response['pagination']['total_count'];
        $pagination->count = $response['pagination']['count'];
        $pagination->offset = $response['pagination']['offset'];

        $result = new \stdClass;
        $result->data = $gifsData;
        $result->meta = $meta;
        $result->pagination = $pagination;

        return $result;
    }

    /**
     * Get trending gifs.
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function trending($limit = 20, $offset = 0)
    {
        $url = GIFEngine::BASE_URL . '/trending?' . 'api_key=' . $this->apiKey . '&limit=' . $limit . '&offset=' . $offset;
        $response = Http::get($url);
        if ($response->status() !== 200) {
            $meta = new \stdClass;
            $result = new \stdClass;

            $meta->status = $response->status();
            $meta->msg = $response['message'];
            $result->meta = $meta;

            return $result;
        }
        $gifs = $response['data'];
        $gifsData = [];
        foreach ($gifs as $gif) {
            $gifObj = new \stdClass;
            $gifObj->id = $gif['id'];
            $gifObj->title = $gif['title'];
            $gifObj->url = $gif['url'];
            $gifObj->image = $gif['images']['original_still']['url'];
            $gifsData[] = $gifObj;
        }

        $meta = new \stdClass;
        $pagination = new \stdClass;

        $meta->status = $response['meta']['status'];
        $meta->msg = $response['meta']['msg'];

        $pagination->total_count = $response['pagination']['total_count'];
        $pagination->count = $response['pagination']['count'];
        $pagination->offset = $response['pagination']['offset'];

        $result = new \stdClass;
        $result->data = $gifsData;
        $result->meta = $meta;
        $result->pagination = $pagination;

        return $result;
    }

    /**
     * Get GIF by id.
     * @param string $id
     * @return mixed
     */
    public function getById($id)
    {
        $url = GIFEngine::BASE_URL . '/' . $id . '?' . 'api_key=' . $this->apiKey;
        $response = Http::get($url);
        if ($response->status() !== 200) {
            $meta = new \stdClass;
            $result = new \stdClass;

            $meta->status = $response->status();
            $meta->msg = $response['message'];
            $result->meta = $meta;

            return $result;
        }

        $gifObj = new \stdClass;
        $gifObj->id = $response['data']['id'];
        $gifObj->title = $response['data']['title'];
        $gifObj->url = $response['data']['url'];
        $gifObj->image = $response['data']['images']['original_still']['url'];

        $meta = new \stdClass;

        $meta->status = $response['meta']['status'];
        $meta->msg = $response['meta']['msg'];


        $result = new \stdClass;
        $result->data = $gifObj;
        $result->meta = $meta;

        return $result;
    }
}
