<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use File;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::get();
        $products = Product::all();
        if (request()->ajax()) {
            $Products = Product::get();
            return DataTables::of($Products)
            ->addColumn('action', 'products/action')
            ->addColumn('image', 'products/image')
            ->rawColumns(['action', 'image'])
            ->editColumn('created_at', function ($Products) {
                return $Products->created_at;
            })
            ->addColumn('categorys', function($Product){
                return $Product->categories->pluck('name')->implode(',');
            })
            ->addIndexColumn()
            ->make(true);
        }  
        return view('products/index',['category'=> $category], compact('products'));        
    }
    public function create()
    {
        $category = Category::get();
        return view('products/create',['category'=> $category]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'sku' => 'required|unique:products,sku',
            'price' => 'required',
            'detail' => 'required',
            
        ]);
        $product = new Product;
        $productId = $request->product_id;
        $product = Product::updateOrCreate(['id' => $productId]);

        if ($image = $request->file('image')) {

            File::delete('public/images/' . $request->hidden_image);

            $destinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $product['image'] = "$postImage";
        }
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->categories()->sync($request->categorys);
        $product->save();
        return redirect()->route('products')
            ->with('success', 'Product has been created successfully.');
    }
    public function show(Product $product)
    {
        return view('products/show', compact('product'));
    }
    public function edit(Product $product, $id)
    {
        $category = Category::get();
        $product = Product::find($id);

        $product_cat = $product->categories->pluck('id')->toArray(); 
        return view('products/edit',['product'=>$product,'category'=> $category,'product_cat'=>$product_cat]);
    }
    public function update(Request $request, $id)
    {        
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required',
            'detail' => 'required',
            'categorys' => 'required',
        ]);
        //dd($id);
        $product = Product::find($id);
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $product['image'] = "$postImage";
        } else {
            unset($product['image']);
        }
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->categories()->sync($request->categorys);
        $product->save();
        return redirect()->route('products')
            ->with('success', 'Product has been updated successfully.');
    }
    public function destroy(Request $request)
    {
        $pro = Product::where('id', $request->id)->delete();
        return Response()->json($pro);
    }
   
}
