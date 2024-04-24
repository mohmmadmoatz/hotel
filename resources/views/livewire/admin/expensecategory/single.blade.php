<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $expensecategory->name }}</td>
    
    @if(getCrudConfig('Expensecategory')->delete or getCrudConfig('Expensecategory')->update)
        <td>

            @if(getCrudConfig('Expensecategory')->update && hasPermission(getRouteName().'.expensecategory.update', 0, 0, $expensecategory))
                <a href="@route(getRouteName().'.expensecategory.update', $expensecategory->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('Expensecategory')->delete && hasPermission(getRouteName().'.expensecategory.delete', 0, 0, $expensecategory))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Expensecategory') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Expensecategory') ]) }}</p>
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
