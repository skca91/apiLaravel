<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Http\Response;
use App\Http\Requests\ProductoRequest;
use App\Http\Resources\Producto\ProductoResource;
use App\Http\Resources\Producto\ProductoCollection;
use App\Exceptions\ProductNotBelongsToUser;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

/**
* @OA\Info(title="API Productos", version="1.0")
*
* @OA\Server(url="http://127.0.0.1:8000")
*/

class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }
 
    /**
    * @OA\Get(
    *     path="/api/productos",
    *     summary="Lista todos los productos",
    *     tags={"Listado Productos"},
    *     @OA\Response(
    *         response=200,
    *         description="Muestra todos lo productos"
    *     ),
    *     @OA\Response(
    *         response="404",
    *         description="No hay productos guardados"
    *     ),
    * )
    */
    public function index()
    {
        return ProductoCollection::collection(Producto::paginate(5));
    }

/**
    * @OA\Post(
    *     path="/api/productos",
    *     summary="Guarda un nuevo producto",
    *     tags={"Guarda un nuevo Producto"},
     *  
     *   @OA\Parameter(
     *      name="nombre",
     *      in="path",
     *      description="Nombre del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="descripcion",
     *      in="path",
     *      description="Descripcion del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="precio",
     *      in="path",
     *      description="precio del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="inventario",
     *      in="path",
     *      description="Cantidad del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="descuento",
     *      in="path",
     *      description="Descuento del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *     @OA\Response(
    *         response="201",
    *         description="Creado nuevo producto"
    *     ),
    * )
    */
    public function store(ProductoRequest $request)
    {
        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->inventario = $request->inventario;
        $producto->descuento = $request->descuento;
        $producto->save();

        return response()->json([
            'guardar' => new ProductoResource($producto)
        ], 201);
    }


     /**
    * @OA\Get(
    *     path="/api/productos/{id}",
    *     summary="Muestra un producto especificado",
    *     tags={"Muestra un producto"},
    *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
    *     @OA\Response(
    *         response=200,
    *         description="Muestra el detalle del producto"
    *     ),
    *     @OA\Response(
    *         response="404",
    *         description="No se encuentra el producto especificado"
    *     ),
    * )
    */
    public function show(Producto $producto)
    {
        return new ProductoResource($producto);
    }

   /**
    * @OA\Put(
    *     path="/api/productos/{id}",
    *     summary="Actualiza los datos de un producto",
    *     tags={"Actualiza un producto"},
     *  
     *   @OA\Parameter(
     *      name="nombre",
     *      in="path",
     *      description="Nombre del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="descripcion",
     *      in="path",
     *      description="Descripcion del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="precio",
     *      in="path",
     *      description="precio del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="inventario",
     *      in="path",
     *      description="Cantidad del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  *   @OA\Parameter(
     *      name="descuento",
     *      in="path",
     *      description="Descuento del producto",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *     @OA\Response(
    *         response="201",
    *         description="Actualizado producto"
    *     ),
    * )
    */
    public function update(Request $request, Producto $producto)
    {
        $this->ProductUserAuth($producto);

        $producto->update($request->all());

         return response()->json([
            'data' => new ProductoResource($producto)
        ], 201);
    }

     /**
    * @OA\Delete(
    *     path="/api/productos/{id}",
    *     summary="Elimina un producto especificado",
    *     tags={"Elimina un producto"},
    *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID del producto",
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
    public function destroy(Producto $producto)
    {
        $this->ProductUserAuth($producto);

        $producto->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function ProductUserAuth($product)
    {
        if(FacadesAuth::id() !== $product->user_id)
        {
            throw new ProductNotBelongsToUser;
            
        }
    }
}
