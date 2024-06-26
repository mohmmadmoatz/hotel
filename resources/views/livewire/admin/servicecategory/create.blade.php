<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Servicecategory') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.servicecategory.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Servicecategory')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">
            <div class="row">
                        <!-- Name Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-name' class='control-label '> {{ __('Name') }}</label>
                <input type='text' id='input-name' wire:model.lazy='name' class="form-control  @error('name') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>            <!-- Printer Input -->
            <!-- <div class="col-md-6">
            <div class='form-group'>
                <label for='input-printer' class='control-label '> {{ __('Printer') }}</label>
                <select type='text' id='input-printer' wire:model.lazy='printer' class="form-control  @error('printer') is-invalid @enderror" placeholder='' autocomplete='on'>
                    <option value="">Select Printer</option>
                    @foreach($printers as $printer)
                        <option value="{{ $printer }}">{{ $printer }}</option>
                    @endforeach
                </select>
                @error('printer') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div> -->
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.servicecategory.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
