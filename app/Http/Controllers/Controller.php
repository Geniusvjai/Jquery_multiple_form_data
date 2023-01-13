<?php

namespace App\Http\Controllers;

use App\Models\Language;


use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function create_ajax(Request $request)
    {

        $store = new Language();
        $store->language = json_encode($request['details']);
        $store->save();

        return response()->json(['success' => 'Post created successfully.']);
    }

    public function show_language()
    {
     
        $show_languae = Language::find(1);
        $response['data']=$show_languae->language;
        return response()->json($response);
    }
}
