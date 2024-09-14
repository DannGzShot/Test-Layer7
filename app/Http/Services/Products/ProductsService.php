<?php
namespace App\Http\Services\Products;

use App\Http\Requests\Products\ProductsRequest;
use App\Models\Products\Product;

use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;

class ProductsService
{

    public function index()
    {
            $model = new Product;
            $data = $model->products();

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
              return view('admin.products.actions.editar_borrar', compact('row'));
            })
            ->rawColumns(['actions'])
            ->make(true); 
    }


    public function create(ProductsRequest $request): Product
    {
        if(empty($request->id)){
            $created_by = auth()->user()->id;
        }else{
            $created_by = $request->created_by;
        }

        $data = Product::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'img' => $request->img,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'max_quantity' => $request->max_quantity,
                'min_quantity' => $request->min_quantity,
                'price' => $request->price,
                'created_by' => $created_by,
                'modify_by' => auth()->user()->id
            ]
        );

        return $data;
    }
}