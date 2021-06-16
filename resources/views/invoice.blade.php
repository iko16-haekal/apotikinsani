@extends('layout',["title" => "invoice $trans->id"])

@section('content')
    @include('components.navbar')
   
<!------ Include the above in your HEAD tag ---------->
<style></style>
<div class="container my-5 pt-5">
    <div class="row">
        <div class="col-md-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order #{{$trans->id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-md-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					{{$trans->delivered_to}}<br>
    					{{$trans->shipping_address}}
    				</address>
    			</div>
				<div class="col-md-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{$trans->additional_notes}}
						@if ($trans->additional_notes == "transfer")
						<br>
						BCA: 09876544331
						@endif
    				</address>
    			</div>
    		</div>
    		<div class="row">
    		
    			<div class="col-md-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{$trans->created_at->format('d M Y')}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							@foreach ($trans->invoice as $invoice)
								<tr>
    								<td>{{$invoice->product->name}}</td>
    								<td class="text-center">
									Rp.{{intval($invoice->product->variation[0]->sell_price_inc_tax)}}
									</td>
    								<td class="text-center">{{$invoice->quantity}}</td>
    							</tr>
                              
								@endforeach
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>total</strong></td>
    								<td class="thick-line text-right">Rp.{{intval($trans->final_total)}}</td>
    							</tr>
    							
    					
    						</tbody>
    					</table>

						<a target="_blank" href="https://api.whatsapp.com/send?phone=+6285715904647&text={!! $msg !!}"  class="w-100 btn btn-success">konfirmasi whatsapp</a>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

    @include('components.footer')
@endsection