@extends('welcome')
@section('content')

<section class="main">
    <div class="middle-dashboard">
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Sales and Income <small>(Cash Sales)</small></h1>
            @if(session('message'))
            <div class="sweetmessage">

                <p>{{ session('message') }}</p>
            </div>
            @endif
        </div>
        @if(isset($cashonSales))
        <form action="{{ url('/salesonPurchaseCashUpdate',$cashonSales->id) }}" method="POST">
            @csrf
            <div class="table-heading">
                <table>
                    <tr>
                        <th>S.N</th>
                        <th>Party Name</th>
                        <th>Particulars</th>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="S.N"  value="{{ $cashonSales->id }}"readonly></td>
                        <td>
                            <input type="hidden" name="accno" value="{{ $cashonSales->accno }}" placeholder="Enter Name"
                                required>
                            <input type="text" id="partyName" onkeyup="searchPartyName()" placeholder="Enter Name"
                                value="{{ $cashonSales->acname }}" required>
                            <div class="dropdown-content" id="partyname_data"></div>
                        </td>
                        <td><input type="text"  name="particulars" placeholder="Particulars"
                                value="{{$cashonSales->particulars}}" required></td>
                    </tr>
                </table>
            </div>
            <div class="table-heading">
                <table>
                    <tr>
                        <th>Amount</th>
                        <th>Taxable</th>
                        <th>VAT</th>
                    </tr>
                    <tr>
                        <td><input type="number" name="amount" placeholder="Enter Amount"
                                value="{{$cashonSales->amount}}" required></td>
                        <td><input type="number" name="taxable_amount" placeholder="Enter Tax Amount"
                                value="{{$cashonSales->taxable_amount}}" required></td>
                        <td><input type="number" name="vat_amount" placeholder="Enter VAT Amount"
                                value="{{$cashonSales->vat_amount}}" required></td>
                    </tr>
                </table>
                <div class="submit">
                    <input type="submit" value="Update">
                </div>
            </div>
        </form>

        @else
        <form action="{{ url('/cashOnSalesStoreData') }}" method="POST">
            @csrf
            <div class="table-heading">
                <table>
                    <tr>
                        <th>S.N</th>
                        <th>Party Name</th>

                        <th>Particulars</th>

                    </tr>
                    <tr>
                        <td><input type="text" placeholder="S.N" readonly></td>

                        <td>
                            <input type="hidden" id="sn" name="accno" placeholder="Enter Name" required>
                            <input type="text" id="partyName" onkeyup="searchPartyName()" placeholder="Enter Name"
                                required>
                            <div class="dropdown-content" id="partyname_data">

                            </div>
                        </td>



                        <td><input type="text" name="particulars" placeholder="Particulars" required></td>

                    </tr>


                </table>
            </div>
            <div class="table-heading">
                <table>

                    <tr>
                        <th>Amount</th>
                        <th>Taxable</th>
                        <th>VAT</th>


                    </tr>
                    <tr>
                        <td><input type="number" name="amount" placeholder="Enter Amount" required></td>
                        <td><input type="number" name="taxable_amount" placeholder="Enter Tax Amount" required></td>
                        <td><input type="number" name="vat_amount" placeholder="Enter VAT Amount" required></td>

                    </tr>
                </table>
                <div class="submit">
                    <input type="submit" value="Submit">
                </div>
            </div>
        </form>
        @endif

        <div class="table-heading">
            <div class="search-form">
                <form method="GET" action="{{ url('/salesoncash') }}">
                    @csrf

                    <input type="text" id="acname" name="acname" placeholder="Search acname"
                        value="{{ request('acname') }}" required>
                    <button type="submit">Search</button>
                </form>
            </div>

            <table>
                <tr>
                    <th>S.N</th>
                    <th>Party Name</th>

                    <th>Particulars</th>
                    <th>Amount</th>
                    <th>Taxable</th>
                    <th>VAT</th>
                    <th>Action</th>
                </tr>
                @foreach($list as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->acname }}</td>
                    <td>{{ $item->particulars }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->taxable_amount }}</td>
                    <td>{{ $item->vat_amount }}</td>
                    

                    <td><a href="{{url('salesoncash/'.$item->id)}}"><button class="edit-button">Edit <i
                                    class="ri-pencil-line"></i> </button></a>
                        </button> <button class="del-button"
                            onclick="confirmDelete('{{ url('/deletecashonSales/'.$item->id) }}')">Del <i
                                class="ri-chat-delete-line"></i> </button></td>
                    </td>
                </tr>
                @endforeach

            </table>
            <div class="pagination pagination-buttons">
                {!! $list->links() !!}
            </div>

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


function searchPartyName() {
    var partyName = document.getElementById('partyName').value;
    // setTimeout(function() {

    // }, 500);

    if (partyName != '') {
        axajUrl = "/searchPartyName/" + partyName;
        $.ajax({
            type: "GET",
            url: axajUrl,
            async: false,
            success: function(dataResult) {
                $("#partyname_data").empty();
                response = dataResult;
                console.log(dataResult);
                var dataResult = JSON.parse(dataResult);
                document.getElementById('partyname_data').style.display = 'block';
                var r = 1;
                for (var i = 0; i < dataResult.length; i++) {

                    var str = "<a href='#' onclick='putItemIntoTextField(" + dataResult[i]
                        .sn + ",\"" + dataResult[i].acname + "\");'>" + dataResult[i].acname + "</a>";

                    $("#partyname_data").append(str);

                    r++;
                }


            }
        });


    } else {
        document.getElementById('partyname_data').style.display = 'none';
    }


}

function putItemIntoTextField(sn, acname) {
    $("#sn").val(sn);
    $("#partyName").val(acname);
    document.getElementById('partyname_data').style.display = 'none';
}

function confirmDelete(url) {
    if (confirm("Are you sure you want to delete this item?")) {
        window.location.href = url;
    }
}
</script>
@endsection