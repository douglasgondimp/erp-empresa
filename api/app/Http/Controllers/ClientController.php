<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Client::paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        return Client::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return $client;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        return $client->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        return $client->delete();
    }
}
