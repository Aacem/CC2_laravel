<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Str;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create',compact('categories'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($validatedData['category_id']);
        $product= $category->products()->create([
            'category_id'=> $validatedData['category_id'],
            'name'=> $validatedData['name'],
            'slug'=> Str::slug($validatedData['slug']),
            'small_description'=> $validatedData['small_description'],
            'description'=> $validatedData['description'],
            'original_price'=> $validatedData['original_price'],
            'selling_price'=> $validatedData['selling_price'],
            'quantity'=> $validatedData['quantity'],
            'trending'=> $request->trending == true ? '1':'0',
            'status'=> $request->status == true ? '1':'0',
            'meta_title'=> $validatedData['meta_title'],
            'meta_keyword'=> $validatedData['meta_keyword'],
            'meta_description'=> $validatedData['meta_description'],
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/';
            
            $i=1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName = $uploadPath.$filename;
                
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }


        
        return redirect('/admin/products')->with('message','Product Added Successfully');

    }

    public function edit(int $product_id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($product_id);
        return view('admin.products.edit',compact('categories','product'));
    }

    public function update(ProductFormRequest $request,int $product_id)
    {
        $validatedData =$request->validated();
        $product = Category::findOrFail($validatedData('category_id'))->products()->where('id',$product_id)->first();
        if($product){
            $product->update([
                'category_id'=> $validatedData['category_id'],
                'name'=> $validatedData['name'],
                'slug'=> Str::slug($validatedData['slug']),
                'small_description'=> $validatedData['small_description'],
                'description'=> $validatedData['description'],
                'original_price'=> $validatedData['original_price'],
                'selling_price'=> $validatedData['selling_price'],
                'quantity'=> $validatedData['quantity'],
                'trending'=> $request->trending == true ? '1':'0',
                'status'=> $request->status == true ? '1':'0',
                'meta_title'=> $validatedData['meta_title'],
                'meta_keyword'=> $validatedData['meta_keyword'],
                'meta_description'=> $validatedData['meta_description'],
            ]);

            if($request->hasFile('image')){
                $uploadPath = 'uploads/products/';
                
                $i=1;
                foreach($request->file('image') as $imageFile){
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time().$i++.'.'.$extension;
                    $imageFile->move($uploadPath,$filename);
                    $finalImagePathName = $uploadPath.$filename;
                    
                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }
    
    
            
            return redirect('/admin/products')->with('message','Product Updated Successfully'); 

        }
        else{
            return redirect('admin/products')->with('message','No such product Id found');
        }
    }

}
