@extends('layouts.app')
@section('content')

    <style>
        .addwishlist{
            padding: 12px 18px;
            border: none;
            color: #333;
        }
        .addwishlist:hover{
            background-color: #c43b68;
            color: #f3f3f3;
        }
        .i_wish:hover{
            color: #f3f3f3;
        }

        .addCart{
            border: none;
        }
    </style>

    @php
        $product = DB::table('products')
        ->join('brands','products.brand_id','brands.id')
        ->select('products.*','brands.brand_name')
        ->where('category_id',2)->where('subcategory_id',2)->where('status',1)->orderBy('id','DESC')->get();
    @endphp

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: url('{{ asset("public/frontend/images/slider/bg/slider-1.jpg") }}') no-repeat center center / cover ; height: 40vh">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <h2 style="color: #f2dede; text-align: left; font-weight: bold">Normal Laptop</h2>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->

    <!-- Start Contact Area -->
    <section class="htc__contact__area ptb--100" style="background: #1e1e24">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">
                    <div class="product__wrap clearfix">

                        <!-- Start Single Category -->
                        @foreach($product  as $pr)
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                <div class="category cat_bg">
                                    <div class="ht__cat__thumb">
                                        <ul style="text-align: center">
                                            <li style="text-align: center">
                                                <a href="{{ url('product/details/'.$pr->product_slug) }}" style="width: 120px"><img src="{{ URL::to($pr->product_image_one) }}" alt="" height="160px" width="100px"></a>
                                            </li>
                                            <li style="padding: 10px; text-align: center">
                                                <a href="{{ url('product/details/'.$pr->product_slug) }}"><h5 style="color: #fff">{{ $pr -> product_name }}</h5></a>
                                            </li>
                                            <hr>

                                            <li><strong style="color: #fff">Product Code: </strong> &nbsp;{{ $pr->product_code }} </li>
                                            <li><strong style="color: #fff">Product Model: </strong> &nbsp; {{ $pr->product_model }} </li>
                                            <li><strong style="color: #fff;">Available Colors: </strong> &nbsp;  <span style="text-transform: capitalize;">{{ $pr->product_color }}</span> </li>
                                            <li><strong style="color: #fff">Brand: </strong> &nbsp;  {{ $pr->brand_name }}</li>
                                        </ul>
                                    </div>
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li><button class="addwishlist" title="Add to Wishlist" data-id="{{ $pr->id }}"><i class="icon-heart icons"></i></button></li>
                                            <li><a href="{{ url('product/details/'.$pr->product_slug) }}" title="View Product"><i class="icon-eye icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="fr__product__inner">
                                        <ul>
                                            <li><strong style="color: #fff">Price: </strong><h3 class="recom__price" style="color: maroon">{{ $pr->selling_prize }}<sup>TK</sup></h3></li>
                                        </ul>
                                        <br>
                                        <button class="fr__btn addCart" data-id="{{ $pr-> id }}">ADD TO CART</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Category -->
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="htc__product__leftsidebar">
                        <!-- Start Prize Range -->
                        <div class="htc-grid-range">
                            <h4 class="title__line--4" style="color: white">Price</h4>
                            <div class="content-shopby">
                                <div class="price_filter s-filter clear">
                                    <form action="#" method="GET">
                                        <div id="slider-range"></div>
                                        <div class="slider__range--output">
                                            <div class="price__output--wrap">
                                                <div class="price--output">
                                                    <span style="color:gray;">Price :</span><input type="text" name="price_filter" id="amount" readonly style="background-color: #1e1e24; color: white">
                                                </div>
                                                <div class="price--filter">
                                                    <a href="#" style="color: white">Filter</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Prize Range -->

                        <!-- Start Brand Area -->
                        <div class="htc__category">
                            <h4 class="title__line--4" style="color: white">brands</h4>
                            @php
                                $brands = DB::table('brands')->get();
                            @endphp
                            <ul class="ht__cat__list">
                                @foreach($brands as $br)
                                    <li><a style="color: gray" href="#">{{ $br->brand_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Brand Area -->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End gear Area -->

    <!-- Ajax CDN -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <!-- Ajax For Add Wishlist-->
    <script type="text/javascript">
        $(document).ready(function () {
            $('.addwishlist').on('click', function() {
                var id = $(this).data('id');
                if(id){
                    $.ajax({
                        url: "{{ url('/add/wishlist/') }}/"+id,
                        type: "GET",
                        dataType: "json",
                        success:function (data) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            if($.isEmptyObject(data.error)){
                                Toast.fire({
                                    type: 'success',
                                    title: data.success,
                                })
                            }else{
                                Toast.fire({
                                    type: 'error',
                                    title: data.error,
                                })
                            }

                        },
                    })
                }
                else{
                    alert('danger');
                }
            })
        })
    </script>


    <!-- Ajax For Add Cart-->

    <script type="text/javascript">
        $(document).ready(function () {
            $('.addCart').on('click', function(){
                var id = $(this).data('id');

                if(id){
                    $.ajax({
                        url: "{{ url('/add/to/cart/') }}/"+id,
                        type: "GET",
                        dataType: "json",
                        success:function (data) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            if($.isEmptyObject(data.error)){
                                Toast.fire({
                                    type: 'success',
                                    title: data.success,
                                })
                            }else {
                                Toast.fire({
                                    type: 'error',
                                    title: data.error,
                                })
                            }
                        },
                    })
                }
            })
        })
    </script>

@endsection
