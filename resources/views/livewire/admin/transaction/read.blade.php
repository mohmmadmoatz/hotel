<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header p-0">
                <h3 class="card-title">{{ __('ListTitle', ['name' => __(\Illuminate\Support\Str::plural('Transaction'))
                    ]) }}</h3>

                <div class="px-2 mt-4">

                    <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                        <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')"
                                class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __(\Illuminate\Support\Str::plural('Transaction')) }}</li>
                    </ul>

                    <div class="row justify-content-between mt-4 mb-4">
                        @if(getCrudConfig('Transaction')->create && hasPermission(getRouteName().'.transaction.create',
                        0, 0))
                        <div class="col-md-4 right-0">
                            <a href="@route(getRouteName().'.transaction.create')" class="btn btn-success">{{
                                __('CreateTitle', ['name' => __('Transaction') ]) }}</a>
                        </div>
                        @endif
                        @if(getCrudConfig('Transaction')->searchable())
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" @if(config('easy_panel.lazy_mode'))
                                    wire:model.lazy="search" @else wire:model="search" @endif
                                    placeholder="{{ __('Search') }}" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-default">
                                        <a wire:target="search" wire:loading.remove><i class="fa fa-search"></i></a>
                                        <a wire:loading wire:target="search"><i class="fas fa-spinner fa-spin"></i></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-4">
                            <div class="input-group">
                                <select class="form-control" wire:model="user_id">
                                    <option value="">فلترة حسب المستخدم</option>
                                    @foreach(App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach

                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-default">
                                        <a wire:target="user_id" wire:loading.remove><i class="fa fa-user"></i></a>
                                        <a wire:loading wire:target="user_id"><i class="fas fa-spinner fa-spin"></i></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                      
                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="col-12">
                            <table class="table table-striped">
                                <tr>
                                    <th>اجمالي القبض</th>
                                    <th>اجمالي الصرف</th>
                                    <th>الصافي</th>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="badge badge-success" style="font-size: 25px;">
                                            @money($totalAdd)
                                        </span>



                                    </td>
                                    <td>
                                        <span class="badge badge-danger" style="font-size: 25px;">
                                            @money($totalSub)
                                        </span>

                                    </td>
                                    <td>

                                        <span class="badge badge-info" style="font-size: 25px;">
                                            @money($totalAdd - $totalSub)
                                        </span>




                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="col-md-4">
                            <input type="date" name="from_date" class="form-control" wire:model.defer="from_date">
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="to_date" class="form-control" wire:model.defer="to_date">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-block" wire:click="makeReport">طباعة الكشف</button>
                        </div>


                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col" style='cursor: pointer' wire:click="sort('details')"> <i
                                    class='fa @if($sortType == ' desc' and $sortColumn=='details' ) fa-sort-amount-down
                                    ml-2 @elseif($sortType=='asc' and $sortColumn=='details' ) fa-sort-amount-up ml-2
                                    @endif'></i> {{ __('Details') }} </th>
                            <th>المستخدم</th>
                            <th scope="col" style='cursor: pointer' wire:click="sort('type')"> <i
                                    class='fa @if($sortType == ' desc' and $sortColumn=='type' ) fa-sort-amount-down
                                    ml-2 @elseif($sortType=='asc' and $sortColumn=='type' ) fa-sort-amount-up ml-2
                                    @endif'></i> {{ __('Type') }} </th>
                            <th scope="col" style='cursor: pointer' wire:click="sort('amount')"> <i
                                    class='fa @if($sortType == ' desc' and $sortColumn=='amount' ) fa-sort-amount-down
                                    ml-2 @elseif($sortType=='asc' and $sortColumn=='amount' ) fa-sort-amount-up ml-2
                                    @endif'></i> {{ __('Amount') }} </th>
                            <th scope="col" style='cursor: pointer' wire:click="sort('date')"> <i
                                    class='fa @if($sortType == ' desc' and $sortColumn=='date' ) fa-sort-amount-down
                                    ml-2 @elseif($sortType=='asc' and $sortColumn=='date' ) fa-sort-amount-up ml-2
                                    @endif'></i> {{ __('Date') }} </th>
                            <th scope="col" style='cursor: pointer' wire:click="sort('booking_id')"> <i
                                    class='fa @if($sortType == ' desc' and $sortColumn=='booking_id' )
                                    fa-sort-amount-down ml-2 @elseif($sortType=='asc' and $sortColumn=='booking_id' )
                                    fa-sort-amount-up ml-2 @endif'></i> {{ __('Booking_id') }} </th>

                            @if(getCrudConfig('Transaction')->delete or getCrudConfig('Transaction')->update)
                            <th scope="col">{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr x-data="{ modalIsOpen : false }">
                            <td>
                                
                                <input @if(!$transaction->booking_id) disabled @endif  type="checkbox" wire:model="selected" value="{{ $transaction->id }}">
                            </td>
                            <td class="">{{ $transaction->details }}</td>
                            <td class="">{{ $transaction->user->name ??"" }}</td>
                            <td class="">
                                @if($transaction->type == 'add')
                                <span class="badge badge-success">{{ __('قبض') }}</span>
                                @else
                                <span class="badge badge-danger">{{ __('صرف') }}</span>
                                @endif
                            </td>
                            <td class="">@money($transaction->amount) </td>
                            <td class="">{{ $transaction->date }}</td>

                            <td>
                                @if($transaction->booking_id)
                                <a href="@route(getRouteName().'.booking.update', $transaction->booking_id)"
                                    class="btn text-primary mt-1">
                                    <i class="icon-eye"></i>
                                </a>
                                @endif

                            </td>


                            @if(getCrudConfig('Transaction')->delete or getCrudConfig('Transaction')->update)
                            <td>


                                @if($transaction->expense_id)
                                <i class="fa fa-ban" data-toggle="tooltip" data-placement="top"
                                    title="لايمكن تعديل هذه الفقرة "></i>
                                @else

                                @if(getCrudConfig('Transaction')->update &&
                                hasPermission(getRouteName().'.transaction.update', 0, 0, $transaction))
                                <a href="@route(getRouteName().'.transaction.update', $transaction->id)"
                                    class="btn text-primary mt-1">
                                    <i class="icon-pencil"></i>
                                </a>
                                @endif

                                @if(getCrudConfig('Transaction')->delete &&
                                hasPermission(getRouteName().'.transaction.delete', 0, 0, $transaction))
                                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                                    <i class="icon-trash"></i>
                                </button>
                                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false">
                                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Transaction')
                                            ]) }}</h5>
                                        <p>{{ __('DeleteMessage', ['name' => __('Transaction') ]) }}</p>
                                        <div class="mt-5 d-flex justify-content-between">
                                            <a wire:click.prevent="delete" class="text-white btn btn-success shadow">{{
                                                __('Yes, Delete it.') }}</a>
                                            <a @click.prevent="modalIsOpen = false"
                                                class="text-white btn btn-danger shadow">{{ __('No, Cancel it.') }}</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endif


                            </td>
                            @endif
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="m-auto pt-3 pr-3">
                {{ $transactions->appends(request()->query())->links() }}
            </div>

            <div wire:loading wire:target="nextPage,gotoPage,previousPage" class="loader-page"></div>

        </div>
    </div>
</div>