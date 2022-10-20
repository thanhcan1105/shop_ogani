<?php

namespace App\Http\Controllers\Admin\Blogs;

use App\Http\Controllers\Controller;
use App\Models\BlogCate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogCateController extends Controller
{
    //
    public function __construct()
    {

    }

    //Hiển thị sản phẩm
    public function index(){
        $blog_cate  =   BlogCate::get();
        return view('admin.blogs.categories.index', compact('blog_cate'));
    }

    //Show form thêm sản phẩm (GET)
    public function addBlogCate(){
        return view('admin.blogs.categories.add');
    }

    //Thêm 1 sản phẩm (POST)
    public function postAddBlogCate(Request $request){
        $request['slug'] = Str::slug($request->name);
        $data = [
            'name' => $request->name,
            'slug' => $request['slug'],
        ];
        BlogCate::create($data);
        return redirect(route('blog_cate.index'))->with('msg', 'Thêm thành công!');
    }


    //Xóa 1 sản phẩm (DELETE)
    public function deleteBlogCate($id){
        return redirect(route('blog_cate.index'));
    }

    //Sửa 1 sản phẩm (GET)
    public function editBlogCate($slug){
        return view('admin.blogs.categories.edit',compact('BlogCate'));
    }

    //Sửa 1 sản phẩm (POST)
    public function postEditCategory(Request $request, $slug){
        return redirect(route('blog_cate.index'));
    }

    //Chi tiết 1 sản phẩm (GET)
    public function detailBlogCate($slug){
        return view('admin.blogs.blogs.detail', compact('BlogCate'));
    }
}
