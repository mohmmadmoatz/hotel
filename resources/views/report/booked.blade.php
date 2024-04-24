@php
$booking = \App\Models\Booking::where("status","booked")->get();

@endphp

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>طباعة أمن وطني</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">


  <style>

body{
  font-family: 'Tajawal', sans-serif;
}

@media print{@page {size: landscape}}

table{
  font-size:12px;
}

table th{
  padding-left:3px;
  padding-right:3px;
}


  </style>
</head>
<body>

              
                
                 
                          
                          <table width="60%" style="font-size: 20px;">
                            <tr>
                              <th>
                                <span style="font-weight: bold;">الأسماء والمعلومات لنزلاء الفندق : </span>
                                <span style="color:blue">البارون</span>
                              </th>
                              
                              <th>ليوم :</th>
                              <th>{{date("Y-m-d")}}</th>
                            </tr>
                          </table>

                          <hr>
                            
                            <table width="100%" border="1px">
                                <thead>

                                <tr>
                                  <th>ت</th>
                                    <th>الأسم الرباعي للنزيل</th>
                                    <th>اسم الأم</th>
                                    <th>الجنسية</th>
                                    <th>رقم الهوية او جواز السفر</th>
                                    <th>تاريخ الأصدار</th>
                                    <th>المحافظة</th>
                                    <th>المواليد</th>
                                    <th>الجنس</th>
                                    <th>الغرفة</th>
                                    <th>تاريخ الدخول</th>
                                    <th>تاريخ الخروج </th>
                                    <th>اسم الشركة </th>
                                    <th>رقم الموبايل </th>
                                    <th>الملاحظات</th>
                                </tr>
                              </thead>

                              <tbody>
                                @php
                                $i=0;
                                @endphp
                                @foreach($booking as $item)
                                @foreach($item->guests as $customer)
                                @php
                                $i++;
                                @endphp
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>{{$customer->name}}</td>
                                  <td>{{$customer->mother_name}}</td>
                                  <td>{{$customer->nat}}</td>
                                  <td>{{$customer->idf}}</td>
                                  <td>{{$customer->id_date}}</td>
                                  <td>{{$customer->city}}</td>
                                  <td>{{$customer->borndate}}</td>
                                  <td>{{$customer->gender}}</td>
                                  <td>{{$item->room->name ??""}}</td>
                                  <td>{{$item->checkin_date}}</td>
                                  <td>{{$item->checkout_date}} </td>
                                  <td> </td>
                                  <td>{{$item->phone}} </td>
                                  <td></td>
                                </tr>
                                @endforeach
                                @endforeach
                              </tbody>
                                
                            </table>

                            <hr>

                            <table width="100%" style="font-size:14px">
                              <tr>
                                <th> عراقين / </th>
                              </tr>
                              <tr>
                                <th> العرب / </th>
                                <th> توقيع امر المفرزة </th>
                                <th> توقيع صاحب الفندق </th>
                              </tr>
                              <tr>
                                <th> الأجانب / </th>
                              </tr>
                            </table>

                   
                        
                  
  
  
  <script>
    setTimeout(() => {
            window.print()
            window.exit();
    }, 100);
  </script>

</body>
</html>