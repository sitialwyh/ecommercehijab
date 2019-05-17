<script src="{{ asset('js/app.js') }}"></script>

<script>
	$(document).ready(function(){
		;$('[data-toggle="tooltip"]').tooltip();
	})
</script>

<script type="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".update-cart").click(function(e) {
			e.preventDefault();
				console.log('aaaa');
				var ele = $(this);

			$.ajax({
				url: '{{ route('carts.update') }}',
				method: "PATCH",
				data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
				success: function(response) {
					window.location.reload();
				}
			});
		});

		$(".remove-from-cart").click(function (e) {
			e.preventDefault();

			var ele = $(this);
			if(confirm("Are you sure")) {
				$.ajax({
					url: '{{ route('carts.remove') }}',
					method: "DELETE",
					data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
					success: function (response) {
						window.location.reload();
					}
				});
			}
		});
	});
</script>

<script type="text/javascript">
    tinymce.init({
        selector: '#'
    });

</script>

<script>
    (function() {
        const currentImage = document.querySelector('#currentImage');
        const images = document.querySelectorAll('.product-thumbnail');

        images.forEach((element) => element.addEventListener('click', thumbnailClick));

        function thumbnailClick(e) {
            currentImage.src = this.querySelector('img').src;
        }
    })();
</script>

<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#order_field').change(function(){
            // window.location.href = '/product?order_by=' + $(this).val();
            $.ajax({
            	type: 'GET',
            	url: '/products',
            	data: {
            		order_by: $(this).val(),
            	},
            	dataTypeL 'json',
            	success: function(data) {
            		var products = '';
            		$.each(data, function(idx, product) {
            			if(idx == 0 || idx % 4 == 0) {
            				products +='<div class="row mt-4">';
            			}

            			products += '<div class="col">' +
            			'<div class="card">' +
            			'<img src="/products/image/' + product.image_url + '"class="card-img-top" alt="...">'+
            			'<div class="card-body">' +
            			'<h5 class="card-title">' +
            			'<a href="/products/' + product.id + '">' + product.name +
            			'</a>' +
            			'</h5>' +
            			'<p class="card-text">' + product.price + '</p>' +
            			'<a href="/carts/add/' + product.id + '" class="btn btn-primary">Beli</a>' +
            			'</div>' +
            			'</div>' +
            			'</div>' ;

            			if(idx > 0 && idx % 4 == 3) {
            				products += '</div>';
            			}
            		});

            		//update element
            		$('#product-list').html(products);
            	},
            	error: function(data){
            		alert('Unable to handle request');
            	}
            });
        });
    });
</script>
@stack('script')