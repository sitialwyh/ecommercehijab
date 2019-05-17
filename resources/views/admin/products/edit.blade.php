@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                    <div class="col-md-10">
                        @if(count($errors))
                        <div class="form-group">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        <form action="{{ route('admin.products.update',$product->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf @method('PATCH')
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Product Name" name="name" value={{ $product->name }}>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="" class="form-control" placeholder="Product Price" name="price" value={{ $product->price }}>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control" rows="3" name="description" id="description">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="images">Images</label>
                                <input type="file" class="form-control-file" name="images[]" id="images" multiple>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description'
        });
    </script>
@endsection
