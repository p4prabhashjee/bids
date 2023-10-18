@include('frontend.layouts.header')

<style type="text/css">
/*----------------------*/
.base-timer {
    position: relative;
    width: 190px;
    height: 190px;
    margin: 30px auto 0;
}

.base-timer__svg {
    transform: scaleX(-1);
}

.base-timer__circle {
    fill: none;
    stroke: none;
}

.base-timer__path-elapsed {
    stroke-width: 6px;
    stroke: #efefef;
}

.base-timer__path-remaining {
    stroke-width: 4px;
    stroke-linecap: round;
    transform: rotate(90deg);
    transform-origin: center;
    transition: 1s linear all;
    fill-rule: nonzero;
    stroke: currentColor;
}

.base-timer__path-remaining.green {
    color: #39b37d;
}

.base-timer__path-remaining.orange {
    color: orange;
}

.base-timer__path-remaining.red {
    color: red;
}

.base-timer__label {
    position: absolute;
    width: 190px;
    height: 190px;
    top: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    font-weight: 600;
    letter-spacing: 0.3px;
}

.timer-countdn {
    position: relative;
    border-radius: 20px;
}

.timer-countdn .close {
    position: absolute;
    right: 10px;
    top: 0px;
    background: transparent;
    border: 0;
    padding: 0;
    font-size: 35px;
}

.timer-countdn h4 {
    font-size: 30px;
    color: #000;
}
</style>
<section class="hero-ther">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 text-center">
                <h1>Auction Details</h1>
                <p>
                    <a href="index.html"><i class="fa fa-home"></i> Home /</a> Auction
                    Details
                </p>

            </div>
        </div>
    </div>
</section>

<section class="detail-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <div class="bid-and-time">
                    <h4>Current Bid <span>$20,0379.00</span></h4>
                    <div class="countdown-time" id="countdown">
                        <ul>
                            <li><span id="days"></span>D</li>
                            <li>:</li>
                            <li><span id="hours"></span>H</li>
                            <li>:</li>

                            <li><span id="minutes"></span>M</li>
                            <li>:</li>
                            <li><span id="seconds"></span>S</li>
                        </ul>
                    </div>
                </div>
                <div class="product-imgs mt-4">
                    <i class="fa fa-heart-o"></i>
                    <div class="img-display">
                        <div class="img-showcase">
                            @if ($product->galleries->isNotEmpty())
                            @foreach ($product->galleries as $gallery)
                            <img src="{{ asset($gallery->image_path) }}" alt="shoe image">
                            @endforeach
                            @else
                            <img src="{{ asset('frontend/images/default-product-image.svg') }}" alt="shoe image" />
                            @endif
                        </div>

                    </div>
                    <div class="img-select">
                        @if ($product->galleries->isNotEmpty())
                        @foreach ($product->galleries as $gallery)
                        <div class="img-item">
                            <a href="#" data-id="{{ $loop->index + 1 }}">
                                <img src="{{ asset($gallery->image_path) }}" alt="shoe image" />
                            </a>
                        </div>
                        @endforeach
                        @else
                        <div class="img-item">
                            <a href="#" data-id="1">
                                <img src="{{ asset('frontend/images/default-product-image.svg') }}" alt="shoe image" />
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="product-desc">
                    <h4>Description</h4>
                    <p>
                    {{ strip_tags($product->description) }}
                    </p>
                   
                </div>
                <div class="product-feature-box">
                    <h4>Share Now <img src="{{asset('frontend/images/line.svg')}}" alt="" /></h4>
                    <ul class="social-link mt-4">
                        <li>
                            <a href=""><img src="{{asset('frontend/images/youtube.svg')}}" alt=""></a>
                        </li>
                        <li>
                            <a href=""><img src="{{asset('frontend/images/twitter.svg')}}" alt=""></a>
                        </li>
                        <li>
                            <a href=""><img src="{{asset('frontend/images/facebook.svg')}}" alt=""></a>
                        </li>
                        <li>
                            <a href=""><img src="{{asset('frontend/images/instagram.svg')}}" alt=""></a>
                        </li>
                        <li>
                            <a href=""><img src="{{asset('frontend/images/linkdin.png')}}" alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <h3>{{$product->title}}</h3>
                <!-- <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas
                    in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a
                    consectetur nulla. Nulla posuere sapien vitae lectus suscipit
                </p> -->
                <span class="product-status">PRODUCT: RUNNING</span>
                <div class="product-feature-box">
                    <h4>PRODUCT OVERVIEW <img src="{{asset('frontend/images/line.svg')}}" alt="" /></h4>
                    <ul class="feature-prdt">
                    @if ($product->specifications->isNotEmpty())
                    @foreach ($product->specifications as $specification)
                          <li>{{ $specification->name }} <span>{{ $specification->value }}</span></li>
                    @endforeach
                    @else
                       <div><p>OverView Not Updated.</p></div>
                    @endif
                    </ul>
                </div>
                <div class="product-feature-box">
                    <h4>BID NOW <img src="{{asset('frontend/images/line.svg')}}" alt="" /></h4>
                    <p>Bid Amount : Minimum Bid 20.00$</p>
                    <form action="" class="news-letter">
                        <div class="form-group">
                            <input type="email" name="" id="" placeholder="$00.00">
                            <button>Request Bid</button>
                        </div>
                    </form>
                    <!-- <span class="no-enteres">No. of Entries: 2/5</span> -->
                </div>

            </div>
        </div>
    </div>
