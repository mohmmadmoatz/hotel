<div class="card">

    <style>
        .box {
            background-color: #f4f6f9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>

    <div class="card-header p-0">
        <h3 class="card-title">
            معلومات الغرفة
        </h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{
                        __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.bookednow.read')"
                        class="text-decoration-none">الاستقبال</a></li>
                <li class="breadcrumb-item active">معلومات الحجز</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <label>رقم الغرفة

                        @if (!$booked)

                        @if($room->status != "maintance")
                        <button wire:click.prevent="maintancemode()" class="btn btn-warning">
                            ترحيل الى الصيانة
                        </button>
                        @else
                        <button wire:click.prevent="exitmaintancemode()" class="btn btn-warning">
                            اخراج من الصيانة
                        </button>
                        @endif

                        @endif

                    </label>
                    <input readonly type="text" class="form-control" value="{{$room->name}}">
                </div>

                <div class="col-md-6 mt-3">
                    <label>سعر الغرفة</label>
                    <input readonly type="text" class="form-control" value="@money($room->price)">
                </div>

                @if($nearbook)
                <div class="col-md-12 mt-2">
                    <!-- alert -->
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>تنبيه!</strong> هناك حجز قادم لهذه الغرفة في تاريخ
                        {{$nearbook->book_date}} 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                </div>
                </div>
                @endif

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 box">

                    <h4>معلومات النزلاء</h4>
                </div>

                <div class="col-md-3" x-data="{}">

                    <label for="">الأسم الرباعي
                        <a wire:loading wire:target="name"><i class="fas fa-spinner fa-spin" ></i></a>
                    </label>
                    
                        <div>

                      
                        <input type="text"  wire:click="setDrop" class="form-control" wire:model="name">
                        @if($name && $modalOpen)
                            <div @click.away="Livewire.emit('closeModal')" class="bg-white position-absolute w-100 mt-2 rounded d-flex flex-column shadow" style="z-index: 10">
                                @foreach(App\Models\Customer::where("name","LIKE","%".$name . "%")->limit(10)->get() as $item)
                                    <div class="px-3 py-2 autocomplete-item"  wire:click.prevent="setname({{ $item->id }})">
                                        <a href="" class="py-2 ">{{ $item->name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    
                        </div>



                </div>

                <div class="col-md-3">
                    <label for="">اللقب</label>
                    <input type="text" class="form-control" wire:model.defer="lastname">
                </div>

                <div class="col-md-2">
                    <label for="">رقم الهاتف</label>
                    <input type="number" class="form-control" wire:model.defer="phone">
                </div>

                <div class="col-md-2">
                    <label for="">اسم الأم</label>
                    <input type="text" class="form-control" wire:model.defer="mother_name">
                </div>

                <div class="col-md-2">
                    <label for="">الجنسية</label>
                    <input type="text" class="form-control" wire:model.defer="nat">

                </div>

                <div class="col-md-2">
                    <label for="">المحافظة</label>
                    <input type="text" class="form-control" wire:model.defer="city">

                </div>

                <div class="col-md-2">
                    <label for="">رقم الهوية او جواز السفر</label>
                    <input type="text" class="form-control" wire:model.defer="idf">
                </div>

                <div class="col-md-2">
                    <label for="">تاريخ الأصدار</label>
                    <input type="date" class="form-control" wire:model.defer="id_date">
                </div>

                <div class="col-md-2">
                    <label for="">المواليد</label>
                    <input type="date" class="form-control" wire:model.defer="borndate">
                </div>

                <div class="col-md-2">
                    <label for="">الجنس</label>
                    <select class="form-control" wire:model.defer="gender">
                        <option value=""></option>
                        <option>ذكر</option>
                        <option>انثى</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="">الصور
                    <a wire:loading wire:target="images"><i class="fas fa-spinner fa-spin" ></i></a>
                    </label>
                    <input type="file" class="form-control" wire:model.defer="images" multiple>
                </div>

                

                <div class="col-12 mt-2">                    
                    <button wire:loading.remove wire:target="images"  wire:click.prevent="addCustomer"  class="btn btn-info btn-block">اضافة</button>
                </div>

                <div class="col-12 mt-2">
                    @if($images)
                    <div class="row">
                        @foreach($images as $image)
                        <div class="col-md-3">
                            <img src="{{$image->temporaryUrl()}}" width="100" class="img-fluid">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>الأسم الرباعي</th>
                            <th>اللقب</th>
                            <th>رقم الهاتف</th>
                            <th>اسم الأم</th>

                            <th>الجنسية</th>
                            <th>رقم الهوية او جواز السفر</th>
                            <th>تاريخ الأصدار</th>
                            <th>المواليد</th>
                            <th>الجنس</th>

                            <th></th>
                        </tr>
                        @foreach(collect($guests) as $guest)
                        <tr>
                            <td>{{$guest['name']}}</td>
                            <td>{{$guest['lastname']}}</td>
                            <td>{{$guest['phone']}}</td>
                            <td>{{$guest['mother_name']}}</td>
                            <td>{{$guest['nat']}}</td>
                            <td>{{$guest['idf']}}</td>
                            <td>{{$guest['id_date']}}</td>
                            <td>{{$guest['borndate']}}</td>
                            <td>{{$guest['gender']}}</td>
                            <td>
                                <button wire:click.prevent="removeCustomer({{$loop->index}})"
                                    class="btn btn-danger btn-block">-</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    

                    @if($booked)
                    <a href="@route('amn')?booking_id={{$booked->booking_id}}" target="_blank" class="btn btn-warning mb-2">طباعة امن وطني</a>
                    @endif
                  

                </div>

                <div class="col-md-4">
                    <label for="">السكن</label>
                    <input name="address" type="text" class="form-control" wire:model.defer="address">
                </div>

                <div class="col-md-4">
                    <label for="">سبب الزيارة</label>
                    <input name="reason" type="text" class="form-control" wire:model.defer="reason">
                </div>

                <div class="col-md-4">
                    <label for="">ملاحظات</label>
                    <input type="text" class="form-control" wire:model.defer="notes">
                </div>

                <div class="col-12 mt-2">

                </div>


                <div class="col-md-3">
                    <label for="">نوع السيارة</label>
                    <input name="car" type="text" class="form-control" wire:model.defer="car">
                </div>

                <div class="col-md-3">
                    <label for="">رقم السيارة</label>
                    <input type="text" class="form-control" wire:model.defer="carNO">
                </div>

                <div class="col-md-3">
                    <label for="">المحافظة</label>
                    <input name="carstate" type="text" class="form-control" wire:model.defer="car_state">
                </div>

                <div class="col-md-3">
                    <label for="">لون السيارة</label>
                    <input name="carcolor" type="text" class="form-control" wire:model.defer="car_color">
                </div>



                <div class="col-md-12 mt-2 box">
                    <h4>معلومات الحجز</h4>
                </div>

                <div class="col-md-3">
                    <label for="">تاريخ الدخول</label>
                    <input type="date" class="form-control" wire:model.lazy="checkin_date">
                </div>

                <div class="col-md-3">
                    <label for="">الوقت</label>
                    <input type="time" class="form-control" wire:model.defer="checkin_time">
                </div>

                <div class="col-md-3">
                    <label for="">تاريخ الخروج</label>
                    <input type="date" class="form-control" wire:model.lazy="checkout_date">
                </div>

                <div class="col-md-3">
                    <label for="">عدد الأيام</label>
                    <input type="text" readonly class="form-control" wire:model="days">
                </div>

                <div class="col-12 mt-2">

                </div>

                
                <div class="col-md-12 box mt-2">
                    <h4>الخدمات</h4>
                </div>


                <div class="col-md-3">
                    <label for="">الخدمة</label>
                    
                    
                    <select class="form-control" wire:model.lazy="service">
                        <option value="">اختر الخدمة</option>
                        @foreach(App\Models\Service::get() as $service)
                        <option value="{{$service->name}}">{{$service->name}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="col-md-3">
                    <label for="">السعر</label>
                    <input type="text" class="form-control" wire:model.lazy="service_price">
                </div>

                <div class="col-md-3">
                    <label for="">الكمية</label>
                    <input type="text" class="form-control" wire:model.lazy="service_quantity">
                </div>

                <div class="col-md-3">
                    <label for="">&nbsp;</label>
                    <button wire:click.prevent="addService" class="btn btn-info btn-block">اضافة</button>
                </div>

                <div class="col-md-12" x-data="{serviceModal:false}">
                    <hr>

                    
                        <h4>اجمالي الخدمات :
                            @money($total_services)
                           
                        </h4>
                    
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>الخدمة</th>
                                <th>السعر</th>
                                <th>الكمية</th>
                                <th>الاجمالي</th>
                                <th></th>
                            </tr>
                            @foreach(collect($services) as $service)
                            <tr>
                                <td>{{$service['service']}}</td>
                                <td>{{$service['service_price']}}</td>
                                <td>{{$service['service_quantity']}}</td>
                                <td>
                                    @money($service['service_price'] * $service['service_quantity'])
                                </td>
                                <td>
                                    <button wire:click.prevent="removeService({{$loop->index}})"
                                        class="btn btn-danger btn-block">-</button>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                   



                </div>

                <div class="col-md-12 box mt-2">
                    <h4>الحساب والدفعات
                        
                    </h4>
                </div>

                <!-- Each day Account -->






                <div class="col-md-5">

                    <table class="table table-bordered">
                        <tr>
                            <th>المدفوع</th>

                            <th>التاريخ</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <input x-data x-mask:dynamic="$money($input, '.', ',', 4)"  type="text" class="form-control" wire:model.lazy="new_paid">
                            </td>

                            <td>
                                <input type="date" class="form-control" wire:model.lazy="new_pay_date">
                            </td>
                            <td>
                                <button wire:click.prevent="addPaid" class="btn btn-info btn-block">
                                    <span wire:loading.remove wire:target="addPaid">+</span>
                                    <a wire:loading wire:target="addPaid"><i class="fas fa-spinner fa-spin" ></i></a>
                                </button>

                            </td>
                        </tr>
                        @foreach(collect($payments) as $item)
                        <tr>
                            <td>{{$item['paid']}}</td>

                            <td>{{$item['pay_date']}}</td>
                            <td>
                                <button wire:click.prevent="removePaid({{$loop->index}})"
                                    class="btn btn-danger btn-block">
                                    <span wire:loading.remove wire:target="removePaid">-</span>
                                    <a wire:loading wire:target="removePaid"><i class="fas fa-spinner fa-spin" ></i></a>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>

                <div class="col-md-7">

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
                                <input type="text" class="form-control" wire:model.lazy="discount">
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
            <button type="submit" class="btn btn-info ml-4">حفظ البيانات</button>


            @if($booked)

            @if($finalPrice ==0)
            <a href="#checkout" wire:click="checkout" class="btn btn-danger ">
                Checkout - تسجيل الخروج
            </a>
            @endif

            @endif

            <a href="@route(getRouteName().'.bookednow.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>