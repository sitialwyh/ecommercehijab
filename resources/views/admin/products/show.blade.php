@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Show Product</div>

                <div class="card-body">
                    <table class="table text-semibold">
                        <tbody>
                            <tr>
                                <td class="col-xs-2">Name</td>
                                <td class="col-xs-2">{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td class="col-xs-2">Price</td>
                                <td class="col-xs-2">{{ $product->price }}</td>
                            </tr>
                            <tr>
                                <td class="col-xs-2">Description</td>
                                <td class="col-xs-2">{{ $product->description }}</td>
                            </tr>
                            
                            @if(!$product->images()->get()->isEmpty())
                            <div class="col">
                                <div class="product-section-image">
                                    <img src="{{ asset('/images/'.$product->image()->get()[0]->image_src) }}" class="card-img-top" id="currentImage">
                                </div>

                                <div class="product-section-images">
                                    @foreach($product->image()->get() as $image)
                                    <div class="product-thumbnail mt-3">
                                        <img src="{{ asset('/images/'.$image->image_src) }}" class="card-img-top">
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <tr>
                                <td class="col-xs-2">Images</td>
                                @foreach($product->images()->get() as $image)
                                <td class="col-xs-2">
                                    <image src="{{ asset('/images/'.$image->image_src) }}" class="img-thumbnail img-fluid" alt="{{ $image->image_desc }}" style="width:200px;height:200px;"></image>
                                </td>
                                @endforeach
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="form-group" style="margin-top:40px">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

