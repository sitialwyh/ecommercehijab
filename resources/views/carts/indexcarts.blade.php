@extends('layouts.app')
@section('content')

<div class="container">
	
	@if($message = Session::get('success'))
	<div class="alert alert-success">
		<p>{{ $message }}</p>
	</div>
	@endif

	<table id="cart" class="table table-hover table-condensed">
		<thead>
			<tr>
				<th style="width:50%">Product</th>
				<th style="width:14%">Price</th>
				<th style="width:8%" class="text-center">Quantity</th>
				<th style="width:22%" class="text-center">Subtotal</th>
				<th style="width:10%"></th>
			</tr>
		</thead>
		
		<tbody>
			
			<?php $total = 0 ?>

			@if(session('cart'))
			@foreach(session('cart') as $id => $product)

			<?php $total += $product['price'] * $product['quantity'] ?>

			<tr>
				<td data-th="Product">
					<div class="row">
						<div class="col-sm-3 hidden-xs">
							<img src="{{ asset('/images/'. $product['image_src']) }}" width="100" height="100">
						</div>

						<div class="col-sm-9">
							<h5 class="nomargin">{{ $product['name'] }}</h5>
						</div>
				</td>
					<td data-th="Price">Rp. {{ $product['price'] }} </td>
					<td data-th="Quantity">
						<!-- <input type="number" value="{{ $product['quantity'] }}" class="form-control quantity" /> -->
						<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product quantity" type="number" value="{{ $product['quantity'] }}">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
						</div>
					</td>
					<td data-th="Subtotal" class="text-center">Rp. {{ $product['price'] * $product['quantity'] }}</td>
					<td class="actions" data-th="">
						<button class="btn btn-info btn-sm mt-1 update-cart" data-id="{{ $id }}">Updatee</button>
						<button class="btn btn-danger btn-sm mt-2 remove-from-cart" data-id="{{ $id }}">Remove</button>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td>
						<a href="{{ url('/product') }}" class="btn btn-warning"><i class="fas fa-shopping-bag"></i> Lanjutkan Belanja</a>
						<a href="{{ route('admin.orders.create') }}" class="btn btn-primary"><i class="far fa-credit-card"></i> Lanjut ke Pembayaran</a>
					</td>

					<td class="hidden-xs"></td>
					<td class="hidden-xs text-right"><strong>Total :</strong></td>
					<td class="hidden-xs text-center"><strong> Rp. {{ $total }}</strong></td>
				</tr>
			</tfoot>
		</table>
	</div>

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
@endsection
				