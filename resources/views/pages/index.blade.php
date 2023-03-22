@extends('welcome')
@section('content')

<section class="main">
    <div class="top-heading">
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-cloud-line"></i>
            </div>
            <h1> Over View</h1>
        </div>
      
        <div class="headings">
            <div class="dash-board-container">
                <h3>Costumers or Users</h3>
                <div class="dashboard-value">
                    <p>146,000</p>
                    <div class="icon-dash">
                        <i class="ri-dashboard-line"></i>
                    </div>

                </div>
                <div class="dash-info">
                    <p>Since last week <i class="ri-arrow-right-up-fill"> <span>12%</span></i> </p>
                </div>
            </div>
            <div class="dash-board-container">
                <h3>Costumers or Users</h3>
                <div class="dashboard-value">
                    <p>146,000</p>
                    <div class="icon-dash">
                        <i class="ri-dashboard-line"></i>
                    </div>

                </div>
                <div class="dash-info">
                    <p>Since last week <i class="ri-arrow-right-up-fill"> <span>12%</span></i> </p>
                </div>
            </div>
            <div class="dash-board-container">
                <h3>Costumers or Users</h3>
                <div class="dashboard-value">
                    <p>146,000</p>
                    <div class="icon-dash">
                        <i class="ri-dashboard-line"></i>
                    </div>

                </div>
                <div class="dash-info">
                    <p>Since last week <i class="ri-arrow-right-up-fill"> <span>12%</span></i> </p>
                </div>
            </div>

        </div>
        <div class="headings">
            <div class="dash-board-container width-full">
                <h3>Recent work flow</h3>
                <div class="dash-board-img">
                    <img src="{{asset('accounting-software/resources/images/curve.png')}}" alt="">
                </div>
                <div class="dash-info">
                    <p>Since last week <i class="ri-arrow-right-up-fill"> <span>12%</span></i> </p>
                </div>
            </div>
            <div class="dash-board-container width-full">
                <h3>Recent Marketing</h3>
                <div class="dash-board-img">
                    <img src="{{asset('accounting-software/resources/images/bar-diagram.png')}}" alt="">
                </div>
                <div class="dash-info">
                    <p>Since last week <i class="ri-arrow-right-up-fill"> <span>12%</span></i> </p>
                </div>
            </div>

        </div>
    </div>
    <div class="middle-dashboard">
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-shield-user-line"></i>
            </div>
            <h1> Recent Activities</h1>
        </div>
        <div class="table-heading">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Type</th>
                </tr>
                <tr>
                    <td>Pawan Sigdel</td>
                    <td>Pawansigdel39@gmail.com</td>
                    <td>2022-01-01</td>
                    <td>Customer</td>
                </tr>
                <tr>
                    <td>Aanandha Dhital</td>
                    <td>aanandha39@gmail.com</td>
                    <td>2022-01-01</td>
                    <td>Service Provider</td>
                </tr>
                <tr>
                    <td>Sangam Giri</td>
                    <td>sangam39@gmail.com</td>
                    <td>2022-01-01</td>
                    <td>Service Provider</td>
                </tr>

            </table>
        </div>
    </div>
</section>


<script type="text/javascript">
$('.sub-btn').click(function() {
    $(this).next('.sub-menu').slideToggle();
    $(this).find('.dropdown').toggleClass('rotate');
});


$('.menu-btn').click(function() {
    $('.side-bar').addClass('active');
    $('.menu-btn').css("visibility", "hidden");

});

$('.close-btn').click(function() {
    $('.side-bar').removeClass('active');
    $('.menu-btn').css("visibility", "visible");
});
</script>
@endsection