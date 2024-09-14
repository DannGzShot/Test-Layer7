<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;

use App\Http\Requests\Products\ProductsRequest;
use App\Http\Services\Products\ProductsService;

use App\Models\Products\Product;

use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index(Request $request, ProductsService $service)
    {
        if ($request->ajax()) {
          return $service->index();
        }
        return view('admin.products.index');
    }

    public function product($id): mixed
    {
        $data = Product::with(['created_by'])->find($id);
       //dd($data);
        return view('admin.products.product', compact('data'));
    }



    // CREAR / EDITAR
    public function store(ProductsRequest $request, ProductsService $service)
    {
        $service->create($request);
        return response()->json(['success'=>'Guardado Correctamente.']);
    }


    public function add(Request $request)
    {
        $productos = Product::find($request->product_add_id);
        //dd($productos);
        $sumar = $productos->quantity + $request->quantity;
        Product::find($request->product_add_id)->update(['quantity' => $sumar]);
        return response()->json(['success'=>'Guardado Correctamente.']);
    }

    public function remove(Request $request)
    {
        
        $productos = Product::find($request->product_remove_id);
        $restar = $productos->quantity - $request->quantity;
        Product::find($request->product_remove_id)->update(['quantity' => $restar]);
        return response()->json(['success'=>'Guardado Correctamente.']);
    }
    
    // EDITAR VER
    public function edit($id)
    {
        $data = Product::find($id);
        return response()->json($data);
    }
    

    // BORRAR
    public function delete($id)
    {
      Product::find($id)->update(['deleted_at' => now(), 'deleted_by' => auth()->user()->id]);
      return response()->json(['success'=>'Borrado Correctamente.']);
    }


    // BORRAR PERMANENTE
    public function destroy($id)
    {
      Product::destroy($id);
      return response()->json(['success'=>'Borrado Correctamente.']);
    }

}