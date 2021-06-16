@extends('layout',["title" => "home | apotik insani"])

@section('content')
@include('components.navbar')
@include('components.carousel')


<div class="container py-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-12">
      <form action="{{url('/products')}}" class="d-flex">
        <input name="keyword" class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </div>
  </div>
    <div class="row justify-content-center">
      
       @foreach ($products as $product)
       <div class="col-6 col-md-3 my-3">
      <a href="{{url("/products/" . $product["id"])}}">
        <div class="card"  style="width: 100%">
          <img class="card-img " @if ($product["image"])
              src="{{'http://kasir.apotekinsani.com/upload/img/' . $product["image"]}}"
          @else
              src="https://i.stack.imgur.com/y9DpT.jpg"
          @endif alt="{{$product["name"]}}">
          
          <div class="card-body">
            <h5 class="card-title text-dark">{{ $product["name"]}}</h5>
            <div class="buy d-flex justify-content-between align-items-center">
              <div class="price text-success"><h5 class="mt-4">Rp.{{intval($product->variation[0]->sell_price_inc_tax)}}</h5></div>
            </div>
            @if (intval($product->variation_location_detail[0]->qty_available) == 0)
                <button   style="width:100%" class="btn btn-danger mt-3">stock habis</button>
            @else 
            <a style="width:100%" href="{{url("/products/" . $product["id"])}}" class="btn btn-success mt-3">BELI</a>
            @endif
          </div>
      </div>
      </a>
         
    </div>
       @endforeach
      
        
       
       
    </div>
</div>

@include('components.footer')
@endsection