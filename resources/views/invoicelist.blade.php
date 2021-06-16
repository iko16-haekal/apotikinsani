@extends('layout',["title" => "invoice"])


@section('content')
    @include('components.navbar')


    <div class="container my-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
            @foreach ($trans as $tran)
            <a  style="text-decoration: none" href="{{url("/invoice/" . $tran->id)}}">
                <div class="card shadow-sm mb-4" style="border: none">
                    <div class="card-body">
                        <h4 class="text-dark">invoice #{{$tran->id}}</h4>
                    </div>
                </div>
               </a>
            @endforeach
            </div>
        </div>
    </div>


    @include('components.footer')
@endsection