<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $expense->category->name }}</td>
    <td class="">@money($expense->amount)</td>
    <td class="">{{ $expense->date }}</td>
    <td class="">{{ $expense->description }}</td>
    
    @if(getCrudConfig('Expense')->delete or getCrudConfig('Expense')->update)
        <td>

            @if(getCrudConfig('Expense')->update && hasPermission(getRouteName().'.expense.update', 0, 0, $expense))
                <a href="@route(getRouteName().'.expense.update', $expense->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('Expense')->delete && hasPermission(getRouteName().'.expense.delete', 0, 0, $expense))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Expense') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Expense') ]) }}</p>
                        <div class="mt-5 d-flex justify-content-between">
                            <a wire:click.prevent="delete" class="text-white btn btn-success shadow">{{ __('Yes, Delete it.') }}</a>
                            <a @click.prevent="modalIsOpen = false" class="text-white btn btn-danger shadow">{{ __('No, Cancel it.') }}</a>
                        </div>
                    </div>
                </div>
            @endif
        </td>
    @endif
</tr>
