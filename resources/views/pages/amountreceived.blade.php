@extends('welcome')
@section('content')
<section class="main">
    <div class="middle-dashboard">
        <div class="topic-heading" style="display: inline-flex;">
            <div class="topic-icons">
                <i class="ri-money-dollar-box-line"></i>
            </div>
            <h1> Amount Received </h1>
        </div>
        <div class="table-heading">
            <table>
                <tr>
                    <th>S.N</th>
                    <th>Payer Name</th>

                    <th>Cash or Credit (Received Medium )</th>
                    <th>Total Amount:</th>
                    <th>Receipt</th>

                </tr>
                <tr>
                    <td><input type="text" placeholder="S.N"></td>
                    <td><input type="text" placeholder="Enter Name  of Payer"></td>

                    <td>
                        <div class="combo-box-wrapper">
                            <div class="combo-box-btn">
                                <span>Cash/Credit</span>
                                <i class="uil uil-angle-down"></i>
                            </div>
                            <div class="combo-content">
                                <div class="search" style="display: none;">
                                    <i class="uil uil-search"></i>
                                    <input spellcheck="false" type="text" placeholder="Search">
                                </div>
                                <ul class="options-combo" style="padding-left: 0px;"></ul>
                            </div>
                        </div>
                    </td>
                    <td><input type="text" placeholder="Enter Total Amount"></td>
                    <td><input type="file"></td>
                </tr>


            </table>
            <div class="submit">
                <input type="submit" value="Submit">
            </div>
        </div>

        <div class="table-heading">
            <table>
                <tr>
                    <th>S.N</th>
                    <th>Party Name</th>
                    <th>Received Medium</th>
                    <th>Total Amount</th>
                    <th>Receipt Image</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Pawan Sigdel</td>
                    <td>Cash</td>
                    <td>40,000</td>
                    <td>
                        <div class="recepit-img">
                            <a target="_blank" href="./resources/images/bank-receipt.png"> <img
                                    src="./resources/images/bank-receipt.png" alt=""></a>
                        </div>
                    </td>
                    <td><button class="edit-button">Edit <i class="ri-pencil-line"></i> </button> <button
                            class="del-button">Del <i class="ri-chat-delete-line"></i> </button></td>

                </tr>
                <tr>
                    <td>2.</td>
                    <td>Pawan Sigdel</td>
                    <td>Credit</td>
                    <td>40,000</td>
                    <td>
                        <div class="recepit-img">
                            <a target="_blank" href="./resources/images/cash-recipt.png"> <img
                                    src="./resources/images/cash-recipt.png" alt=""></a>
                        </div>
                    </td>

                    <td><button class="edit-button">Edit <i class="ri-pencil-line"></i> </button> <button
                            class="del-button">Del <i class="ri-chat-delete-line"></i> </button></td>

                </tr>
                <tr>
                    <td>3.</td>
                    <td>Pawan Sigdel</td>
                    <td>Cash</td>
                    <td>40,000</td>
                    <td>
                        <div class="recepit-img">
                            <a target="_blank" href="./resources/images/bank-receipt.png"> <img
                                    src="./resources/images/bank-receipt.png" alt=""></a>
                        </div>
                    </td>

                    <td><button class="edit-button">Edit <i class="ri-pencil-line"></i> </button> <button
                            class="del-button">Del <i class="ri-chat-delete-line"></i> </button></td>

                </tr>
                <tr>
                    <td>4.</td>
                    <td>Pawan Sigdel</td>
                    <td>Credit</td>
                    <td>40,000</td>
                    <td>
                        <div class="recepit-img">
                            <a target="_blank" href="./resources/images/cash-recipt.png"> <img
                                    src="./resources/images/cash-recipt.png" alt=""></a>
                        </div>
                    </td>

                    <td><button class="edit-button">Edit <i class="ri-pencil-line"></i> </button> <button
                            class="del-button">Del <i class="ri-chat-delete-line"></i> </button></td>

                </tr>
                <tr>
                    <td>5.</td>
                    <td>Pawan Sigdel</td>
                    <td>Cash</td>
                    <td>40,000</td>
                    <td>
                        <div class="recepit-img">
                            <a target="_blank" href="./resources/images/bank-receipt.png"> <img
                                    src="./resources/images/bank-receipt.png" alt=""></a>
                        </div>
                    </td>

                    <td><button class="edit-button">Edit <i class="ri-pencil-line"></i> </button> <button
                            class="del-button">Del <i class="ri-chat-delete-line"></i> </button></td>

                </tr>
            </table>
            <div class="viewmore">
                <input type="submit" value="View More">

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



const wrapper = document.querySelector(".combo-box-wrapper"),
    selectBtn = wrapper.querySelector(".combo-box-btn"),
    searchInp = wrapper.querySelector("input"),
    options = wrapper.querySelector(".options-combo");

let rooms = ["Cash ", "Credit", ];

function addCountry(selectedCountry) {
    options.innerHTML = "";
    rooms.forEach(country => {
        let isSelected = country == selectedCountry ? "selected" : "";
        let li = `<li onclick="updateName(this)" class="${isSelected}">${country}</li>`;
        options.insertAdjacentHTML("beforeend", li);
    });
}
addCountry();

function updateName(selectedLi) {
    searchInp.value = "";
    addCountry(selectedLi.innerText);
    wrapper.classList.remove("active");
    selectBtn.firstElementChild.innerText = selectedLi.innerText;
}

searchInp.addEventListener("keyup", () => {
    let arr = [];
    let searchWord = searchInp.value.toLowerCase();
    arr = rooms.filter(data => {
        return data.toLowerCase().startsWith(searchWord);
    }).map(data => {
        let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
        return `<li onclick="updateName(this)" class="${isSelected}">${data}</li>`;
    }).join("");
    options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! Country not found</p>`;
});

selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"));
</script>

@endsection