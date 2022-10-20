<?php

namespace App\Http\Controllers\Admin\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\BlogCate;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
    }

    //Hiển thị sản phẩm
    public function index()
    {
        $blogs  =   Blog::get();
        return view('admin.blogs.blogs.index', compact('blogs'));
    }

    //Show form thêm sản phẩm (GET)
    public function addBlog()
    {
        $blog_cate = BlogCate::get();
        return view('admin.blogs.blogs.add', compact('blog_cate'));
    }

    //Thêm 1 sản phẩm (POST)
    public function postAddBlog(Request $request)
    {
        $request['slug'] = Str::slug($request->title);
        $data = [
            'title' => $request->title,
            'slug' => $request['slug'],
            'description' => $request->description,
            'content' => $request->content,
            'cate_blog_id' => $request->cate_blog_id,
        ];


        if ($request->image != null) {
            $file = $request->image;
            $rand = rand(1111111, 9999999);
            $path = $file->move(base_path('public/upload'), 'item-' . $rand . '.png');
            $data['image'] = 'item-' . $rand . '.png';
        } else {
            $data['image'] = 'no_image.png';
        }
        Blog::create($data);

        return redirect(route('blog.index'))->with('msg', 'Thêm thành công!');
    }


    //Xóa 1 sản phẩm (DELETE)
    public function deleteBlog($id)
    {
        return redirect(route('blog.index'));
    }

    //Sửa 1 sản phẩm (GET)
    public function editBlog($slug)
    {
        return view('admin.blogs.blogs.edit', compact('Post'));
    }

    //Sửa 1 sản phẩm (POST)
    public function postEditBlog(Request $request, $slug)
    {
        return redirect(route('blog.index'));
    }

    //Chi tiết 1 sản phẩm (GET)
    public function detailBlog($slug)
    {
        $detail = Blog::where('slug', $slug)->first();
        return view('admin.blogs.blogs.detail', compact('detail'));
    }
}
