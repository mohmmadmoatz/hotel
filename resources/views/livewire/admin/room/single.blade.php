<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $room->name }}</td>
    <td class="">{{ $room->price }}</td>
    <td class="">{{ $room->room_type }}</td>
    
    @if(getCrudConfig('Room')->delete or getCrudConfig('Room')->update)
        <td>

            @if(getCrudConfig('Room')->update && hasPermission(getRouteName().'.room.update', 0, 0, $room))
                <a href="@route(getRouteName().'.room.update', $room->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('Room')->delete && hasPermission(getRouteName().'.room.delete', 0, 0, $room))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Room') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Room') ]) }}</p>
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
