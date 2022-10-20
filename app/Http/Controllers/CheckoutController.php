<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = session()->get('cart');
        $total = 0;
        $qty = 0;
        if ($carts) {
            foreach ($carts as $key => $cart) {
                $total += $cart['price'] * $cart['quantity'];
                $qty += $cart['quantity'];
            }
        };
        $provinces = Province::get();
        return view('front_end.checkout', compact('carts', 'provinces', 'qty', 'total'));
    }

    public function select_district(Request $request)
    {
        $districts = District::where('_province_id', $request->id)->get();
        $select_district = [
            '<option value="" disabled selected>Quận/Huyện</option>',
        ];
        foreach ($districts as $key => $district) {
            $item = '<option value="' . $district->id . '">' . $district->_name . '</option>';
            array_push($select_district, $item);
        }
        return response()->json([
            'select_district' => $select_district,
            'code' => 200,
        ]);
    }

    public function select_ward(Request $request)
    {
        $wards = Ward::where('_district_id', $request->id)->get();
        $select_ward = [
            '<option value="" disabled selected>Xã/Phường/Thị trấn</option>',
        ];
        foreach ($wards as $key => $ward) {
            $item = '<option value="' . $ward->id . '">' . $ward->_name . '</option>';
            array_push($select_ward, $item);
        }
        return response()->json([
            'select_ward' => $select_ward,
            'code' => 200,
        ]);
    }
}
