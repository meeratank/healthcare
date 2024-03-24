<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use App\Models\Professional;


class ProfessionalController extends Controller
{

    public function index()
    {
        $data = Professional::paginate(request()->all());
       
        $response = [
            'status' => 'success',
            'data' => $data,
        ];

        return response()->json($response, 200);
    }
}
