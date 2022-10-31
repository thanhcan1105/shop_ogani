<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Image;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductsController extends Controller
{
    //
    public function __construct()
    {

    }

    //Hiển thị sản phẩm
    public function index(){
        $products = Products::select('products.*', 'categories.name as nameCategory')
            ->join('categories','categories.id', '=', 'category_id')
            ->orderBy('id', 'ASC')
            ->paginate(10);
        return view('admin.products.products.index', compact('products'));
    }

    //Show form thêm sản phẩm (GET)
    public function addProduct(){
        $categories = Categories::get();
        return view('admin.products.products.add', compact('categories'));
    }

    //Thêm 1 sản phẩm (POST)
    public function postAddProduct(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2',
            'price' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'avatar' => 'required',
            'image' => 'required'
        ],
        [
            'name.required' => 'Tên còn trống!',
            'price.required' => 'required',
            'name.min' => 'Phải nhập ít nhất :min kí tự.',
            'description.required' => 'Mô tả còn trống!',
            'content.required' => 'Nội dung còn trống!',
            'category_id.required' => 'Vui lòng chọn danh mục!',
            'avatar.required' => 'Vui lòng thêm ảnh!',
            'image.required' => 'Vui lòng thêm ảnh!',
        ]);

        $request['slug'] = Str::slug($request->name);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'content' => $request->content,
            'slug' => $request['slug'],
            'category_id' => $request->category_id
        ];

        if ($request->avatar != null) {
            $rand = rand(1111111,9999999);
            $file = $request->avatar;
            $path = $file->move(base_path('public/upload'), 'item-' . $rand .'.png');
            $data['image'] = 'item-' . $rand .'.png';
        }else{
            $data['image'] = 'no_image.png';
        }

        $product_id =  Products::create($data)->id;

        if (count($request->image) > 0) {
            foreach ($request->image as $key => $image) {
                $rand = rand(1111111,9999999);
                $file = $image;
                $path = $file->move(base_path('public/upload'), 'item-' . $rand .'.png');
                $image = new Image();
                $image->name = 'item-' . $rand .'.png';
                $image->product_id = $product_id;
                $image->save();
            }
        } else {
            $data['name'] = 'no_image.png';
        }
        return redirect()->back();
        // return redirect(route('products.products'))->with('msg', 'Thêm thành công!');
    }


    //Xóa 1 sản phẩm (DELETE)
    public function deleteProduct($id){
        Products::where('id', $id)->delete();
        return redirect(route('products.products'));
    }

    //Sửa 1 sản phẩm (GET)
    public function editProduct(Request $request, $slug){

        $validated = $request->validate([
            'name' => 'required|min:2',
            'price' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'avatar' => 'required',
            'image[]' => 'required'
        ],
        [
            'name.required' => 'Tên còn trống!',
            'price.required' => 'required',
            'name.min' => 'Phải nhập ít nhất :min kí tự.',
            'description.required' => 'Mô tả còn trống!',
            'content.required' => 'Nội dung còn trống!',
            'category_id.required' => 'Vui lòng chọn danh mục!',
            'avatar.required' => 'Vui lòng thêm ảnh!',
            'image[].required' => 'Vui lòng thêm ảnh!',
        ]);

        $product = Products::where('slug', $slug)->first();
        return view('admin.products.products.edit',compact('product'));
    }

    //Sửa 1 sản phẩm (POST)
    public function postEditCategory(Request $request, $slug){
        $request['slug'] = Str::slug($request->name);

        $data = [
            'name' => $request->name,
            'slug' => $request['slug'],
        ];
        Products::where('slug', $slug)->update($data);
        return redirect(route('products.products.index'));
    }

    //Chi tiết 1 sản phẩm (GET)
    public function detailProduct($slug){
        $product = Products::where('slug', $slug)->first();
        return view('admin.products.products.detail', compact('product'));
    }
}
