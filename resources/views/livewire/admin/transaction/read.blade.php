<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header p-0">
                <h3 class="card-title">{{ __('ListTitle', ['name' => __(\Illuminate\Support\Str::plural('Transaction')) ]) }}</h3>

                <div class="px-2 mt-4">

                    <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                        <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __(\Illuminate\Support\Str::plural('Transaction')) }}</li>
                    </ul>

                    <div class="row justify-content-between mt-4 mb-4">
                        @if(getCrudConfig('Transaction')->create && hasPermission(getRouteName().'.transaction.create', 0, 0))
                        <div class="col-md-4 right-0">
                            <a href="@route(getRouteName().'.transaction.create')" class="btn btn-success">{{ __('CreateTitle', ['name' => __('Transaction') ]) }}</a>
                        </div>
                        @endif
                        @if(getCrudConfig('Transaction')->searchable())
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" @if(config('easy_panel.lazy_mode')) wire:model.lazy="search" @else wire:model="search" @endif placeholder="{{ __('Search') }}" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-default">
                                        <a wire:target="search" wire:loading.remove><i class="fa fa-search"></i></a>
                                        <a wire:loading wire:target="search"><i class="fas fa-spinner fa-spin" ></i></a>
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
                                        <a wire:loading wire:target="user_id"><i class="fas fa-spinner fa-spin" ></i></a>
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


                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style='cursor: pointer' wire:click="sort('details')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'details') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'details') fa-sort-amount-up ml-2 @endif'></i> {{ __('Details') }} </th>
                            <th>المستخدم</th>
                            <th scope="col" style='cursor: pointer' wire:click="sort('type')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'type') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'type') fa-sort-amount-up ml-2 @endif'></i> {{ __('Type') }} </th>
                            <th scope="col" style='cursor: pointer' wire:click="sort('amount')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'amount') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'amount') fa-sort-amount-up ml-2 @endif'></i> {{ __('Amount') }} </th>
                            <th scope="col" style='cursor: pointer' wire:click="sort('date')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'date') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'date') fa-sort-amount-up ml-2 @endif'></i> {{ __('Date') }} </th>
                            <th scope="col" style='cursor: pointer' wire:click="sort('booking_id')"> <i class='fa @if($sortType == 'desc' and $sortColumn == 'booking_id') fa-sort-amount-down ml-2 @elseif($sortType == 'asc' and $sortColumn == 'booking_id') fa-sort-amount-up ml-2 @endif'></i> {{ __('Booking_id') }} </th>
                            
                            @if(getCrudConfig('Transaction')->delete or getCrudConfig('Transaction')->update)
                                <th scope="col">{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            @livewire('admin.transaction.single', [$transaction], key($transaction->id))
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
