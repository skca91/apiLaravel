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
    * @OA\Get(
    *     path="/api/productos/{id}/resenias",
    *     summary="Lista todas las resenias de un producto",
    *     tags={"Lista todas las resenias de una producto"},
    *     @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Id del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
    *     @OA\Response(
    *         response=200,
    *         description="Muestra todas las resenias de un producto"
    *     ),
    *     @OA\Response(
    *         response="404",
    *         description="No hay resenias"
    *     ),
    * )
    */
    public function index(Producto $producto)
    {
        return ReseniaResource::collection($producto->resenia);
    }

   /**
    * @OA\Post(
    *     path="/api/productos/{id}/resenias",
    *     summary="Guarda una resenia para un producto",
    *     tags={"Guarda una resenia para un producto"},
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Id del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="cliente",
     *      in="path",
     *      description="Nombre del cliente",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="estrella",
     *      in="path",
     *      description="Cantidad de estrellas de la resenia",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="resenia",
     *      in="path",
     *      description="Resenia del producto",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *     @OA\Response(
    *         response="201",
    *         description="Creada nueva resenia para el producto producto"
    *     ),
    * )
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
    * @OA\Put(
    *     path="/api/productos/{id}/resenias/{idr}",
    *     summary="Actualiza la resenia del producto",
    *     tags={"Actualiza la resenia del producto"},
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Id del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="idr",
     *      in="path",
     *      description="Id de la resenia",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="estrella",
     *      in="path",
     *      description="Cantidad de estrellas de la resenia",
     *      required=false,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="resenia",
     *      in="path",
     *      description="Resenia del producto",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *     @OA\Response(
    *         response="201",
    *         description="Creada nueva resenia para el producto producto"
    *     ),
    * )
    */
    public function update(Request $request,Producto $producto, Resenia $resenia)
    {
        $resenia->update($request->all());

        return response()->json([
            'data' => new ReseniaResource($resenia)
        ],Response::HTTP_CREATED);
    }


     /**
    * @OA\Delete(
    *     path="/api/productos/{id}/resenias/{idr}",
    *     summary="Elimina un producto especificado",
    *     tags={"Elimina un producto especificado"},
    *     @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="idr",
     *      in="path",
     *      description="ID de la resenia",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
    *     @OA\Response(
    *         response=200,
    *         description="Eliminado exitosamente"
    *     ),
    *     @OA\Response(
    *         response="404",
    *         description="No se encuentra el producto especificado"
    *     ),
    * )
    */
    public function destroy(Producto $producto, Resenia $resenia)
    {
        $resenia->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
