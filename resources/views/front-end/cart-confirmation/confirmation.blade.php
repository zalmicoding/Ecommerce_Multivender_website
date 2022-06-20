<!doctype html>
<html lang="en">

<title>	Cart Confirmation</title>

@include('front-end/partials/css-files')

<body>

	<!--================Header Menu Area =================-->
@include('front-end/partials/top-header')
	<!--================Header Menu Area =================-->

<section class="order_details p_120" style="min-height: 100vh;">
		<div class="container">
		<br><br>
			<!-- <h3 class="title_confirmation">Thank you. Your order has been received.</h3> -->
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<div class="order_details_table">
				<h2>Order Details</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr class="text-dark">
								<th scope="col">Product</th>
								<th scope="col">Quantity</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach(Cart::content() as $cart)
							<tr>
								<td>
									<p>{{$cart->name}}</p>
								</td>
								<td>
									<h5>x {{$cart->qty}}</h5>
								</td>
								<td>
									<p> {{$cart->price}}</p>
								</td>
							</tr>
							
							@endforeach
							<tr>
								<td>
									<h4>Shipping</h4>
								</td>
								<td>
									<h5>You Have To Pay Once For Whole Order</h5>
								</td>
								<td>
									<p>{{Session::get('shipping_price')}}</p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>Subtotal</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>{{Session::get('totalPrice')}}</p>
								</td>
							</tr>
							
							<tr>
								<td>
									<h4>Total</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p class="font-weight-bold">RS : {{Session::get('totalPrice')}}</p>
								</td>
							</tr>
						</tbody>
					</table>

					<form action="{{route('order.place')}} " method="post">
						@csrf
				
					<textarea name="shipping_address" class="form-control col-md-5" placeholder="Please Enter Shipping Address Must" required></textarea>
					
				<br>
	
				<script
				    src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
                    data-key="{{env('STRIPE_PUB_KEY','pk_test_QKqLlie4xGHhnYyI8KqEmhMr00pFa8lQ1l')}}"
                    data-amount="{{Session::get('totalPrice')*100}}"
                    data-name="Checkout"
                    data-description="PLease fill up the form"
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                    data-locale="auto"
                    data-currency="pkr" >
				</script>

					<input type="hidden" name="amount" value="{{Session::get('totalPrice')*100}}">
					</form>
				</div>
			</div>
			
		</div>
	</section>


@include('front-end.partials.footer')

@include('front-end.partials.js-file')