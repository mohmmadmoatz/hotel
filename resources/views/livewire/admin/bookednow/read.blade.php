<div class="row">
    
    <style>
        .av{
            background-color: #2c3e50;
            color: #fff;
        }
        .fil{
            background-color: green;
            color: #fff;
        }
        .fil:hover{
            background-color: #3498db;
            color: #fff;
        }
        .av:hover{
            background-color: #34495e;
            color: #fff;
        }
        .maintain{
            background-color: #d35400;
            color: #fff;
        }
    </style>

    <div class="col-12">
        <div class="card">
            <div class="card-header p-0">
                <h3 class="card-title">
                    الاستقبال
                </h3>

                
            </div>

            

            <div class="card-body">
                
                    <div class="row">

                       

                        <div class="col-md-3 p-2">
                            <label for="">عدد الغرف المسكونة</label>
                            <input type="text" class="form-control" readonly value="{{$count}}">
                        </div>

                        <div class="col-md-3 p-2">
                            <label for="">عدد الغرف الجاهزة</label>
                            <input type="text" class="form-control" readonly value="{{App\Models\Room::count() -  $count}}">
                        </div>

                        <div class="col-md-3 p-2">
                            <label for="">عدد النزلاء</label>
                            <input type="text" class="form-control" readonly value="{{$customers}}">
                        </div>

                        
                     

                        @if(auth()->user()->role == "admin" || auth()->user()->role == "محاسب")


                        <div class="col-md-3 p-2">
                            <label for="">اجمالي المبلغ</label>
                            <input type="text" class="form-control" readonly value="@money($totalToday)">
                        </div>
                        @endif

                        <div class="col-md-4">
                            <h4 style="background: #2c3e50;color:#fff;padding: 5px;text-align: center;">الغرفة جاهزة</h4>
                        </div>
                        <div class="col-md-4">
                            <h4 style="background: green;color:#fff;padding: 5px;text-align: center;">الغرفة مسكونة</h4>
                        </div>
                        <div class="col-md-4">
                            <h4 style="background: #d35400;color:#fff;padding: 5px;text-align: center;">الغرفة تحت الصيانة</h4>
                        </div>
                  
                    <div class="col-md-12">
                        <hr>
                    </div>

                 
                  
                    @foreach($rooms as $room)
                    @php
                        $booked = App\Models\Bookednow::where('room_id',$room->id)->first();
                    
                    @endphp
                    <div class="col-md-2 mt-2">
                       
                            <a href="@route(getRouteName().'.'.'bookednow'.'.create')?room_id={{$room->id}}" class="btn @if($booked) fil @else 
                            @if($room->status == 'maintance') maintain @else av @endif
                            
                            @endif btn-block">
                                <h1>{{$room->name}}</h1>
                                <hr>
                                <h6>{{$room->room_type}}</h6>
                            </a>
                     
                    </div>
                    @endforeach
                  
                </div>

            </div>



    </div>
</div>
