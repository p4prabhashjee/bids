
@include('frontend.layouts.header')

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
    @section('content')
    <div class="row">
        @foreach ($wishlistItems as $item)
            <div class="col-md-6">
                <a href="#">
                    <div class="card-product">
                        <div class="product-image">
                            <img src="{{ asset('frontend/images/product-img.png') }}" alt="">
                            <i class="fa fa-heart"></i>
                        </div>
                        <div class="card-product-dtl">
                            <h3>{{ $item->product->title }}</h3>
                            <h5>${{ $item->product->reserved_price }}</h5>
                            <p>Current Bid: <span>00</span></p>
                            <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{ asset('images/next-arrow.svg') }}" alt=""></button>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
        <!-- <ul class="pagination">
          <li><a href=""><img src="./images/left-1.svg" alt=""></a></li>
          <li><a href="">1</a></li>
          <li><a class="active" href="">2</a></li>
          <li><a href="">3</a></li>
          <li><a href=""><img src="./images/left-1.svg" alt=""></a></li>
        </ul> -->
        <ul class="pagination">
        {{ $wishlistItems->links() }}
        </ul>
       
    </div>
  </section>
@include('frontend.layouts.footer')
