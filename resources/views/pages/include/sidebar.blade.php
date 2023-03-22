<?php
if (session()->get('sessionAdminUserId') != "") {
    $user = \DB::table('admin_users')
        ->select('id','name')
        ->where('password', session()->get('sessionAdminUserId'))
        ->get();
    $id = $user[0]->id;
    $count = \DB::select("select count('id')  from admin_users where id='" . $id . "'");
}
?>
<div class="menu-height">
    <div class="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
</div>


<div class="side-bar">

    <header>

        <div class="close-btn">

            <i class="fas fa-times"></i>
        </div>
        @if(session()->get('sessionAdminUserId') != "")
        <div class="logo-images">
            <img src="{{asset('accounting-software/resources/images/day-khata.png')}}">
        </div>
        <div class="welcome-user"
            style="color: white; margin-top: 40px; padding-top: 10px;padding-bottom: 10px; padding-left: 30px; font-weight: bolder; border-bottom: 1px solid white; border-top: 1px solid white; position: relative;">
            <p> Welcome {{@$user[0]->name}}! <i class="ri-logout-box-r-line" id="open-modal"
                    style="font-size: 20px; position: absolute; right: 20px; cursor :pointer;"></i> </p>
        </div>
        @else
        <?php
        // Redirect to the login page
        header('Location: /');
        exit();
        ?>
        @endif
    </header>
    <div class="menu">
        <div class="item"><a href="#"><i class="fas fa-desktop"></i>Home</a></div>
        <div class="item">
            <a class="sub-btn"><i class="fas fa-table"></i>Sales and Income<i
                    class="fas fa-angle-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="/salesoncash" class="sub-item">Cash Sales</a>
                <a href="/salesoncredit" class="sub-item">Credit Sales</a>

            </div>
        </div>
        <div class="item">
            <a class="sub-btn"><i class="fas fa-table"></i>Purchase/Expenses<i
                    class="fas fa-angle-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="/purchaseoncash" class="sub-item">Cash Purchase</a>
                <a href="/purchaseoncredit" class="sub-item">Credit Purchase</a>

            </div>
        </div>
        <div class="item"><a href="/profitandloss"><i class="fas fa-table"></i>Profit/Loss</a></div>
        <div class="item">
            <a class="sub-btn"><i class="fas fa-cogs"></i>Day Book<i class="fas fa-angle-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="" class="sub-item">Cash Sales</a>
                <a href="#" class="sub-item">Cash Expenses</a>
                <a href="#" class="sub-item">Credit Sales</a>
                <a href="#" class="sub-item">Credit Expenses</a>

            </div>
        </div>
        <div class="item">
            <a  href="/ledger"class="sub-btn"><i class="fas fa-table"></i>Ledger
                    </a>
            <!-- <div class="sub-menu">
                <a href="/salesoncash" class="sub-item">Cash Sales</a>
                <a href="/salesoncredit" class="sub-item">Credit Sales</a>

            </div> -->
        </div>
        <div class="item"><a href="#"><i class="fas fa-info-circle"></i>About</a></div>
    </div>
</div>

<div id="myModal" class="modal">


    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Do You Want To Log Out?</h2>
        </div>
        <div class="modal-body">
            <div class="cancle-div cancle-log">
                <button class="cancle-logout"> Cancel</button>
            </div>
            <div class="log-out-div">
                <a href="/logout-adminuser">
                    <button class="log-out">Log Out</button>
                </a>
            </div>

        </div>

    </div>

</div>
<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("open-modal");


var span = document.getElementsByClassName("close")[0];
var closelog = document.getElementsByClassName("cancle-log")[0];


btn.onclick = function() {
    modal.style.display = "block";
}


span.onclick = function() {
    modal.style.display = "none";
}

closelog.onclick = function() {
    modal.style.display = "none";

}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";

    }
}
</script>