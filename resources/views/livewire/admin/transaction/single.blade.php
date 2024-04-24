<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $transaction->details }}</td>
    <td class="">{{ $transaction->user->name ??"" }}</td>
    <td class="">
        @if($transaction->type == 'add')
            <span class="badge badge-success">{{ __('قبض') }}</span>
        @else
            <span class="badge badge-danger">{{ __('صرف') }}</span>
        @endif
    </td>
    <td class="">@money($transaction->amount)  </td>
    <td class="">{{ $transaction->date }}</td>
    
        <td>
             @if($transaction->booking_id)
                <a href="@route(getRouteName().'.booking.update', $transaction->booking_id)" class="btn text-primary mt-1">
                    <i class="icon-eye"></i>
                </a>
            @endif
           
        </td>
    
    
    @if(getCrudConfig('Transaction')->delete or getCrudConfig('Transaction')->update)
        <td>


            @if($transaction->expense_id)
            <i class="fa fa-ban"data-toggle="tooltip" data-placement="top" title="لايمكن تعديل هذه الفقرة "></i>
            @else

            @if(getCrudConfig('Transaction')->update && hasPermission(getRouteName().'.transaction.update', 0, 0, $transaction))
                <a href="@route(getRouteName().'.transaction.update', $transaction->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil" ></i>
                </a>
            @endif

            @if(getCrudConfig('Transaction')->delete && hasPermission(getRouteName().'.transaction.delete', 0, 0, $transaction))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Transaction') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Transaction') ]) }}</p>
                        <div class="mt-5 d-flex justify-content-between">
                            <a wire:click.prevent="delete" class="text-white btn btn-success shadow">{{ __('Yes, Delete it.') }}</a>
                            <a @click.prevent="modalIsOpen = false" class="text-white btn btn-danger shadow">{{ __('No, Cancel it.') }}</a>
                        </div>
                    </div>
                </div>
            @endif
            @endif


        </td>
    @endif
</tr>
