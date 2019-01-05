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

    public function removeCart() {
        $details = Cart::getContent()->where();

        return view('tes', ['details' => $details]);
    }


}
