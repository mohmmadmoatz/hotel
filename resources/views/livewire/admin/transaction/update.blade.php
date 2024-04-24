<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('UpdateTitle', ['name' => __('Transaction') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.transaction.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Transaction')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Update') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">

    <div class="card-body">
            <div class="row">
               <div class="col-12">

           
            <div class='form-group'>
                <label for='input-details' class='col-sm-2 control-label '> {{ __('Details') }}</label>
                <textarea id="input-details" wire:model.lazy='details' class="form-control  @error('details') is-invalid @enderror" placeholder='' autocomplete='on'></textarea>
                @error('details') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
        </div>
            <!-- Type Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-type' class='control-label '> {{ __('Type') }}</label>
                <select type='text' id='input-type' wire:model.lazy='type' class="form-control  @error('type') is-invalid @enderror" placeholder='' autocomplete='on'>
                    <option value="">يرجى اختيار نوع العملية</option>
                    <option value="add">قبض</option>
                    <option value="sub">صرف</option>
                </select>  
                @error('type') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>            <!-- Amount Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-amount' class='control-label '> {{ __('Amount') }}</label>
                <input x-data x-mask:dynamic="$money($input, '.', ',', 4)" type='text' id='input-amount' wire:model.lazy='amount' class="form-control  @error('amount') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('amount') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>            <!-- Date Input -->
<div class="col-12">


            <div class='form-group'>
                <label for='input-date' class='col-sm-2 control-label '> {{ __('Date') }}</label>
                <input type='date' id='input-date' wire:model.lazy='date' class="form-control  @error('date') is-invalid @enderror" autocomplete='on'>
                @error('date') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
        </div>

            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Update') }}</button>
            <a href="@route(getRouteName().'.transaction.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
