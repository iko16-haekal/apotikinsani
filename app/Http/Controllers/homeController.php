<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
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
                ->simplePaginate(8);
        } else {
            $products = product::latest()
                ->simplePaginate("8");
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

        $result = transaction::create([
            "contact_id" => Auth::id(),
            "delivered_to" => $request->penerima,
            "final_total" => $request->total,
            "shipping_address" => $request->alamat,
            "status" => "belum diproses",
            "additional_notes" => $request->metode,
            "lat" => $request->lat,
            "long" => $request->long,
        ]);


        foreach ($request->product_id as $key => $productid) {
            Invoice::create([
                "product_id" => $productid,
                "quantity" => $request->quantity[$key],
                "transaction_id" => $result->id
            ]);
        }

        Cart::where("contact_id", Auth::id())->delete();
        return redirect("/invoice/" . $result->id);
    }

    public function invoice($id)
    {
        $trans = transaction::findOrfail($id);
        $productmsg = null;
        $break = urlencode("\n");
        foreach ($trans->invoice as $invoice) {
            $productmsg .= $invoice->product->name . " " .  $invoice->quantity . $invoice->product->unit->short_name . "$break";
        }
        $metode = $trans->additional_notes == "transfer" ? "Saya akan transfer $trans->dinal_total ke rekening berikut: $break 🏦 Bank Central Asia $break 💳 090909090" : 'saya akan membayar dengan metode cod';
        $msg = "Saya mau pesan produk ini:$break$productmsg $break Berikut data profil saya: $break 👤 Nama penerima: $trans->delivered_to $break$break Alamat: $break$trans->shipping_address https://maps.google.com/?daddr=$trans->lat,$trans->long $break$break $metode $break$break Terima kasih, $break$break mohon dibalas ya 🙏 Silahkan Cek Struk/status pemesanan Anda";
        return view("invoice", ["trans" => $trans, "msg" => $msg]);
    }


    public function listInvoice()
    {
        $trans = transaction::where("contact_id", Auth::id())->latest()->get();
        return view("invoicelist", compact("trans"));
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
        $cart = Cart::find($id);

        if ($cart->contact_id == Auth::id()) {
            $cart->delete();
        }
        return redirect("/keranjang");
    }
}
