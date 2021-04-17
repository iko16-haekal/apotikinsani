@extends('layout',["title" => "keranjang"])

@section('content')
@include('components.navbar')
<div class="pb-5 mt-5 pt-3">
    <div class="container mt-5 ">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

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
                <td class="border-0 align-middle"><strong>{{$cart->price}}</strong></td>
                <td class="border-0 align-middle"><strong>{{$cart->quantity}}</strong></td>
                <td class="border-0 align-middle">
                  <form id="delete-form" action="{{ url('cart/'.$cart->id) }}" method="POST">
                    @csrf
                    @method("delete")
                    <button class="btn btn-danger">hapus</button>
                </form>
                </td>
              </tr>

               @endforeach
               <form id="delete-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>
@endsection