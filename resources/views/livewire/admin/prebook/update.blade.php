<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('UpdateTitle', ['name' => __('Prebook') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.prebook.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Prebook')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Update') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">

        <div class="card-body">

            <div class="row">

            

                        <!-- Name Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-name' class='control-label '> {{ __('Name') }}</label>
                <input type='text' id='input-name' wire:model.lazy='name' class="form-control  @error('name') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>            <!-- Room_id Input -->
<div class="col-md-6">
            <div class='form-group'>
                <label for='input-room_id' class='control-label '> {{ __('Room_id') }}</label>
                <select class="form-control  @error('room_id') is-invalid @enderror" wire:model.lazy="room_id">
                    <option></option>
                    @foreach(App\Models\Room::all() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                @error('room_id') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>           <!-- Book_date Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-book_date' class='control-label '> {{ __('Book_date') }}</label>
                <input type='date' id='input-book_date' wire:model.lazy='book_date' class="form-control  @error('book_date') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('book_date') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>            <!-- Details Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-details' class='control-label '> {{ __('Details') }}</label>
                <input type='text' id='input-details' wire:model.lazy='details' class="form-control  @error('details') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('details') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>

</div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Update') }}</button>
            <a href="@route(getRouteName().'.prebook.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
