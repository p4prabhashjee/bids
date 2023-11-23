@include('frontend.layouts.header')
<style>
  .text-muted {
   
    display: none;
}
  </style>
<section class="hero-ther">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 text-center">
                <h1>Favourite</h1>
                <p></p>
                <form action="" class="search-frm-prdt">
                    <input type="text" name="" id="" placeholder="Search products...">
                    <button><img class="w-100" src="{{ asset('frontend/images/rounded-sr.svg') }}" alt=""></button>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="product-list-man mt-5">
    <div class="container">
        <div class="row">
        @forelse ($wishlistItems as $item)
            <div class="col-md-6">
                <a href="{{ url('productsdetail', $item->product->slug) }}">
                    <div class="card-product">
                        <div class="product-image">
                            @if ($item->product->galleries->isNotEmpty())
                            <img src="{{ asset($item->product->galleries->first()->image_path) }}" alt="">
                            <i class="fa fa-heart-o"></i>
                            @else
                            <img src="{{asset('frontend/images/default-product-image.png')}}" alt="">
                            <i class="fa fa-heart-o"></i>
                            @endif

                        </div>
                        <div class="card-product-dtl">
                            <h3>{{ $item->product->title }}</h3>
                            <h5>${{ $item->product->reserved_price }}</h5>
                            <p>Current Bid: <span>00</span></p>
                            @if ($item->product->auctionType->name == 'Private' || $item->product->auctionType->name == 'Timed')
                            <div class="countdown-time thisisdemoclass" data-id='{{ $item->product->id }}'
                                    data-date='{{ $item->product->auction_end_date }}' id="countdown-{{ $item->product->id }}">
                                    <ul>
                                        <li><span class="days"></span>days</li>
                                        <li><span class="hours"></span>Hours</li>
                                        <li><span class="minutes"></span>Minutes</li>
                                        <li><span class="seconds"></span>Seconds</li>
                                    </ul>
                            </div>
                            @endif

                            
                            <div class="bid-box-status">
                                        <div class="bid-box-status-ic"><img
                                                src="{{asset('frontend/images/live.svg')}}"><span>{{ $item->product->auctionType->name }}</span>
                                        </div>
                            </div>
                            <button class="text-btn">Bid Now <img class="img-fluid ms-3"
                                    src="{{ asset('images/next-arrow.svg') }}" alt=""></button>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-md-12">
          
                           
                            <img src="{{asset('frontend/images/dribble_shot_62_4x.jpg')}}" alt="">
                           

                      
            </div>
            @endforelse
        </div>
        <ul class="pagination">
           
              {{ $wishlistItems->appends($_GET)->links('pagination::bootstrap-5') }} 
          
        </ul>

    </div>
</section>
@include('frontend.layouts.footer')