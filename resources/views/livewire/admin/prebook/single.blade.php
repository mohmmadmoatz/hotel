<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $prebook->name }}</td>
    <td class="">{{ $prebook->room->name }}</td>
    <td class="">{{ $prebook->book_date }}</td>
    <td class="">{{ $prebook->details }}</td>
    
    @if(getCrudConfig('Prebook')->delete or getCrudConfig('Prebook')->update)
        <td>

            @if(getCrudConfig('Prebook')->update && hasPermission(getRouteName().'.prebook.update', 0, 0, $prebook))
                <a href="@route(getRouteName().'.prebook.update', $prebook->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('Prebook')->delete && hasPermission(getRouteName().'.prebook.delete', 0, 0, $prebook))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Prebook') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Prebook') ]) }}</p>
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
