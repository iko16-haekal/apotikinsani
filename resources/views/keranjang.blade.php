@extends('layout',["title" => "keranjang"])

@section('content')
@include('components.navbar')


<div class="pb-5 mt-5 pt-3">
    <div class="container mt-5 ">
      <div class="row">
        <div class="col-lg-8 p-1 bg-white rounded shadow-sm mb-5">
          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Price</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Quantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Remove</div>
                  </th>
                </tr>
              </thead>
              <tbody>
               @foreach ($carts as $cart)
               <tr>
                <th scope="row" class="border-0">
                  <div class="p-2">
                    <img  @if($cart->product->image)

                    src="{{'http://kasir.apotekinsani.com/upload/img/' . $cart->product->image}}"
                @else
                    src="https://i.stack.imgur.com/y9DpT.jpg"
                @endif alt="{{$cart->product->name}}" width="70" class="img-fluid rounded shadow-sm">
                    <div class="ml-3 d-inline-block align-middle">
                      <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">{{$cart->product->name}}</a>
                    </div>
                  </div>
                </th>
                <td class="border-0 align-middle"><strong>{{intval($cart->product->variation[0]->sell_price_inc_tax)}}</strong></td>
                <td class="border-0 align-middle"><strong>{{$cart->quantity}}</strong></td>
                <td class="border-0 align-middle">
                  <form id="delete-form" action="{{ url('cart/'.$cart->id) }}" method="POST">
                    @csrf
                    @method("delete")
                    <button class="btn btn-danger">hapus</button>
                </form>
                </td>
              </tr>
              <ul style="display: none">
                <li class="total-harga">{{intval($cart->product->variation[0]->sell_price_inc_tax) * $cart->quantity}}</li>
              </ul>
               @endforeach
               <form id="delete-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>

        <div class="col-lg-4">
      @if ($total > 0)
        @if(count($errors) > 0)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
             @endforeach
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($total <= 50000)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      minimal pembelian 50000
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card mb-3 shadow-sm" style="border: none">
      <div class="card-body" >
       @if ($total <= 50000)
       <p class="font-weight-bold">total: Rp.{{$total}}</p>
       <a href="{{url("/products")}}" class="btn btn-success">belanja lagi</a>
       @else
       <form action="{{url("/product/transaction")}}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="penerima" class="form-label">penerima</label>
          <input value="{{Auth::user()->name}}" type="text" name="penerima" class="form-control" id="alamat">
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">alamat</label>
          <textarea required type="text" name="alamat" class="form-control" id="alamat">
          </textarea>
          <input type="hidden"  id="form-total" name="total">
          <input type="hidden"  id="lat" name="lat">
          <input type="hidden"  id="long" name="long">

          @foreach ($carts as $cart)
              <div style="display: none">
                <input type="text" type="hidden" name="product_id[]" value="{{$cart->product->id}}">
                <input type="text" type="hidden" name="quantity[]" value="{{$cart->quantity}}"></div>
          @endforeach
        </div>
        <div class="mb-3">
          <label for="metode" class="form-label">metode pembayaran</label>
          <select class="form-select" name="metode" id="metode">
            <option value="transfer">transfer</option>
            <option value="cod">cod</option>
          </select>
        </div>
        <p class="font-weight-bold">total: Rp.<span class="total-display"></span></p>
        <button class="btn btn-success" type="submit">checkout</button>
      </form>
       @endif
      </div>
    </div>
      </div>
      @endif
      </div>


      <script>
       const totalharga = Array.from(document.querySelectorAll(".total-harga"));
       const totalDisplay = document.querySelector(".total-display");
       const formtotal = document.getElementById("form-total");
       const totals = totalharga.map(total => {
        return parseInt(total.innerHTML)
        }).reduce((a,b) => a + b)
       totalDisplay.innerHTML = totals;
       formtotal.value = totals;
      

       function initGeolocation()
     {
        if( navigator.geolocation )
        {
           // Call getCurrentPosition with success and failure callbacks
           navigator.geolocation.getCurrentPosition( success, fail );
        }
        else
        {
           alert("Sorry, your browser does not support geolocation services.");
        }
     }

     function success(position)
     {

         document.getElementById('long').value = position.coords.longitude;
         document.getElementById('lat').value = position.coords.latitude;
     }

     function fail()
     {
        // Could not obtain location
     }
     
     initGeolocation();
      </script>
@endsection