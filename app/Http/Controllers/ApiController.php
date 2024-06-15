<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    private function lurescape($limit) {
        $response = Http::get('https://lurescape.matlikofficial.com/api/fish?limit=' . $limit);

        return $response->json();
    } 

    private function cats($limit) {
        $response = Http::get('https://mannicoon.com/api/cats?limit=' . $limit);

        return $response->json();
    } 

    public function index() {

        $limit = request()->get('limit') ?? '';

        if ($limit == 0) {
            $limit = '';
        }

        // dd(request()->get('whatapi'));

        if (request()->get('whatapi') == 'lurescape') {
            $response = $this->lurescape($limit);
        } else if (request()->get('whatapi') == 'cats'){
            $response = $this->cats($limit);
        } else {
            $response = response()->json('No one found');
        }


        return $response;
    }
}