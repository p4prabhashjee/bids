@php
$cat = App\Models\Category::where('status',1)->orderBy('name','ASC')->get();
@endphp

@php
$categories = App\Models\Category::where('status', 1)
->orderBy('name', 'ASC')
->withCount('products')
->get();
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{asset('frontend/images/logo.svg')}}">
    <title>Bid</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <nav class="nav header"> 
          <div class="search-logo">
            <div class="logo">
              <a href="{{url('/')}}"><img src="{{asset('frontend/images/logo.svg')}}" alt=""></a>
          </div>
           <div class="">
            <form action="" class="search-frm">
              <div class="form-group">
                <input type="text" placeholder="Search all lots and listings">
                <img class="input-lft-icon" src="{{asset('frontend/images/search-icon.svg')}}" alt="">
              </div>

            </form>
           </div>
          </div>
          <div id="mainListDiv" class="main_list">
              <ul class="navlinks">
              <li><a href="{{url('/')}}">Home</a></li>

              <li class="category-menu">
                    <a href="#">Category</a>
                    <div class="category-list">
                        <ul>
                            @foreach($categories as $category)
                            <li>
                                <a href="#">{{ $category->name }} ({{ $category->products_count }})</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li><a href="{{route('about-us')}}">About Us</a></li>
                  <li><a href="contact-us.html">Contact Us</a></li>
                  <li><button class="lange-drop" type="button">Eng <img src="{{asset('frontend/images/drop-nav.svg')}}" alt=""></button>
                    <div class="drop-lange-select">
                      <ul>
                        <li><img src="{{asset('frontend/images/eng.svg')}}" alt=""> English <input type="radio" name="" id=""></li>
                        <li><img src="{{asset('frontend/images/Ara.svg')}}" alt=""> Arabic <input type="radio" name="" id=""></li>
                      </ul>
                    </div>
                  </li>
                  <li><a class="btn btn-secondary px-5" href="{{route('signin')}}">Login</a></li>
              </ul>
          </div>
          <span class="navTrigger">
              <i></i>
              <i></i>
              <i></i>
          </span> 
  </nav>


  <style>
   .category-menu {
    position: relative;
    display: inline-block;
}

.category-list {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    z-index: 1;
}

.category-menu:hover .category-list {
    display: block;
}

.category-list ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-list li {
    padding: 5px;
}

.category-list a {
    text-decoration: none;
    color: #333;
}

.category-list a:hover {
    color: #555;
}

</style>
<script>
$(document).ready(function() {
    $('.category-menu').hover(
        function() {
            $('.category-list', this).show();
        },
        function() {
            $('.category-list', this).hide();
        }
    );
});
</script>