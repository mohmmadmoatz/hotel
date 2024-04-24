<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $customer->name }}</td>
    <td class="">{{ $customer->phone }}</td>
    <td class="">{{ $customer->city }}</td>
    <td class="">{{ $customer->nat }}</td>
    <td class="">{{ $customer->idf }}</td>
    
    @if(getCrudConfig('Customer')->delete or getCrudConfig('Customer')->update)
        <td>

            @if(getCrudConfig('Customer')->update && hasPermission(getRouteName().'.customer.update', 0, 0, $customer))
                <a href="@route(getRouteName().'.customer.update', $customer->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('Customer')->delete && hasPermission(getRouteName().'.customer.delete', 0, 0, $customer))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Customer') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Customer') ]) }}</p>
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
