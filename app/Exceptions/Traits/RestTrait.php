<?php

namespace App\Exceptions\Traits;

use Illuminate\Http\Request;

trait RestTrait
{

    /**
     * Determines if request is an api call.
     *
     * If the request URI contains '/api/v'.
     *
     * @param Request $request
     * @return bool
     */
    protected function isApiCall(Request $request)
    {
        //strpos() kiem tra chuoi con trong chuoi cha
        return strpos($request->getUri(), '/api') !== false;
    }

}