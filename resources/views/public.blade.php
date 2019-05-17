@extends('layouts.app')

@section('content')
<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-4 offset-md-8">
            <div class="form-group">
                <select id="order_field" class="form-control">
                    <option value="" disabled selected>Urutkan</option>
                    <option value="best_seller">Best Seller</option>
                    <option value="terbaik">Terbaik (Berdasarkan Rating)</option>
                    <option value="termurah">Termurah</option>
                    <option value="termahal">Termahal</option>
                    <option value="terbaru">Terbaru</option>
                </select>
            </div>
        </div>
    </div>
    <div id="product-list">
    @foreach($products as $idx => $product)
        @if ($idx == 0 || $idx % 4 == 0)
            <div class="row mt-4">
        @endif

        <div class="col">
            <div class="kotak" style="height: 490px; width: 255px;">
                <?php
                $pro=App\Models\Product::find($product->id)
                ?>

                     <image src="{{ asset('/images/'.$pro->images()->get()[0]->image_src) }}" class="img-thumbnail img-fluid" style="width:600px;height:300px;"></image>
                
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $product->name}}
                    </h5>
                    <p class="card-text">
                        Rp. {{ $product->price }}
                    </p>
                    <br/>
                    <a href="{{ route('carts.add',['id' => $product->id]) }}" class="btn btn-primary">Beli</a>
                    <a href="{{ url('lihat',$product->id) }}" class="btn btn-success">Detail</a>
                </div>
            </div>
        </div>
        @if ($idx > 0 && $idx % 4 == 3)
    </div>
        @endif
    @endforeach
</div>
</div>
@endsection 