@extends('welcome')
@section('content')

<?php
$accountgroup = DB::select("SELECT DISTINCT groups, accounthead from accountgroup;");

$accountsubgroup = DB::select("SELECT DISTINCT groups, subgroups, accounthead from accountsubgroup;");

?>

<section class="main">
    <div class="middle-dashboard">
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Ledger <small></small></h1>
            @if(session('message'))
            <div class="sweetmessage">
               
                <p>{{ session('message') }}</p>
            </div>
            @endif

            
        </div>
          <!-- Update form -->
        @if(isset($mainAccount))
       
        <form action="{{ url('/mainAccountUpdateData',$mainAccount->sn) }}" method="POST">
            @csrf

            <div class="table-heading">
                <table>
                    <tr>
                        <th>Type</th>
                        <th>Account Name</th>
                        <th>Address</th>
                        <th>Contact</th>
                    </tr>
                    <tr>

                        <td>
                            <input type="text" placeholder="Select Group" onkeyup="searchGroup();" id="groups"
                                value="{{$mainAccount->groups}}" name="groups" onclick="clearFields()">
                            <input type="hidden" placeholder="Select Accounthead" id="accounthead"
                                value="{{$mainAccount->accounthead}}" name="accounthead">
                            <input type="hidden" placeholder="Select SubGroup" id="subgroups"
                                value="{{$mainAccount->subgroups}}" name="subgroups">
                            @if(!empty($accountgroup))
                            <ul id="groupUL">
                                @foreach($accountgroup as $item)
                                <li onclick="updateGroup('{{$item->accounthead}}','{{$item->groups}}','');">
                                    <a href="javascript:void">{{$item->groups}}</a>
                                </li>
                                @endforeach
                                @foreach($accountsubgroup as $item)
                                <li
                                    onclick="updateGroup('{{$item->accounthead}}','{{$item->subgroups}}','{{$item->groups}}');">
                                    <a href="javascript:void">{{$item->subgroups}}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </td>

                        </td>
                        <td><input type="text" name="acname" required value="{{$mainAccount->acname}}"></td>
                        <td><input type="text" name="address" required value="{{$mainAccount->address}}"></td>
                        <td><input type="number" name="phoneno" required value="{{$mainAccount->phoneno}}"></td>
                    </tr>
                </table>
                <div class="submit">

                    <button type="submit" class="submit" value="Update">Update</button>

                </div>
            </div>
        </form>
        @else
        <!--Add new Submit form -->
        <form action="{{ url('/mainAccountStoreData') }}" method="POST">
            @csrf
            <div class="table-heading">
                <table>
                    <tr>
                        <th>Type</th>
                        <th>Account Name</th>
                        <th>Address</th>
                        <th>Contact</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" placeholder="Select Group" onkeyup="searchGroup();" id="groups"
                                name="groups" required>
                            <input type="hidden" placeholder="Select Accounthead" id="accounthead" name="accounthead">
                            <input type="hidden" placeholder="Select SubGroup" id="subgroups" name="subgroups">
                            @if(!empty($accountgroup))
                            <ul id="groupUL">
                                @foreach($accountgroup as $item)
                                <li onclick="updateGroup('{{$item->accounthead}}','{{$item->groups}}','');">
                                    <a href="javascript:void">{{$item->groups}}</a>
                                </li>
                                @endforeach
                                @foreach($accountsubgroup as $item)
                                <li
                                    onclick="updateGroup('{{$item->accounthead}}','{{$item->subgroups}}','{{$item->groups}}');">
                                    <a href="javascript:void">{{$item->subgroups}}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </td>
                        <td><input type="text" name="acname" placeholder="Enter Name" required></td>
                        <td><input type="text" name="address" placeholder="Address" required></td>
                        <td><input type="number" name="phoneno" placeholder="Contact" required></td>
                    </tr>
                </table>
                <div class="submit">
                    <button type="submit" class="submit" value="Submit">Submit</button>
                </div>
            </div>
        </form>
        @endif


        <div class="table-heading">

            <div class="search-form">
                <form method="GET" action="{{ url('/ledger') }}">
                    @csrf

                    <input type="text" id="acname" name="acname" placeholder="Search account name"
                        value="{{ request('acname') }}" required>
                    <button type="submit">Search</button>
                </form>
            </div>
            

            <table>


                <tr>
                    <th>S.N</th>
                    <th> Account Name</th>

                    <th>Type</th>
                    <th>Address</th>
                    <th>Contact</th>

                    <th>Action</th>
                </tr>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->sn }}</td>
                    <td>{{ $item->acname }}</td>
                    <td>{{ $item->groups }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->phoneno }}</td>

                    <th>
                        <a href="{{url('ledger/'.$item->sn)}}"><button class="edit-button">Edit <i
                                    class="ri-pencil-line"></i> </button></a>
                        <a href="#"><button class="del-button"
                                onclick="confirmDelete('{{ url('/delete-mainaccountdata/'.$item->sn) }}')">Del <i
                                    class="ri-chat-delete-line"></i></button></a>
                    </th>
                </tr>
                @endforeach
            </table>

            <div class="pagination pagination-buttons">
                {!! $data->links() !!}
            </div>

        </div>

    </div>
</section>
<div id="myModal1" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Do you want to delete it?</h2>
        </div>
        <div class="modal-body">
            <div class="cancle-div cancle-log">
                <button id="cancel-button">Cancel</button>
            </div>
            <div class="log-out-div">
                <a href="{{url('delete-mainaccountdata/'.$item->sn)}}">
                    <button id="logout-button">Delete</button>
                </a>
            </div>
        </div>
    </div>
</div>

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

function confirmDelete(url) {
    if (confirm("Are you sure you want to delete this item?")) {
        window.location.href = url;
    }
}



function searchGroup() {
    document.getElementById("groupUL").style.display = "block";
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("groups");
    filter = input.value.toUpperCase();
    ul = document.getElementById("groupUL");
    li = ul.getElementsByTagName("li");

    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;

        
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
           
            ul.insertBefore(li[i], ul.firstChild);
           
            li[i].style.display = "";
        } else {
            
            li[i].style.display = "none";
        }
    }
}

function updateGroup(accounthead, groups, subgroups) {

    document.getElementById("subgroups").value = subgroups;
    document.getElementById("groups").value = groups;
    document.getElementById("accounthead").value = accounthead;
    document.getElementById("groupUL").style.display = "none";
}

function clearFields() {
    const groupsInput = document.getElementById('groups');
    const accountheadInput = document.getElementById('accounthead');
    const subgroupsInput = document.getElementById('subgroups');

    if (groupsInput.value !== '' || accountheadInput.value !== '' || subgroupsInput.value !== '') {
        if (confirm("Are you sure you want to clear this  item?")) {
            groupsInput.value = '';
            accountheadInput.value = '';
            subgroupsInput.value = '';
        }
    } else {

    }
}

</script>




@endsection