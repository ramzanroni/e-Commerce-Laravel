@extends('layouts.front_master')
@section('font_content')
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categorys</span>
                    </div>
                    <ul>
                        @php
                        $categories=App\Models\Category::where('status',1)->latest()->get();
                    @endphp
                    @foreach ($categories as $category)
                    <li><a href="#">{{ $category->category_name }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('fontend') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Wishlist</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Home</a>
                        <span>Wishlist</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    @if (session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    @if (session('remove'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('remove') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Add To Cart</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($wishlists as $item)
                                
                            
                            <tr>
                                <td class="shoping__cart__item">
                                    <img style="height: 70px; width: 70px;" src="{{ asset($item->product->product_img_1) }}" alt="">
                                    <h5>{{ $item->product->product_name }}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{ $item->product->price }}
                                </td>
                                <td class="shoping__cart__item__close text-center">
                                    <form action="{{ 'add_to_cart/'.$item->product_id }}" method="POST">
                                        @csrf
                                        <input type="text" name="price" value="{{  $item->product->price  }}" hidden>
                                        <button class="btn btn-sm btn-warning"><i class="fa fa-shopping-bag"></i></button>
                                    </form>
                                </td>
                                <td class="shoping__cart__item__close text-center">
                                    <a href="/wishlist_remove/{{ $item->id }}"><i class="fas fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection