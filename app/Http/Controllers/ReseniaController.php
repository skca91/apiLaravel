<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resenia;
use App\Producto;
use Illuminate\Http\Response;
use App\Http\Resources\Resenia\ReseniaResource;
use App\Http\Requests\ReseniaRequest;

class ReseniaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Producto $producto)
    {
        return ReseniaResource::collection($producto->resenia);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReseniaRequest $request, Producto $producto)
    {
        $resenia = new Resenia($request->all());
        $producto->resenia()->save($resenia);

        return response()->json([
            'data' => new ReseniaResource($resenia)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Producto $producto, Resenia $resenia)
    {
        $resenia->update($request->all());

        return response()->json([
            'data' => new ReseniaResource($resenia)
        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto, Resenia $resenia)
    {
        $resenia->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
