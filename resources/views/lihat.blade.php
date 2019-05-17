@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(!$product->images()->get()->isEmpty())
            <div class="mySlides">
                <div class="product-section-image">
                    <image src="{{ asset('/images/'.$product->images()->get()[0]->image_src) }}" class="img-thumbnail img-fluid"></image>
                 </div>

                 <div class="product-section-images">
                    @foreach($product->images()->get() as $image)
                    <div class="column">
                        <div class="product-thumbnail mt-3">
                            <img src="{{ asset('/images/'.$image->image_src) }}" class="card-img-top" height="70">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-9">
            <h3>
                {{ $product->name }}
            </h3>
            <h4>
                {{ $product->price }}
            </h4>
            <br>
            <h5 style="color: orange;">

                <?php
                $total = 0;
                $jumlah = 0;
                $avg = 0;

                foreach ($reviews as $id => $review) {
                    $total += $review->rating;
                }

                $jumlah = count($reviews->all());

                $star = 1;
                if ($jumlah<>0) {
                    $avg = $total/$jumlah;
                    while ($star <= 5) {
                        while ($star <= $avg) {
                            echo '<i class="fas fa-star fa-1x"></i>';
                            $star++;
                        }
                        while ($star <= 5) {
                            echo '<i class="far fa-star fa-1x"></i>';
                            $star++;
                        }
                    }
                }

                else {
                    while ($star <= 5) {
                        echo '<i class="far fa-star fa-1x"></i>';
                        $star++;
                    }
                }

                ?>

                <p style="font-size: 13px">( {{ floatval($avg) }} )</p>
            </h5>

            <div class="mt-4">
                <a href="{{ url('product') }}" class="btn btn-warning text-white">Back</a>
                <a href="{{ route('carts.add', ['id' => $product['id']]) }}" class="btn btn-primary">Beli</a>
            </div><br/>


            <h5>Share :</h5>

            <div class="mt-2">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('lihat', ['id' => $product['id']]) }}" class="social-button mr-1" target="_blank">
                 <i class="fab fa-2x fa-facebook"></i></a>

                 <a href="https://www.twitter.com/intent/tweet?text-my share text&amp;url={{ url('lihat', ['id' => $product['id']]) }}" class="social-button mr-1" target="_blank">
                  <i class="fab fa-2x fa-twitter-square"></i></a>

                 <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ url('lihat', ['id' => $product['id']]) }} &amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button mr-1" target="_blank">
                  <i class="fab fa-2x fa-linkedin"></i></a>

                 <a href="https://api.whatsapp.com/send?phone=62895320882309&text=Ayo%20beli%20produk%20ini!%20Sekarang%20juga%20dapatkan%20promo%20terbaik={ url('lihat', ['id' => $product['id']]) }}" class="social-button mr-1" target="_blank">
                  <i class="fab fa-2x fa-whatsapp"></i></a>
            </div>

            <div class="mt-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Deskripsi</a></li>

                <li class="nav-item"><a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Review</a></li>
            </ul>
            </div>
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">{!! $product->description !!}</div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @if (Auth::check())
                <form action="{{ route('posts.review') }}" method="POST" enctype="multipart/form-data">
                    
                    @csrf

                    <input type="text" name="product_id" value="{{ $product['id'] }}" hidden>
                    <div class="form-group">
                        <label for="desc">Ulasan</label>
                        <input class="form-control" type="text" name="description" placeholder="Deskripsi Produk" id="ckview">
                    </div>

                    <script src="{{ url('plugins/tinymce/jquery.tinymce.min.js') }}"></script>
                    <script src="{{ url('plugins/tinymce/tinymce.min.js') }}"></script>
                    <script type="text/javascript"> tinymce.init({ selector: '#ckview' }); </script>

                    <div class="form-group">
                        <label for="nama">Rating (Masukkan Angka 1-5)</label>
                        <input class="form-control" type="text" name="rating" placeholder="Rating 1-5" id="nama">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @endif
                <br>
                @foreach ($reviews as $review)
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                    <p class="text-secondary text-center">{{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</p>
                                </div>
                                <div class="col-md-10">
                                        <a href="#">
                                            <strong>
                                                {{ $review->user->name }}
                                            </strong>
                                        </a>
                                        <!-- <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                        <span class="float-right"><i class="text-warning fa fa-star"></i></span> -->
                                    <div class="clearfix"></div>

                                    <p>{!! $review->description !!}</p>
                                    <!-- <p>Pengiriman : {{ $review->comen }}</p> -->
                                    <?php
                                        $star = 1;
                                        while($star <= 5)
                                        {
                                            while ($star <= $review->rating) {
                                                echo '<i class="fas fa-star" style="color:orange"></i>';
                                                $star++;
                                            }

                                            while($star <= 5)
                                            {
                                                echo '<i class="far fa-star" style="color:orange"></i>';
                                                $star++;
                                            }
                                        }
                                    ?>
                                    
                                    <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
                                    <a class="float-right btn text-white btn-primary"> <i class="fa fa-heart"></i> Like</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

