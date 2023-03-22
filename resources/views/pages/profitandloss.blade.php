@extends('welcome')
@section('content')
<section class="main">
    <div class="middle-dashboard">
        <div class="topic-heading" style="display: inline-flex;">

            <h1> Profit & Loss Account For (Company Name)</h1>
        </div>

        <div class="table-heading">
            <table>
                <tr>
                    <th>S.N</th>


                    <th>Particulars</th>
                    <th>Note Node</th>
                    <th>Amount</th>

                    <th>Total Amount</th>
                </tr>
                <tr>
                    <td>1.</td>

                    <td>Sale Profit or Loss (previous day)</td>
                    <td>2</td>
                    <td>37,000</td>

                    <td>37,000</td>

                </tr>
                <tr>
                    <td>2.</td>

                    <td>Cost of goods sold (COGS)</td>
                    <td>2</td>
                    <td>37,000</td>

                    <td>37,000</td>

                </tr>
                <tr>
                    <td class="black"><b>3.</b></td>

                    <td class="black"><b>Gross Profit</b></td>
                    <td>-</td>
                    <td class="black"><b>37,000 + 37,000</b></td>

                    <td class="black"><b>74,000</b></td>

                </tr>

                <tr>
                    <td>4.</td>

                    <td>Sales Income (Cash & Credit)
                        <div class="compoents">
                            <ol>
                                <li>Sales of Furniture</li>
                                <li>Sales of Sofas</li>
                                <li>Sales of Sofas</li>
                                <li>Sales of Sofas</li>
                                <li>Sales of Sofas</li>
                            </ol>
                        </div>
                    </td>
                    <td>-</td>
                    <td>(All Sales Amounts)
                        <div class="amount-components">
                            <ul>
                                <li>2,000</li>
                                <li>3,000</li>
                                <li>5,000</li>
                                <li>6,000</li>
                                <li>7,000</li>
                            </ul>
                        </div>
                    </td>

                    <td>2,000 + 3,000 + 5,000 + 6,000 + 7,000
                        <div class="total-amount black">
                            <p><b>23,000</b></p>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>5.</td>

                    <td>Purchase (Cash & Credit)
                        <div class="compoents">
                            <ol>
                                <li>Purchase of Furniture</li>
                                <li>Purchase of Sofas</li>
                                <li>Purchase of Sofas</li>
                                <li>Purchase of Sofas</li>
                                <li>Purchase of Sofas</li>
                            </ol>
                        </div>
                    </td>
                    <td>-</td>
                    <td>(All Purchases Amounts)
                        <div class="amount-components">
                            <ul>
                                <li>(2,000)</li>
                                <li>(3,000)</li>
                                <li>(5,000)</li>
                                <li>(6,000)</li>
                                <li>(7,000)</li>
                            </ul>
                        </div>
                    </td>

                    <td>(2,000 + 3,000 + 5,000 + 6,000 + 7,000)
                        <div class="total-amount black">
                            <p><b>(23,000)</b></p>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>6.</td>

                    <td>Received (Cash & Bank)
                        <div class="compoents">
                            <ol>
                                <li>Received from Ganesh</li>
                                <li>Cash Received From Pawan</li>
                                <li>Cheque Received From Aananda</li>

                            </ol>
                        </div>
                    </td>
                    <td>-</td>
                    <td>(Amount Received From Cash & Bank)
                        <div class="amount-components">
                            <ul>
                                <li>2,000</li>
                                <li>3,000</li>
                                <li>5,000</li>

                            </ul>
                        </div>
                    </td>

                    <td>2,000 + 3,000 + 5,000
                        <div class="total-amount black">
                            <p><b>10,000</b></p>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>7.</td>

                    <td>Paid (Cash & Bank)
                        <div class="compoents">
                            <ol>
                                <li>Received from Ganesh</li>
                                <li>Cash Received From Pawan</li>
                                <li>Cheque Received From Aananda</li>

                            </ol>
                        </div>
                    </td>
                    <td>-</td>
                    <td>(Amount Paid From Cash & Bank)
                        <div class="amount-components">
                            <ul>
                                <li>(1,000)</li>
                                <li>(1,000)</li>
                                <li>(1,000)</li>

                            </ul>
                        </div>
                    </td>

                    <td>(1,000 + 1,000 + 1,000)
                        <div class="total-amount black">
                            <p><b>(3,000)</b></p>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>8.</td>

                    <td>Net Profit Before Tax

                    </td>
                    <td>-</td>
                    <td>
                        74,000 + 23,000 - 10,000 -3,000
                    </td>

                    <td>1,10,000

                    </td>

                </tr>
                <tr>
                    <td>9.</td>

                    <td>VAT

                    </td>
                    <td>-</td>
                    <td>
                        5,000
                    </td>

                    <td>5,000

                    </td>

                </tr>
                <tr>
                    <td>10.</td>

                    <td>Taxable AMount

                    </td>
                    <td>-</td>
                    <td>
                        5,000
                    </td>

                    <td>5,000

                    </td>

                </tr>
                <tr>
                    <td class="black">=</td>

                    <td class="black"><b>Net Profit After Tax</b>

                    </td>
                    <td>-</td>
                    <td class="black">
                        <b> 1,10,000 - 5,000 -5,000</b>
                    </td>

                    <td class="black"><b>1,00,000</b>

                    </td>

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