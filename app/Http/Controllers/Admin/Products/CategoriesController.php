<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    //
    // *1 private $categories;

    public function __construct()
    {
        // *1 $this->categories = new Categories();
    }

    //Hiển thị danh mục sản phẩm
    public function index(){
        // *1 $categoriesList = $categories->getCategories();

        // $categories = Categories::orderBy('parent_id', 'ASC')
        // ->paginate(10);
        $categories = Categories::with('parentCategory')->get();
        // return response()->json($categories);

        return view('admin.products.categories.index', compact('categories'));
    }

    //Show form thêm danh mục (GET)
    public function addCategory(){
        $categories = Categories::where('parent_id', 0)->get();
        return view('admin.products.categories.add', compact('categories'));
    }

    //Thêm 1 danh mục sản phẩm (POST)
    public function postAddCategory(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|unique:categories,name',
        ],
        [
            'name.required' => 'Tên còn trống!',
            'name.min' => 'Phải nhập ít nhất :min kí tự.',
            'name.unique' => 'Tên không được trùng',
        ]);
        // if($validated->fails()){
        //     return Redirect::back()->with('errors', $validated);
        // }
        $request['slug'] = Str::slug($request->name);

        $data = [
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? 0,
            'slug' => $request['slug'],
        ];
        // \Toastr::success('Đăng ký tài khoản thành công', 'Thông báo', ["positionClass" => "toast-top-center"]);
        Categories::create($data);
        return redirect()->back()->with('success', 'Thêm thành công');
        // return redirect(route('categories.categories'))->with('mgs', 'Thêm thành công!');
    }


    //Xóa 1 danh mục sản phẩm (DELETE)
    public function deleteCategory($id){
        Categories::where('id', $id)->delete();
        return redirect(route('products.categories.index'));
    }

    //Sửa 1 danh mục sản phẩm (GET)
    public function editCategory($slug){
        $category = Categories::where('slug', $slug)->first();
        $categories = Categories::get();

        return view('admin.products.categories.edit',compact('category','categories'));
    }

    //Sửa 1 danh mục sản phẩm (POST)
    public function postEditCategory(Request $request, $slug){

        $validated = $request->validate([
            'name' => 'required|min:2',
        ],
        [
            'name.required' => 'Tên còn trống!',
            'name.min' => 'Phải nhập ít nhất :min kí tự.',
        ]);

        $request['slug'] = Str::slug($request->name);

        $data = [
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? 0,
            'slug' => $request['slug'],
        ];
        Categories::where('slug', $slug)->update($data);
        return redirect()->back();
    }

    //Chi tiết 1 danh mục sản phẩm (GET)
    public function detailCategory($slug){
        $category = Categories::where('slug', $slug)->first();
        return view('admin.products.categories.detail', compact('category'));
    }

}
