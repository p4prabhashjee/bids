@include('frontend.layouts.header')

<section class="home">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="hero-section">
            <h1>Find your dream car <br>
              & give it a try</h1>
              <p>Vivamus id ligula non turpis aliquam dignissim.  Fusce <br>
                tempor vulputate urna, quis malesuada.</p>
                <a href="" class="btn btn-secondary">view auctions</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="trending-auction-section">
    <div class="container">
      <div class="section-heading">
        <h2>Trending Auctions</h2>
        <p>See what’s popular across thousands of items.</p>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-12">
          <div class="auction-type   align-just">
           <div> 
            <h2>Private</h2>
            <p>1200 Product</p>
            <a href="product-list.html" class="border-white-btn">VIEW ALL ITEMS</a>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-12">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <a href="detail.html">
                <div class="card-product">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Current Bid: <span> $1400.00</span></p>
                    <button class="text-btn">Bid Now <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-6 col-md-12">
              <a href="detail.html">
                <div class="card-product">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-2.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Current Bid: <span> $1400.00</span></p>
                    <button class="text-btn">Bid Now <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-6 col-md-12">
              <a href="detail.html">
                <div class="card-product">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-3.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry</h3>
                    <h5>$1200.00</h5>
                    <p>Current Bid: <span> $1400.00</span></p>
                    <button class="text-btn">Bid Now <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}"alt=""></button>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-6 col-md-12">
              <a href="detail.html">
                <div class="card-product">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-4.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Current Bid: <span> $1400.00</span></p>
                    <button class="text-btn">Bid Now <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>


      <div class="row mt-5">
        <div class="col-lg-3 col-md-12">
          <div class="auction-type light-clr  align-just">
           <div> 
            <h2>Live</h2>
            <p>1200 Product</p>
            <a href="product-list.html" class="border-white-btn">VIEW ALL ITEMS</a>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-12">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <a href="detail.html">
                <div class="card-product live-procut">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-5.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Current Bid: <span> $1400.00</span></p>
                    <p>Upcoming :  <span class="text-dark"> 01 Oct 2023     <span class="ms-2 text-dark">10:00 AM </span></span></p>
                     
                    <button class="text-btn">Bid Now <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-6 col-md-12">
              <a href="detail.html">
                <div class="card-product live-procut">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-6.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Current Bid: <span> $1400.00</span></p>
                     <p>Upcoming :  <span class="text-dark"> 01 Oct 2023     <span class="ms-2 text-dark">10:00 AM </span></span></p>
                    <button class="text-btn">Bid Now <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-6 col-md-12">
              <a href="detail.html">
                <div class="card-product live-procut">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-4.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Current Bid: <span> $1400.00</span></p>
                     <p>Upcoming :  <span class="text-dark"> 01 Oct 2023     <span class="ms-2 text-dark">10:00 AM </span></span></p>
                    <button class="text-btn">Bid Now <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
            
            
            <div class="col-lg-6 col-md-12">
              <a href="detail.html">
                <div class="card-product live-procut">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-3.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Current Bid: <span> $1400.00</span></p>
                     <p>Upcoming :  <span class="text-dark"> 01 Oct 2023     <span class="ms-2 text-dark">10:00 AM </span></span></p>
                    <button class="text-btn">Bid Now <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>


      <div class="row mt-5">
        <div class="col-lg-3 col-md-12">
          <div class="auction-type light-clr timed-prct align-just">
           <div> 
            <h2>Timed</h2>
            <p>1200 Product</p>
            <a href="product-list.html" class="border-white-btn">VIEW ALL ITEMS</a>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-12">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <a href="private-product.html">
                <div class="card-product live-procut">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-5.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Starting bid: <span> $1400.00</span></p>
                    <div class="countdown-time" id="countdown">
                      <ul>
                        <li><span id="days"></span>days</li>
                        <li><span id="hours"></span>Hours</li>
                        <li><span id="minutes"></span>Minutes</li>
                        <li><span id="seconds"></span>Seconds</li>
                      </ul>
                    </div>
                    <button class="text-btn">View Product <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-6 col-md-12">
              <a href="private-product.html">
                <div class="card-product live-procut">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-6.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Starting bid: <span> $1400.00</span></p>
                    <div class="countdown-time" id="countdown">
                      <ul>
                        <li><span id="days"></span>days</li>
                        <li><span id="hours"></span>Hours</li>
                        <li><span id="minutes"></span>Minutes</li>
                        <li><span id="seconds"></span>Seconds</li>
                      </ul>
                    </div>
                    <button class="text-btn">View Product <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-6 col-md-12">
              <a href="private-product.html">
                <div class="card-product live-procut">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-4.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Starting bid: <span> $1400.00</span></p>
                    <div class="countdown-time" id="countdown1">
                      <ul>
                        <li><span id="days1"></span>days</li>
                        <li><span id="hours1"></span>Hours</li>
                        <li><span id="minutes1"></span>Minutes</li>
                        <li><span id="seconds1"></span>Seconds</li>
                      </ul>
                    </div>
                    <button class="text-btn">View Product <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
            
            
            <div class="col-lg-6 col-md-12">
              <a href="private-product.html">
                <div class="card-product live-procut">
                  <div class="product-image">
                    <img src="{{asset('frontend/images/product-img-3.png')}}" alt="">
                    <i class="fa fa-heart-o"></i>
                  </div>
                  <div class="card-product-dtl">
                    <h3>luxurious golden jewelry  </h3>
                    <h5>$1200.00</h5>
                    <p>Starting bid: <span> $1400.00</span></p>
                    <div class="countdown-time" id="countdown">
                      <ul>
                        <li><span id="days"></span>days</li>
                        <li><span id="hours"></span>Hours</li>
                        <li><span id="minutes"></span>Minutes</li>
                        <li><span id="seconds"></span>Seconds</li>
                      </ul>
                    </div>
                    <button class="text-btn">View Product <img class="img-fluid ms-2" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="most-view-product">
    <div class="container">
      <div class="section-heading">
        <h2>Most Views</h2>
        <p>Immerse yourself in the world of luxury fashion with our meticulously crafted designer clothes!</p>
      </div>
      <div class="row">
        <div class="col-md-4 col-6">
          <div class="card-most-product">
            <div class="img-card">
              <img src="{{asset('frontend/images/pr-1.png')}}" alt="">
              <i class="fa fa-heart-o"></i>
            </div>
            <span>$9000.00</span>
            <h3>Important Jewels</h3>
            <p>Toundra Togo Birkin 25 Palladium Hardware...</p>
            <span class="curnt-bid-man">Current Bid $10,000.00</span>
            <a href="" class="next-btn-img"><img src="{{asset('frontend/images/next-btn.svg')}}" alt=""></a>
          </div>
        </div>
        <div class="col-md-4 col-6">
          <div class="card-most-product">
            <div class="img-card">
              <img src="{{asset('frontend/images/pr-2.png')}}" alt="">
              <i class="fa fa-heart-o"></i>
            </div>
            <span>$9000.00</span>
            <h3>Important Jewels</h3>
            <p>Toundra Togo Birkin 25 Palladium Hardware...</p>
            <span class="curnt-bid-man">Current Bid $10,000.00</span>
            <a href="" class="next-btn-img"><img src="{{asset('frontend/images/next-btn.svg')}}" alt=""></a>
          </div>
        </div>
        <div class="col-md-4 col-6">
          <div class="card-most-product">
            <div class="img-card">
              <img src="{{asset('frontend/images/pr-3.png')}}" alt="">
              <i class="fa fa-heart-o"></i>
            </div>
            <span>$9000.00</span>
            <h3>Important Jewels</h3>
            <p>Toundra Togo Birkin 25 Palladium Hardware...</p>
            <span class="curnt-bid-man">Current Bid $10,000.00</span>
            <a href="" class="next-btn-img"><img src="{{asset('frontend/images/next-btn.svg')}}" alt=""></a>
          </div>
        </div>
        <div class="col-md-4 col-6">
          <div class="card-most-product">
            <div class="img-card">
              <img src="{{asset('frontend/images/pr-3.png')}}" alt="">
              <i class="fa fa-heart-o"></i>
            </div>
            <span>$9000.00</span>
            <h3>Important Jewels</h3>
            <p>Toundra Togo Birkin 25 Palladium Hardware...</p>
            <span class="curnt-bid-man">Current Bid $10,000.00</span>
            <a href="" class="next-btn-img"><img src="{{asset('frontend/images/next-btn.svg')}}" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </section>



  <section class="most-bid">
    <div class="container">
      <div class="section-heading text-center">
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
              <h3>Mini 3D Glass</h3>
              <p>$2,400 <span>71 bids</span></p>
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
              <h3>Mini 3D Glass</h3>
              <p>$2,400 <span>71 bids</span></p>
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
              <h3>Kotion Headset</h3>
              <p>$2,400 <span>71 bids</span></p>
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
              <h3>Bluetooth Gamepad</h3>
              <p>$2,400 <span>71 bids</span></p>
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
              <h3>Mini 3D Glass</h3>
              <p>$2,400 <span>71 bids</span></p>
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
              <h3>Kotion Headset</h3>
              <p>$2,400 <span>71 bids</span></p>
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
              <h3>Apple iPhone 6s</h3>
              <p>$2,400 <span>71 bids</span></p>
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
              <h3>Moving Camera</h3>
              <p>$2,400 <span>71 bids</span></p>
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
              <h3>Kotion Headset</h3>
              <p>$2,400 <span>71 bids</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="contact-us">
    <div class="container">
      <div class="outer-box">
        <div class="section-heading text-center">
          <span>Contact Us</span>
        <h2>Get In Touch</h2>
        <p>We’d love to hear from you! us know how we can help.</p>
        </div>
        <div class="row align-items-center">
          <div class="col-md-8">
            <form action="" class="contact-frm">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" placeholder="Your Name">
                    <img class="lft-icon-ipt" src="{{asset('frontend/images/user.svg')}}" alt="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Your Email ID">
                    <img class="lft-icon-ipt" src="{{asset('frontend/images/email.svg')}}" alt="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Your Phone Number">
                    <img class="lft-icon-ipt" src="{{asset('frontend/images/phone.svg')}}" alt="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea name="" id="" cols="30" rows="10" placeholder="Type Your Message"></textarea>
                    <img class="lft-icon-ipt" src="{{asset('frontend/images/msg.svg')}}" alt="">
                  </div>
                </div>
                <div class="text-center">
                  <button class="rounded-pill btn btn-secondary">Send Message</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-4">
            <div class="contact-img">
              <img class="img-fluid" src="{{asset('frontend/images/contact.png')}}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    <section class="feedback-counter">
      <div class="container">
        <div class="section-heading text-center">
          <h2>Feedback Corner</h2>
        </div>
        <div class="testimonial">
          <div class="container">
           <div class="testimonial__inner">
             <div class="testimonial-slider">
               <div class="testimonial-slide">
                 <div class="testimonial_box">
                   <div class="testimonial_box-inner">
                     <div class="testimonial_box-top">
                       <div class="testimonial_box-icon">
                         <i class="fa fa-quote-right"></i>
                       </div>
                       <div class="testimonial_box-name">
                        <h4>Sarah Thompson</h4>
                     </div>
                       <div class="testimonial_box-text">
                         <p>The customer experience was exceptional from start to finish. The website is user-friendly, the checkout process was smooth, and the clothes I ordered fit perfectly. I'm beyond satisfied!</p>
                       </div>
                       
                     
                    
                     </div>
                   </div>
                 </div>
               </div>
               <div class="testimonial-slide">
                <div class="testimonial_box">
                  <div class="testimonial_box-inner">
                    <div class="testimonial_box-top">
                      <div class="testimonial_box-icon">
                        <i class="fa fa-quote-right"></i>
                      </div>
                      <div class="testimonial_box-name">
                        <h4>Olivia Martinez</h4>
                     </div>
                      <div class="testimonial_box-text">
                        <p>The customer experience was exceptional from start to finish. The website is user-friendly, the checkout process was smooth, and the clothes I ordered fit perfectly. I'm beyond satisfied!</p>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="testimonial-slide">
                <div class="testimonial_box">
                  <div class="testimonial_box-inner">
                    <div class="testimonial_box-top">
                      <div class="testimonial_box-icon">
                        <i class="fa fa-quote-right"></i>
                      </div>
                      <div class="testimonial_box-name">
                        <h4>Emily Wilson</h4>
                     </div>
                      <div class="testimonial_box-text">
                        <p>The customer experience was exceptional from start to finish. The website is user-friendly, the checkout process was smooth, and the clothes I ordered fit perfectly. I'm beyond satisfied!</p>
                      </div>
                       
                    </div>
                  </div>
                </div>
              </div>
              <div class="testimonial-slide">
                <div class="testimonial_box">
                  <div class="testimonial_box-inner">
                    <div class="testimonial_box-top">
                      <div class="testimonial_box-icon">
                        <i class="fa fa-quote-right"></i>
                      </div>
                      <div class="testimonial_box-name">
                        <h4>John Doe</h4>
                     </div>
                      <div class="testimonial_box-text">
                        <p>The customer experience was exceptional from start to finish. The website is user-friendly, the checkout process was smooth, and the clothes I ordered fit perfectly. I'm beyond satisfied!</p>
                      </div>
                      
                     
                    </div>
                  </div>
                </div>
              </div>
             </div>
           </div>
          </div>
        </div>
        <div class="btn-wrap-slider text-center">
          <button class="prev-btn"><img src="{{asset('frontend/images/slide-arrow.svg')}}" alt=""></button>
          <button class="next-btn"><img src="{{asset('frontend/images/slide-arrow.svg')}}" alt=""></button>
        </div>
      </div>
    </section>
 
    @include('frontend.layouts.footer')
