@extends('layout',["title" => $product["name"]])



@section('content')

<style scoped>

    body{
    }
    
    /*panel*/
    .panel {
        border: none;
        box-shadow: none;
    }
    
    .panel-heading {
        border-color:#eff2f7 ;
        font-size: 16px;
        font-weight: 300;
    }
    
    .panel-title {
        color: #2A3542;
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 0;
        margin-top: 0;
        font-family: 'Open Sans', sans-serif;
    }
    
    /*product list*/
    
    .prod-cat li a{
        border-bottom: 1px dashed #d9d9d9;
    }
    
    .prod-cat li a {
        color: #3b3b3b;
    }
    
    .prod-cat li ul {
        margin-left: 30px;
    }
    
    .prod-cat li ul li a{
        border-bottom:none;
    }
    .prod-cat li ul li a:hover,.prod-cat li ul li a:focus, .prod-cat li ul li.active a , .prod-cat li a:hover,.prod-cat li a:focus, .prod-cat li a.active{
        background: none;
        color: #ff7261;
    }
    
    .pro-lab{
        margin-right: 20px;
        font-weight: normal;
    }
    
    .pro-sort {
        padding-right: 20px;
        float: left;
    }
    
    .pro-page-list {
        margin: 5px 0 0 0;
    }
    
    .product-list img{
        width: 100%;
        border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
    }
    
    .product-list .pro-img-box {
        position: relative;
    }
    .adtocart {
        background: #fc5959;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        color: #fff;
        display: inline-block;
        text-align: center;
        border: 3px solid #fff;
        left: 45%;
        bottom: -25px;
        position: absolute;
    }
    
    .adtocart i{
        color: #fff;
        font-size: 25px;
        line-height: 42px;
    }
    
    .pro-title {
        color: #5A5A5A;
        display: inline-block;
        margin-top: 20px;
        font-size: 25px;
    }
    
    .product-list .price {
        color:#fc5959 ;
        font-size: 15px;
    }
    
    .pro-img-details {
        margin-left: -15px;
    }
    
    .pro-img-details img {
        width: 100%;
    }
    
    .pro-d-title {
        font-size: 16px;
        margin-top: 0;
    }
    
    .product_meta {
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 10px 0;
        margin: 15px 0;
    }
    
    .product_meta span {
        display: block;
        margin-bottom: 10px;
    }
    .product_meta a, .pro-price{
        color:#fc5959 ;
    }
    
    .pro-price, .amount-old {
        font-size: 18px;
        padding: 0 10px;
    }
    
    .amount-old {
        text-decoration: line-through;
    }
    
    .quantity {
        width: 120px;
    }
    
    .pro-img-list {
        margin: 10px 0 0 -15px;
        width: 100%;
        display: inline-block;
    }
    
    .pro-img-list a {
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    
    .pro-d-head {
        font-size: 18px;
        font-weight: 300;
    }
    
    </style>
@include('components.navbar')

<div class="container bootdey my-5 py-5 mt-5">
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                  <div class="panel-body">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="pro-img-details">
                                <img class="card-img " @if ($product["image"])
                                src="{{'http://kasir.apotekinsani.com/upload/img/' . $product["image"]}}"
                            @else
                                src="https://i.stack.imgur.com/y9DpT.jpg"
                            @endif alt="{{$product["name"]}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2>
                                    {{$product["name"]}}
                                   
                            </h2>
                            <p>
                               {!! $product["product_description"] !!}
                            </p>
                            {{-- <div class="product_meta">
                                <span class="posted_in"> <strong>Categories:</strong>  <a rel="tag " class="text-success" href="#">T-shirt</a>.</span>
                            </div> --}}
                            <div class="m-bot15"> <strong>Price : </strong>  <span class="pro-price text-success">Rp.{{intval($product->variation[0]->sell_price_inc_tax)}}</span></div>
                            <form action="{{url("/cart")}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <div class="d-flex align-items-center">
                                        <input value="1" name="quantity" min="1" max="{{intval($product->variation_location_detail[0]->qty_available)}}" type="number" placeholder="1" class="form-control quantity">
                                        <h6>&nbsp; {{$product->unit->short_name}}</h6>
                                    </div>
                                </div>
                                <input value="{{intval($product->variation[0]->sell_price_inc_tax)}}" name="price"  type="hidden">
                                <input value="{{$product["id"]}}" name="product_id"  type="hidden">
                                <p>
                                    <button class="btn btn-round btn-success my-4" type="submit">masukan keranjang</button>
                                </p>
                            </form>
                          
                        </div>
                      </div>
                  </div>
              </section>
              </div>
    </div>
      </div>
@endsection