</section>
<div id="alert-modal" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body timer-countdn text-center py-5" id="base-timer-path-background">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class=" text-center">
                    <h4>Live Auction</h4>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="revese-timer" data-minute="1"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="{{asset('frontend/js/bootstrap.js')}}"></script>
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js')}}"></script>
<script>
const imgs = document.querySelectorAll(".img-select a");
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener("click", (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage() {
    const displayWidth = document.querySelector(
        ".img-showcase img:first-child"
    ).clientWidth;

    document.querySelector(".img-showcase").style.transform = `translateX(${-(imgId - 1) * displayWidth
        }px)`;
}

window.addEventListener("resize", slideImage);


$(document).ready(function() {
    $('#alert-modal').modal('show');
});



// --------Reveser-timer-----------
if ($('#revese-timer').length) {

    const FULL_DASH_ARRAY = 283;
    const WARNING_THRESHOLD = 15;
    const ALERT_THRESHOLD = 10;

    const COLOR_CODES = {
        info: {
            color: "green"
        },
        warning: {
            color: "orange",
            threshold: WARNING_THRESHOLD
        },
        alert: {
            color: "red",
            threshold: ALERT_THRESHOLD
        }
    };


    var Minute = $('#revese-timer').data('minute');
    var Seconds = Math.round(60 * Minute);
    const TIME_LIMIT = Seconds;
    let timePassed = 0;
    let timeLeft = TIME_LIMIT;
    let timerInterval = null;
    let remainingPathColor = COLOR_CODES.info.color;

    document.getElementById("revese-timer").innerHTML = `
        <div class="base-timer">
          <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <g class="base-timer__circle">
              <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
              <path
                id="base-timer-path-remaining"
                stroke-dasharray="283"
                class="base-timer__path-remaining ${remainingPathColor}"
                d="
                  M 50, 50
                  m -45, 0
                  a 45,45 0 1,0 90,0
                  a 45,45 0 1,0 -90,0
                "
              ></path>
            </g>
          </svg>
          <span id="base-timer-label" class="base-timer__label">${formatTime(
        timeLeft
      )}</span>
        </div>
        `;

    startTimer();

    function onTimesUp() {
        clearInterval(timerInterval);
    }

    function startTimer() {
        timerInterval = setInterval(() => {
            timePassed = timePassed += 1;
            timeLeft = TIME_LIMIT - timePassed;
            document.getElementById("base-timer-label").innerHTML = formatTime(
                timeLeft
            );
            setCircleDasharray();
            setRemainingPathColor(timeLeft);

            if (timeLeft === 0) {
                onTimesUp();
            }
        }, 1000);
    }

    function formatTime(time) {
        const minutes = Math.floor(time / 60);
        let seconds = time % 60;

        if (seconds < 10) {
            seconds = `0${seconds}`;
        }

        return `${minutes}:${seconds}`;
    }

    function setRemainingPathColor(timeLeft) {
        const {
            alert,
            warning,
            info
        } = COLOR_CODES;
        if (timeLeft <= alert.threshold) {
            document
                .getElementById("base-timer-path-remaining")
                .classList.remove(warning.color);
            document
                .getElementById("base-timer-path-remaining")
                .classList.add(alert.color);

            var element = document.getElementById("base-timer-path-background")
            element.style.backgroundColor = ('#FFD9D9');
        } else if (timeLeft <= warning.threshold) {
            document
                .getElementById("base-timer-path-remaining")
                .classList.remove(info.color);
            document
                .getElementById("base-timer-path-remaining")
                .classList.add(warning.color);

            var element = document.getElementById("base-timer-path-background")
            element.style.backgroundColor = ('#FFECDF');
        }
    }

    function calculateTimeFraction() {
        const rawTimeFraction = timeLeft / TIME_LIMIT;
        return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
    }

    function setCircleDasharray() {
        const circleDasharray = `${(
          calculateTimeFraction() * FULL_DASH_ARRAY
        ).toFixed(0)} 283`;
        document
            .getElementById("base-timer-path-remaining")
            .setAttribute("stroke-dasharray", circleDasharray);
    }

}
</script>
@include('frontend.layouts.footer')