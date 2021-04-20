<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\product;
use App\Models\transaction;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class homeController extends Controller
{
    public function home(Request $request)
    {
        $products = product::limit(8)->latest()->get();
        return View("home", compact("products"));
    }

    public function show(Request $request, $id)
    {
        $product = product::findOrfail($id);
        return view("show", compact('product'));
    }
    public function products(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $products = product::where('name', 'like', "%" . $keyword . "%")->latest()
                ->paginate(8);
        } else {
            $products = product::latest()
                ->paginate("8");
        }
        return view("products", compact("products"));
    }

    public function transaction(Request $request)
    {
        $this->validate($request, [
            "penerima" => "required",
            "alamat" => "required",
            "total" => "required"
        ]);

        transaction::create([
            "contact_id" => Auth::id(),
            "delivered_to" => $request->penerima,
            "final_total" => $request->total,
            "shipping_address" => $request->alamat,
            "status" => "belum diproses"
        ]);

        Cart::where("contact_id", Auth::id())->delete();
        return redirect()->to('/');
    }

    public function checkout(Request $request)
    {
        return view("checkout");
    }


    public function cart(Request $request)
    {
        Cart::create([
            "product_id" => $request->product_id,
            "quantity" => $request->quantity,
            "contact_id" => Auth::id(),
            "price" => $request->price * $request->quantity,
        ]);

        return redirect("/keranjang");
    }
    public function keranjang(Request $request)
    {
        $carts = Cart::where("contact_id", Auth::id())->latest()->get();
        $total = Cart::where("contact_id", Auth::id())->latest()->get()->sum("price");

        return view('keranjang', ["carts" => $carts, "total" => "$total"]);
    }

    public function destroyCart($id)
    {
        Cart::find($id)->delete();
        return redirect("/keranjang");
    }
}
