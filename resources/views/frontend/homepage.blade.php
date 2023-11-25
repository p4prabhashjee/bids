@include('frontend.layouts.header')

<section class="home home_slider">
    <div class="owl-carousel owl-theme">
        @foreach($banners as $b)
        @if(!empty($b->image_path))
        <div class="item" style="background-image: url('{{ asset('img/users/' . $b->image_path) }}');">
            @else
            <div class="item" style="background-image: url('{{ asset('frontend/images/slider-bg.png') }}');">
                @endif
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hero-section">
                                <h1>{{$b->title}} <br>
                                </h1>
                                <p>{{ strip_tags($b->description) }}</p>
                                <div class="hero-section-btn">
                                    <a href="{{ url('products', $b->url) }}" class="btn btn-secondary">Explore Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</section>
<section class="trending-auction-section">
    <div class="container">
        <div class="section-heading">
            <h2>Trending Auctions</h2>
            <p>See what’s popular across thousands of items.</p>
        </div>
        @foreach($auctionTypesWithProject as $at)
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="auction-type   align-just">
                    <div>
                        <h2>{{$at->name}}</h2>
                        <a href="{{ url('projects', $at->slug) }}" class="border-white-btn">VIEW ALL</a>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-9 col-md-12">
                <div class="row">
                    @foreach($at->projects as $project)
                    <div class="col-lg-6 col-md-12">
                        <a href="#">
                            <div class="card-product">
                                <div class="product-image">
                                    @if (!empty($project->image_path))
                                    <img src="{{ asset("img/projects/$project->image_path") }}"
                                        alt="{{ $project->title }}">
                                    @else
                                    <img src="{{ asset('frontend/images/default-product-image.png') }}"
                                        alt="Default Image">
                                    @endif
                                </div>

                                <div class="card-product-dtl">
                                    <h3>{{ $project->name }} </h3>
                                    @php
                                    $originalDateTime = $project->start_date_time;
                                    $timestamp = strtotime($originalDateTime);
                                    $formattedDateTime = date("F j, g:i A", $timestamp);
                                    @endphp

                                    <!-- echo "<p>" . $formattedDateTime . "</p>"; -->
                                    <p>{{  $formattedDateTime }}</p>
                                    <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                                            src="{{ asset('frontend/images/next-arrow.svg') }}" alt=""></button>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="most-view-product">
    <div class="container">
        <div class="section-heading">
            <h2>Popular Lots</h2>
            <p>Immerse yourself in the world of luxury fashion with our meticulously crafted designer clothes!</p>
        </div>
        <div class="popular_slider owl-carousel owl-theme">
            @foreach ($productauction as $auctionType)
            @if ($auctionType->name == 'Live' || $auctionType->name == 'Private' || $auctionType->name == 'Timed')
            @foreach ($auctionType->products as $product)

            <div class="item">
                <div class="popular_slider_item card-most-product">
                    <div class="img-card">
                        @if ($product->galleries->isNotEmpty())
                        <img src="{{ asset($product->galleries->first()->image_path) }}" alt="">
                        @else
                        <img src="{{asset('frontend/images/default-product-image.png')}}" alt="Default Image">
                        @endif
            
                        @auth

                        <div class="heat-like wishlist-heart" data-product-id="{{ $product->id }}">
                            <input type="checkbox" name="" id="" @if(in_array($product->id, $wishlist)) checked @endif>
                            <img src="{{asset('frontend/images/heart.png')}}" alt="">
                        </div>
                        <!--  -->
                        <!-- <i class="fa fa-heart-o wishlist-heart" data-product-id="{{ $product->id }}"></i> -->
                        @else
                            <a href="{{ route('signin') }}"> <i class="fa fa-heart-o "></i></a>
                    @endauth
                   
                       
                        <!-- <i class="fa fa-heart-o"></i> -->
                        <div class="bid-box-status">
                            <div class="bid-box-status-ic"><img
                                    src="{{asset('frontend/images/live.svg')}}"><span>{{ $auctionType->name }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="popular_lnt">
                        <span>${{ $product->reserved_price }}</span>
                        @if ($auctionType->name == 'Private' || $auctionType->name == 'Timed')
                        <div class="countdown-time thisisdemoclass" data-id='{{ $product->id }}'
                            data-date='{{ $product->auction_end_date }}' id="countdown-{{ $product->id }}">
                            <ul>
                                <li><span class="days"></span>days</li>
                                <li><span class="hours"></span>Hours</li>
                                <li><span class="minutes"></span>Minutes</li>
                                <li><span class="seconds"></span>Seconds</li>
                            </ul>
                        </div>
                        @endif
                    </div>

                    <h3><a href="{{ url('productsdetail', $product->slug) }}">{{ $product->lot_no }}:
                            {{ substr(strip_tags($product->title), 0, 20) }}
                            {{ strlen(strip_tags($product->title)) > 20 ? '...' : '' }}
                        </a></h3>
                    <p>
                        {{ substr(strip_tags($product->description), 0, 100) }}
                        {{ strlen(strip_tags($product->description)) > 100 ? '...' : '' }}
                    </p>

                    <span class="curnt-bid-man">Current Bid $10,000.00</span>
                    <a href="#" class="next-btn-img"><img src="{{asset('frontend/images/next-btn.svg')}}"
                            alt=""></a>
                </div>
            </div>
            @endforeach
            @endif
            @endforeach
        </div>
    </div>
</section>



<section class="most-bid">
    <div class="container">
        <div class="section-heading">
            <h2>Most Bids</h2>
            <p>Immerse yourself in the world of luxury fashion with our meticulously crafted designer clothes!</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="bid-box">
                    <div class="heat-like">
                        <input type="checkbox" name="" id="">
                        <img src="{{asset('frontend/images/heart.png')}}" alt="">
                    </div>
                    <div class="box-img">
                        <img src="{{asset('frontend/images/bid-1.png')}}" alt="">
                    </div>
                    <div>
                        <div class="bid-box-status">
                            <div class="bid-box-status-ic"><img
                                    src="{{asset('frontend/images/live.svg')}}"><span>Live</span></div>
                        </div>
                        <h3><a href="detail.html">2213: Mini 3D Glass</a></h3>
                        <p>$2,400 <span>71 bids</span></p>
                        <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                                src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bid-box">
                    <div class="heat-like">
                        <input type="checkbox" name="" id="">
                        <img src="{{asset('frontend/images/heart.png')}}" alt="">
                    </div>
                    <div class="box-img">
                        <img src="{{asset('frontend/images/bid-2.png')}}" alt="">
                    </div>
                    <div>
                        <div class="bid-box-status">
                            <div class="bid-box-status-ic"><img
                                    src="{{asset('frontend/images/live.svg')}}"><span>Live</span></div>
                        </div>
                        <h3><a href="detail.html">2213: Mini 3D Glass</a></h3>
                        <p>$2,400 <span>71 bids</span></p>
                        <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                                src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bid-box">
                    <div class="heat-like">
                        <input type="checkbox" name="" id="">
                        <img src="{{asset('frontend/images/heart.png')}}" alt="">
                    </div>
                    <div class="box-img">
                        <img src="{{asset('frontend/images/bid-3.png')}}" alt="">
                    </div>
                    <div>
                        <div class="countdown-time" id="countdown">
                            <ul>
                                <li><span id="days"></span>days</li>
                                <li><span id="hours"></span>Hours</li>
                                <li><span id="minutes"></span>Minutes</li>
                                <li><span id="seconds"></span>Seconds</li>
                            </ul>
                        </div>
                        <div class="bid-box-status">
                            <div class="bid-box-status-ic"><img
                                    src="{{asset('frontend/images/private.svg')}}"><span>Private</span></div>
                        </div>
                        <h3><a href="detail.html">2278: Kotion Headset</a></h3>
                        <p>$2,400 <span>71 bids</span></p>
                        <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                                src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bid-box">
                    <div class="heat-like">
                        <input type="checkbox" name="" id="">
                        <img src="{{asset('frontend/images/heart.png')}}" alt="">
                    </div>
                    <div class="box-img">
                        <img src="{{asset('frontend/images/bid-4.png')}}" alt="">
                    </div>
                    <div>
                        <div class="bid-box-status">
                            <div class="bid-box-status-ic"><img
                                    src="{{asset('frontend/images/private.svg')}}"><span>Private</span></div>
                        </div>
                        <h3><a href="detail.html">22456: Bluetooth Gamepad</a></h3>
                        <p>$2,400 <span>71 bids</span></p>
                        <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                                src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bid-box">
                    <div class="heat-like">
                        <input type="checkbox" name="" id="">
                        <img src="{{asset('frontend/images/heart.png')}}" alt="">
                    </div>
                    <div class="box-img">
                        <img src="{{asset('frontend/images/bid-5.png')}}" alt="">
                    </div>
                    <div>
                        <div class="bid-box-status">
                            <div class="bid-box-status-ic"><img
                                    src="{{asset('frontend/images/private.svg')}}"><span>Private</span></div>
                        </div>
                        <h3><a href="detail.html">2245: Mini 3D Glass</a></h3>
                        <p>$2,400 <span>71 bids</span></p>
                        <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                                src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bid-box">
                    <div class="heat-like">
                        <input type="checkbox" name="" id="">
                        <img src="{{asset('frontend/images/heart.png')}}" alt="">
                    </div>
                    <div class="box-img">
                        <img src="{{asset('frontend/images/bid-6.png')}}" alt="">
                    </div>
                    <div>
                        <div class="bid-box-status">
                            <div class="bid-box-status-ic"><img
                                    src="{{asset('frontend/images/private.svg')}}"><span>Private</span></div>
                        </div>
                        <h3><a href="detail.html">2214: Kotion Headset</a></h3>
                        <p>$2,400 <span>71 bids</span></p>
                        <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                                src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bid-box">
                    <div class="heat-like">
                        <input type="checkbox" name="" id="">
                        <img src="{{asset('frontend/images/heart.png')}}" alt="">
                    </div>
                    <div class="box-img">
                        <img src="{{asset('frontend/images/bid-7.png')}}" alt="">
                    </div>
                    <div>
                        <div class="bid-box-status">
                            <div class="bid-box-status-ic"><img
                                    src="{{asset('frontend/images/timed.svg')}}"><span>Timed</span></div>
                        </div>
                        <h3><a href="detail.html">2225: Apple iPhone 6s</a></h3>
                        <p>$2,400 <span>71 bids</span></p>
                        <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                                src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bid-box">
                    <div class="heat-like">
                        <input type="checkbox" name="" id="">
                        <img src="{{asset('frontend/images/heart.png')}}" alt="">
                    </div>
                    <div class="box-img">
                        <img src="{{asset('frontend/images/bid-8.png')}}" alt="">
                    </div>
                    <div>
                        <div class="bid-box-status">
                            <div class="bid-box-status-ic"><img
                                    src="{{asset('frontend/images/timed.svg')}}"><span>Timed</span></div>
                        </div>
                        <h3><a href="detail.html">2252: Moving Camera</a></h3>
                        <p>$2,400 <span>71 bids</span></p>
                        <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                                src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bid-box">
                    <div class="heat-like">
                        <input type="checkbox" name="" id="">
                        <img src="{{asset('frontend/images/heart.png')}}" alt="">
                    </div>
                    <div class="box-img">
                        <img src="{{asset('frontend/images/bid-9.png')}}" alt="">
                    </div>
                    <div>
                        <div class="bid-box-status">
                            <div class="bid-box-status-ic"><img
                                    src="{{asset('frontend/images/timed.svg')}}"><span>Timed</span></div>
                        </div>
                        <h3><a href="detail.html">2278: Kotion Headset</a></h3>
                        <p>$2,400 <span>71 bids</span></p>
                        <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                                src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $(document).ready(function () {
        $('.wishlist-heart').click(function () {
            var productId = $(this).data('product-id');
            var action = $(this).hasClass('active') ? 'remove' : 'add';

            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: action === 'add' ? '{{route("addToWishlist")}}' : '{{route("removeFromWishlist")}}',
                data: { product_id: productId },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if (action === 'add') {
                        $(this).addClass('active');
                    } else {
                        $(this).removeClass('active');
                    }
                    alert(response.message); 
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseJSON.error); 
                }
            });
        });
    });
</script>



@include('frontend.layouts.footer')