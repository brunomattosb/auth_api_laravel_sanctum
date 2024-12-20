<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(!auth()->user()->tokencan('client:list')){

        //     return ApiResponse::error('Access denied',401);
        // }
        return ApiResponse::success(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|email|unique:clients',
        ]);
        $client = Client::create($request->all());

        return ApiResponse::success($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);

        if($client){
            return ApiResponse::success($client);
        }else{
            return ApiResponse::error('Client not fount');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|email|unique:clients,email,',$id,
        ]);
        $client = Client::find($id);

        if($client){
            $client->update($request->all());
            return ApiResponse::success($client);
        }else{
            return ApiResponse::error('Client not fount');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);

        if($client){
            $client->delete();
            return ApiResponse::success('Client deleted success');
        }else{
            return ApiResponse::error('Client not fount');

        }
    }
}
