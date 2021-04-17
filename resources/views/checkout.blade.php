@extends('layout',["title" => "checkout"])

@section('content')
    @include('components.navbar')
    <style scoped>
    .header-title {
        margin: 0;
        margin-bottom: 0px;
        font-size: 16px;
        font-weight: 700;
        color: #34364a;
        margin-bottom: 16px;
    }

    .title {
    margin: 0;
    font-weight: 400;
    font-size: 1.1rem;
    color: #34364a;
    }

    .value {
    margin: 0;
 
    font-weight: 400;
    font-size: 1.1rem;
    color: #34364a;
    }

    .card {
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        border-radius: 10px;
    }
    </style>
    <div class="container my-5 py-5">
        <div class="row justify-content-center">
           <div class="col-md-6">
            <div class="card px-3 py-2">
                <div class="card-body ">
                    <h5 class="header-title">Detail pembayaran</h5>
                        <div class="d-flex justify-content-between">
                            <h4 class="title">Produk</h4>
                             <h4 class="value">Obat pencahar</h4>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <h4 class="title">Harga</h4>
                             <h4 class="value">Rp.50000</h4>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <h4 class="title">quantity</h4>
                             <h4 class="value">5</h4>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <h4 class="title">Total pembayaran</h4>
                             <h4 class="value">Rp.50000000</h4>
                        </div>
<br>
<br>
                        <button class="btn btn-success w-100">Konfirmasi pembayaran</button>
                        
                  
                </div>
            </div>
           </div>
        </div>
    </div>



    @include('components.footer')
@endsection