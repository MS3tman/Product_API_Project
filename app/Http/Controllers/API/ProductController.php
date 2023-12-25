<?php

namespace App\Http\Controllers\API;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->json([
            'success' => true,
            'messages' => 'all product',
            'product' => $products,
        ],200);
        
    }

    public function store(request $RequestData){
       $DataValidation = validator::make($RequestData->all(),[
            'name'=>'require|min:5',
            'detail'=>'require|min:20',
        ]);

        if($DataValidation->fails()){
            return response()->json([
                'fail' => false,
                'message' => 'you have error, not stored',
                'error' => $DataValidation->errors(),

            ],401);
        }
        $products = Product::create($RequestData->all());
        return response()->json([
            'success'=> true,
            'message'=>'successfuly, data is created',
            'products'=> $products,
        ]);
    }

    public function show(string $id){
        $SpecificProduct = Product::find($id);
        if(is_null($SpecificProduct)){    // this condition for check if product is found or not found.
            return response()->json([
                'fail' => false,
                'message' => 'this product is not found',
            ]);
        }
        else
        return response()->json([
            'success' => true,
            'message' => 'the product is found, successfuly',
            'product' => $SpecificProduct,
        ],200);
    }

    public function update(request $RequestData, Product $Findproduct){   // we can ue id for find the specific record and update it.
        $DataValidation = validator::make($RequestData,[
            'name' => 'required|min:3',
            'detail' => 'required|min:20'
        ]);
        if($DataValidation->fails()){
            return response()->json([
                'fail' => false,
                'message' => 'validation error , please enter your value',
                'error' => $DataValidation->errors(),
            ],200);

        }
        else{
            $Findproduct->name = $RequestData->name;
            $Findproduct->detail = $RequestData->detail;
            $Findproduct->save();

            return response()->json([
                'success' => true,
                'message' => 'update is successfuly',
                'product' => $Findproduct,
            ],200);
        }
    }

    public function delete(Product $Findproduct){
        Product::deleted($Findproduct);
        return response()->json([
            'success' => true,
            'message' => 'delete is successfuly',
            'Product' => $Findproduct,

        ],200);
    }
}
