<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Service') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.service.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Service')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">
            <div class="row">
                        <!-- Category_id Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-category_id' class='control-label '> {{ __('Category_id') }}</label>
                <select type='text' id='input-category_id' wire:model.lazy='category_id' class="form-control  @error('category_id') is-invalid @enderror" placeholder='' autocomplete='on'>
                    <option value="">التصنيف</option>
                    @foreach (App\Models\Servicecategory::all() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                        
                    @endforeach
                </select>
                @error('category_id') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>            <!-- Name Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-name' class='control-label '> {{ __('Name') }}</label>
                <input type='text' id='input-name' wire:model.lazy='name' class="form-control  @error('name') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>            <!-- Price Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-price' class='control-label '> {{ __('Price') }}</label>
                <input type='text' id='input-price' wire:model.lazy='price' class="form-control  @error('price') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('price') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.service.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
