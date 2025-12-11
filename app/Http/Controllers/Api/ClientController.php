<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{

    public function index()
    {
    // return list of clients and minimal website data
    return Client::with(['websites' => function($q){ $q->select('id', 'client_id', 'url'); }])->get(['id','email']);
    }

    public function show(Client $client)
    {
    return $client->load('websites');
    }
}
