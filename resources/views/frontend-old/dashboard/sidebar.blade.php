<div class="col-md-3">
    <div class="profile-sidebar">
        <div class="profile-side">
            <div class="img-prfe">
                <img src="{{asset('frontend/images/dummyuser.png')}}" alt="">
            </div>
            <h2>{{Auth::user()->first_name}}</h2>
            <a href="">{{Auth::user()->email}}</a>
        </div>
        <div class="account-menu">
            <h5>Menu Profile <button class="menu-show-mn" type="button"><img style="width: 30px;"
                        src="{{asset('frontend/images/menu.svg')}}" alt=""></button></h5>
                        
            <ul class="menu-ul">
                <li><a href="{{route('userdashboard')}}">My Account</a></li>
                <li><a href="#">My Orders</a></li>
                <li><a href="{{route('useraddress')}}">Manage Address </a></li>
                <li><a href="#">Payment Settings</a></li>
                <li><a href="#">Auctions</a></li>
                <li><a href="{{route('logout')}}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>