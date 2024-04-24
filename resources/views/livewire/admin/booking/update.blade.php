<div class="card">

<style>
        .box{
            background-color: #f4f6f9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>

    <div class="card-header p-0">
        <h3 class="card-title">بيانات الحجز</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.booking.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Booking')) }}</a></li>
                <li class="breadcrumb-item active">بيانات الحجز</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">

        <div class="card-body">


        <div class="row">
                <div class="col-md-6">
                    <label>رقم الغرفة</label>
                    <input readonly type="text" class="form-control" value="{{$room->name}}">
                </div>

                <div class="col-md-6">
                    <label>سعر الغرفة</label>
                    <input readonly type="text" class="form-control" value="@money($room->price)">
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 box">
                 
                    <h4>معلومات النزلاء</h4>
                </div>

                
                
                <div class="col-md-12">
                    <table class="table table-bordered">
                            <tr>
                                <th>الأسم الرباعي</th>
                                <th>اللقب</th>
                                <th>رقم الهاتف</th>
                                <th>اسم الأم</th>
                            </tr>
                            @foreach(collect($guests) as $guest)
                            <tr>
                                <td>{{$guest['name']}}</td>
                                <td>{{$guest['lastname']}}</td>
                                <td>{{$guest['phone']}}</td>
                                <td>{{$guest['mother_name']}}</td>
                            </tr>
                            @endforeach
                    </table>
                    
                </div>

                <div class="col-md-12 box">
                    <h4>معلومات الحجز</h4>
                </div>

                <div class="col-md-3">
                    <label for="">تاريخ الدخول</label>
                    <input readonly type="date" class="form-control" wire:model.lazy="checkin_date">
                </div>

                <div class="col-md-3">
                    <label for="">الوقت</label>
                    <input readonly type="time" class="form-control" wire:model.defer="checkin_time">
                </div>

                <div class="col-md-3">
                    <label for="">تاريخ الخروج</label>
                    <input readonly type="date" class="form-control" wire:model.lazy="checkout_date">
                </div>

                <div class="col-md-3">
                    <label for="">عدد الأيام</label>
                    <input readonly type="text" readonly class="form-control" wire:model = "days">
                </div>

                <div class="col-12 mt-2">
                    
                </div>

                <div class="col-md-4">
                    <label for="">السكن</label>
                    <input readonly name="address" type="text"  class="form-control" wire:model.defer="address">
                </div>

                <div class="col-md-4">
                    <label for="">سبب الزيارة</label>
                    <input readonly name="reason" type="text"  class="form-control" wire:model.defer="reason">
                </div>

                <div class="col-md-4">
                    <label for="">ملاحظات</label>
                    <input readonly type="text"  class="form-control" wire:model.defer="notes">
                </div>

                <div class="col-12 mt-2">

                </div>


                <div class="col-md-3">
                    <label for="">نوع السيارة</label>
                    <input readonly type="text" class="form-control" wire:model.defer="car">
                </div>

                <div class="col-md-3">
                    <label for="">رقم السيارة</label>
                    <input readonly type="text" class="form-control" wire:model.defer="carNO">
                </div>

                <div class="col-md-3">
                    <label for="">المحافظة</label>
                    <input readonly type="text" class="form-control" wire:model.defer="car_state">
                </div>

                <div class="col-md-3">
                    <label for="">لون السيارة</label>
                    <input readonly type="text"  class="form-control" wire:model.defer="car_color">
                </div>
                

                <div class="col-md-12 box mt-2">
                    <h4>الخدمات</h4>
                </div>

                
               
                <div class="col-md-12" x-data="{serviceModal:false}">
                  

                <a href="#services" @click.prevent="serviceModal=true">
                    <h4>اجمالي الخدمات : 
                        @money($total_services) 
                        (انقر لعرض الخدمات)
                    </h4>
                </a>
                <hr>

                <div x-show="serviceModal" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="serviceModal = false" >
                        <h5 class="pb-2 border-bottom">الخدمات</h5>

                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>الخدمة</th>
                                <th>السعر</th>
                                <th>الكمية</th>
                                <th>الاجمالي</th>
                         
                            </tr>
                            @foreach(collect($services) as $service)
                            <tr>
                                <td>{{$service['service']}}</td>
                                <td>{{$service['service_price']}}</td>
                                <td>{{$service['service_quantity']}}</td>
                                <td>
                                    @money($service['service_price'] * $service['service_quantity'])
                                </td>
                               
                            </tr>
                            @endforeach
                        </table>
                        
                        <div class="mt-5 d-flex justify-content-between">
                        
                            <a @click.prevent="serviceModal = false" class="text-white btn btn-danger shadow">الغاء</a>
                        </div>
                    </div>
                </div>



                </div>

                <div class="col-md-12 box mt-2">
                    <h4>الحساب والدفعات</h4>
                </div>

                <!-- Each day Account -->


                

                

                <div class="col-md-4">
                    
                        <table class="table table-bordered">
                            <tr>
                                <th>المدفوع</th>
                            
                                <th>التاريخ</th>
                         
                            </tr>
                            <tr>
                                <td>
                                    <input readonly type="text" class="form-control" wire:model.lazy="new_paid">
                                </td>
                               
                                <td>
                                    <input readonly type="date" class="form-control" wire:model.lazy="new_pay_date">
                                </td>
                               
                            </tr>
                            @foreach(collect($payments) as $item)
                            <tr>
                                <td>{{$item['paid']}}</td>

                                <td>{{$item['pay_date']}}</td>
                                
                            </tr>
                            @endforeach
                        </table>
                    
                </div>

                <div class="col-md-8">
                    
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>
                                اجمالي المبلغ
                            </th>
                            <th>
                                الخدمات
                            </th>

                           

                            <th>
                                صافي المبلغ
                            </th>

                            <th>
                                المدفوع
                            </th>

                            <th>الخصم</th>
                            <th>المتبقي</th>

                          

                        </tr>

                        <tr>
                            <td>@money($totalPrice)</td>
                            <td>@money($total_services)</td>
                            <td>@money($netPrice)</td>
                            <td>@money($paid)</td>
                            <td>
                                <input readonly type="text" class="form-control" wire:model.lazy="discount">
                            </td>
                            <td>
                                @money($finalPrice)
                            </td>
                        </tr>

                    </table>
                   
                </div>

                

              


            </div>

        </div>
            

        

        <div class="card-footer">
            
            <a href="@route(getRouteName().'.booking.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
