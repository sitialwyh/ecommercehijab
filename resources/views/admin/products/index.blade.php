@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col">
                <h3 style=" text-align: center; color: black;">Data Product</h3>
                <div>
                    <div style="margin-bottom:10px;">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Produk</a>
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class="table table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">ID</th>
                                    <th style="text-align:center;">Name</th>
                                    <th style="text-align:center;">Price</th>
                                    <th style="text-align:center;">Created Date</th>
                                    <th style="text-align:center;" colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td style="text-align:center;">{{ $product['id'] }}</td>
                                    <td style="text-align:center;">{{ $product['name'] }}</td>
                                    <td style="text-align:center;">{{ $product['price'] }}</td>
                                    <td style="text-align:center;">{{ $product['created_at'] }}</td>
                                    <td style="text-align:center;">

                                        <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.products.edit',$product->id) }}">Edit</a>

                                            <a class="btn btn-success btn-sm" href="{{ route('admin.products.show',$product->id) }}">Detail</a>


                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>      
    </div>
</div>
@endsection
