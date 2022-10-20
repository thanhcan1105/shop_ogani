<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\k;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function signup(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:2|max:50',
                'email' => 'required|email',
                'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'required|min:6'
            ],
            [
                'name.required' => 'Tên không được trống',
                'name.min' => 'Tên phải có ít nhất 2 kí tự',
                
            ]
        );

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
        ];

        Admin::create($data);
    }

    public function login()
    {
    }
}
