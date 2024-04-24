@component('admin::layouts.app')
  

     
<div class="card-group">
<div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">
                                        @money(App\Models\Booking::count())
                                        </h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">الحجوزات الكلية</h6>
                                </div>
                                <div class="mr-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class ="fa fa-users fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">
                                        @money(App\Models\Room::count())
                                        </h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">عدد الغرف</h6>
                                </div>
                                <div class="mr-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class ="fa fa-file fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">
                                        @money(App\Models\Bookednow::count())
                                        </h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">عدد الغرف الشاغرة</h6>
                                </div>
                                <div class="mr-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class ="fa fa-times fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

</div>

@if(auth()->user()->role == 'admin' || auth()->user()->role == 'استقبال')
<div class="col-md-12">
    <h4>حجوزات مسبقة قريبا   </h4>
<hr>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table text-dark table-bordered">
            <tr>
                <th>رقم الغرفة</th>
                <th>الاسم</th>
                <th>تاريخ الحجز</th>
                <th>التفاصيل</th>
                
            </tr>
            @php
            $fiveDaysafter = Carbon\Carbon::now()->addDays(5);
            

            @endphp
            @foreach(App\Models\Prebook::where('book_date','<' ,$fiveDaysafter)->where("book_date",">=",Carbon\Carbon::now())->get() as $item)
            <tr>
                <td>{{$item->room->name}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->book_date}}</td>
                <td>{{$item->details}}</td>
              
            </tr>
            @endforeach
        </table>
    </div>
</div>

</div>
@endif

<h4>الحجوزات الحالية</h4>
<hr>

<div class="row">
    <div class="col-md-7">
    <div class="card">
    <div class="card-body table-responsive">
        <table class="table text-dark table-bordered">
            <tr>
                <th>رقم الغرفة</th>
                <th>الاسم</th>
                <th>تاريخ الدخول</th>
                <th>تاريخ الخروج</th>
                <th>المبلغ</th>
            </tr>
            @foreach(App\Models\Booking::where('status',"booked")->get() as $bookednow)
            <tr>
                <td>{{$bookednow->room->name??""}}</td>
                <td>{{$bookednow->guests()->first()->name??""}}</td>
                <td>{{$bookednow->checkin_date}}</td>
                <td>{{$bookednow->checkout_date}}</td>
                <td>@money($bookednow->netPrice)</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

    </div>

  

    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'استقبال')
    <div class="col-md-5">
        <div class="row">
            <div class="col-6">
            <div class="card">
                <a href="@route('admin.bookednow.read')" class="card-body btn-info">

                    <h4>
                        <i class="fa fa-home"></i>
                        الاستقبال
                    </h4>
                </a>

            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <a href="@route('admin.booking.read')" class="card-body btn-warning">
                    <h4>
                        <i class="fa fa-history"></i>
                        الحجوزات السابقة
                    </h4>
                </a>

            </div>
        </div>

        <div class="col-6">
            <div class="card">


                <a href="@route('admin.customer.read')" class="card-body btn-danger">
                    <h4>
                        <i class="fa fa-users"></i>
                        بيانات العملاء
                    </h4>
                </a>


            </div>
        </div>
        @endif

        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'محاسب')
        
        <div class="col-6">
            <div class="card">
                <a  href="@route('admin.transaction.read')" class="card-body btn-success">
                    <h4>
                        <i class="fa fa-box"></i>
                        القاصة
                    </h4>
                </a>

            </div>
        </div>
        @endif

    </div>

</div>





    
@endcomponent
