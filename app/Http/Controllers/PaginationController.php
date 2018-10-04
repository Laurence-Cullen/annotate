<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationController extends Controller
{
    /**
     *  Creates a length aware paginator instance from a laravel collection.
     *
     * @param $collection
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function collectionToPaginator($collection, Request $request)
    {
        return PaginationController::arrayToPaginator($collection->all(), $request);
    }

    /**
     * Creates a length aware paginator instance from an array.
     *
     * @param array $array
     * @param $request
     * @return LengthAwarePaginator
     */
    public static function arrayToPaginator(array $array, $request) {
        $page = $request->get('page', 1); // Get the ?page=1 from the url

        // TODO think of better place to put perPage config
        $perPage = 12; // Number of items per page
        $offset = ($page * $perPage) - $perPage;

        array_slice($array, $offset, $perPage, true);

        return new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true), // Only grab the items we need
            count($array), // Total items
            $perPage, // Items per page
            $page, // Current page
            ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from the url
        );
    }
}
