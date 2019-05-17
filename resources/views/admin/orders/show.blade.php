@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="row">
				<div class="col">
					<h5>
						<span>Alamat Pengiriman</span>
					</h5>
					<br/>
					<p>
						{{ $order->shipping_address }}
					</p>
				</div>
			</div>

			<br/>
			<div class="row">
				<div class="col">
					<h5>
						<span>Kode Pos</span>
					</h5>
					<br/>
					<p>
						{{ $order->zip_code }}
					</p>
				</div>
			</div>

			<br/>
			<div class="row">
				<div class="col">
					<h5>
						<span>Harga Total</span>
					</h5>
					<br/>
					<p>
						{{ $order->total_price }}
					</p>
				</div>
			</div>
		</div>
	</div>

	<br/>
	<div class="row justify-content-center">
		<div class="col">
			<table id="cart" class="table table-hover table-condensed">
				<thead>
					<tr>
						<th style="width:50%">Product</th>
						<th style="width:10%">Price</th>
						<th style="width:8%">Quantity</th>
						<th style="width:22%" class="text-center">SubTotal</th>
					</tr>
				</thead>
				<tbody>
					@foreach($order->orderItems as $orderItem)
					<tr>
						<td data-th="Product">
							<div class="row">
								<div class="col-sm-3 hidden-xs"><img src="{{ asset('/images/' . $orderItem->product->images->first()->image_src) }}" width="100" height="100" class="img-responsive">
								</div>

								<div class="col-sm-9">
									<a href="{{ url('lihat', $orderItem->product->id) }}">
										<h5 class="nomargin">{{ $orderItem->product->name }}</h5>
									</a>
								</div>
							</div>
						</td>
						<td data-th="Price">
							{{ $orderItem->price }}
						</td>

						<td data-th="Quantity">
							{{ $orderItem->quantity }}
						</td>

						<td data-th="SubTotal" class="text-center">
							{{ $orderItem->price * $orderItem->quantity }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection