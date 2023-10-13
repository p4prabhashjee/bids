@include('frontend.layouts.header')

<section class="hero-ther">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-6 text-center">
             <h1>Contact US</h1>
             <p>
              <a href="index.html"><i class="fa fa-home"></i> Home /</a> Contact Us
            </p>
             
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
                    <img class="lft-icon-ipt" src="./images/user.svg" alt="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Your Email ID">
                    <img class="lft-icon-ipt" src="./images/email.svg" alt="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Your Phone Number">
                    <img class="lft-icon-ipt" src="./images/phone.svg" alt="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea name="" id="" cols="30" rows="10" placeholder="Type Your Message"></textarea>
                    <img class="lft-icon-ipt" src="./images/msg.svg" alt="">
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
              <img class="img-fluid" src="./images/contact.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 
  @include('frontend.layouts.footer')
