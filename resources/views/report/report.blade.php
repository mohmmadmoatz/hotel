@php

// get from session

$data = session()->get('sid'.$_GET['sid']);

$date1 = $data['from_date'] . " 00:00:00";
$date2 = $data['to_date'] . " 23:59:59";

$transids = $data['selected'];

$incomes = App\Models\Transaction::whereIn('id', $transids)->get();





@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>طباعة تذكرة</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alexandria&display=swap" rel="stylesheet">

  <style>

body{margin-top:20px;
background-color: #f7f7ff;
font-family: 'Alexandria', sans-serif;
}
#invoice {
    padding: 0px;
}

table{
    text-align: right;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px;
    font-family: 'Alexandria', sans-serif;
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #5D3EBC
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #5D3EBC
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #5D3EBC;
    background: #e7f2ff;
    padding: 10px;
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,
.invoice table th {
    padding: 15px;

    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #5D3EBC;
    font-size: 1.2em
}

.invoice table .qty,
.invoice table .total,
.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #5D3EBC
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #5D3EBC;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid rgba(0, 0, 0, 0);
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}

.invoice table tfoot tr:last-child td {
    color: #5D3EBC;
    font-size: 1.4em;
    border-top: 1px solid #5D3EBC
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

/* every odd td background color */

.invoice table tr:nth-child(odd) td {
    background-color: #f7f7ff;
}
.invoice table tr:nth-child(odd) th {
    background-color: #eee;
}



.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #5D3EBC;
    background: #e7f2ff;
    padding: 10px;
}

  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div id="invoice">
              
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a href="javascript:;">
    												<img src="/assets/img/logo.png" width="200" alt="">
												</a>
                                </div>
                                <div class="col company-details">
                                <h2 class="name">
                                       
								    فندق البارون
								
                                    </h2>
                                    <div> الموصل شارع الكورنيش قرب معاونية الأسمنت</div>
                                    <div>0775 588 8355</div>
                                    <div>0785 580 0088</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">تقرير الفندق</div>
                                    <h5 class="to">
                                        من تاريخ : {{$data['from_date']}}
                                        | الى تاريخ : {{$data['to_date']}}
                                    </h5>
                                    
                                    
                                    
                                </div>
                                <div class="col invoice-details">
                                    
                                    <div class="date"> تمت الطباعة في   : {{date("Y-m-d")}}</div>
                                    
                                </div>
                            </div>

                            <hr>

                            <h4 dir="rtl" class="text-right">الغرف</h4>

                            <table dir="rtl">
                                <tr>
                                        <th>ت</th>
                                        <th>الغرفة</th>
                                        <th>التاريخ</th>
                                        <th>المبلغ</th>
                                </tr>
                                @foreach($incomes as $income)
                                <tr>
                                    
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$income->booking->room->name}}</td>
                                    <td>{{$income->created_at->format("Y-m-d")}}</td>
                                    <td>@money($income->amount)</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">الاجمالي</td>
                                    <td>@money($incomes->sum("amount"))</td>
                                </tr>
                            </table>

                            <hr>

                            <h4 dir="rtl" class="text-right">واردات اخرى</h4>
                            @php
                            $total = 0;
                            @endphp
                            <table dir="rtl">
                                <tr>
                                        <th>ت</th>
                                        <th>القسم</th>
                                        <th>الاجمالي</th>
                                </tr>
                                @foreach(App\Models\Incomecat::all() as $cat)
                                @php
                                    $income = App\Models\Transaction::where('income_cat', $cat->id)->whereBetween('created_at', [$date1, $date2])->sum("amount");
                                    $total += $income;
                                @endphp
                                <tr>
                                    
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$cat->name}}</td>
                                    
                                    <td>@money($income)</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">الاجمالي</td>
                                    <td>@money($total)</td>
                                </tr>

                            </table>

                           
                            <h4 dir="rtl" class="text-right">المصاريف</h4>

                            @php
                            $total = 0;
                            @endphp
                            <table dir="rtl">
                                <tr>
                                        <th>ت</th>
                                        <th>القسم</th>
                                        <th>الاجمالي</th>
                                </tr>
                                @foreach(App\Models\Expensecategory::all() as $cat)
                                @php
                                    $expense = App\Models\Expense::where('category_id', $cat->id)->whereBetween('created_at', [$date1, $date2])->sum("amount");
                                    $total += $expense;
                                @endphp
                                <tr>
                                    
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$cat->name}}</td>
                                    
                                    <td>@money($expense)</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">الاجمالي</td>
                                    <td>@money($total)</td>
                                </tr>

                            </table>
                            
                            
                        </main>
                        
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    
                </div>
            </div>
        </div>
    </div>
  </div>
  
  <script>
    setTimeout(() => {
            window.print()
            window.exit();
    }, 100);
  </script>

</body>
</html>