<?php

namespace App\Http\Controllers;

// use App\PengajuanDanaDetail;
use Illuminate\Http\Request;
Use Cart;

class ControllerTest extends Controller
{
    public function form () {
        $data = Cart::getContent();

        return view('form', ['data' => $data]);
    }

    public function addCart (Request $res) {
        $add = Cart::add([
            'id' => $res->id,
            'name' => $res->name,
            'price' => $res->price,
            'quantity' => $res->quantity
        ]);

        if ($add) {
            $data = Cart::getContent();

            return view('form', ['data' => $data]);
        }
    }

    public function removeCart($id) {
        $remove = Cart::remove(1);

        if($remove) {
            $data = Cart::getContent();

            return view('form', ['data' => $data]);
        }
    }


}
