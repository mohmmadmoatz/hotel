<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Expense') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.expense.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Expense')) }}</a></li>
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
                <select wire:model.lazy='category_id' class="form-control  @error('category_id') is-invalid @enderror">
                    <option value="">يرجى اختيار التصنيف</option>
                    @foreach(App\Models\Expensecategory::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category_id') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>            <!-- Amount Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-amount' class='control-label '> {{ __('Amount') }}</label>
                <input x-data x-mask:dynamic="$money($input, '.', ',', 4)" type='text' id='input-amount' wire:model.lazy='amount' class="form-control  @error('amount') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('amount') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>            <!-- Date Input -->

    
            <div class="col-md-6">
                <div class='form-group'>
                    <label for='input-date' class=' control-label '> {{ __('Date') }}</label>
                    <input type='date' id='input-date' wire:model.lazy='date' class="form-control  @error('date') is-invalid @enderror" autocomplete='on'>
                    @error('date') <div class='invalid-feedback'>{{ $message }}</div> @enderror
                </div>
            </div>
           
            <!-- Description Input -->
            <div class="col-md-6">
                <div class='form-group'>
                    <label for='input-description' class=' control-label '> {{ __('Description') }}</label>
                    <textarea id="input-description" wire:model.lazy='description' class="form-control  @error('description') is-invalid @enderror" placeholder='' autocomplete='on'></textarea>
                    @error('description') <div class='invalid-feedback'>{{ $message }}</div> @enderror
                </div>
            </div>

            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.expense.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
