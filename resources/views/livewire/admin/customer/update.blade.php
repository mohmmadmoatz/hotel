<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('UpdateTitle', ['name' => __('Customer') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.customer.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Customer')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Update') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">

        <div class="card-body">

                        <!-- Name Input -->
            <div class='form-group'>
                <label for='input-name' class='col-sm-2 control-label '> {{ __('Name') }}</label>
                <input type='text' id='input-name' wire:model.lazy='name' class="form-control  @error('name') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
           
            <div class="row">
            <div class="col-md-6">
                    <label for="">اللقب</label>
                    <input type="text" class="form-control" wire:model.defer="lastname">
                </div>

                <div class="col-md-6">
                    <label for="">رقم الهاتف</label>
                    <input type="number" class="form-control" wire:model.defer="phone">
                </div>

                <div class="col-md-6">
                    <label for="">اسم الأم</label>
                    <input type="text" class="form-control" wire:model.defer="mother_name">
                </div>

                <div class="col-md-6">
                    <label for="">الجنسية</label>
                    <input type="text" class="form-control" wire:model.defer="nat">

                </div>

                <div class="col-md-6">
                    <label for="">المحافظة</label>
                    <input type="text" class="form-control" wire:model.defer="city">

                </div>

                <div class="col-md-6">
                    <label for="">رقم الهوية او جواز السفر</label>
                    <input type="text" class="form-control" wire:model.defer="idf">
                </div>

                <div class="col-md-6">
                    <label for="">تاريخ الأصدار</label>
                    <input type="date" class="form-control" wire:model.defer="id_date">
                </div>

                <div class="col-md-6">
                    <label for="">المواليد</label>
                    <input type="date" class="form-control" wire:model.defer="borndate">
                </div>

                <div class="col-md-6">
                    <label for="">الجنس</label>
                    <select class="form-control" wire:model.defer="gender">
                        <option value=""></option>
                        <option>ذكر</option>
                        <option>انثى</option>
                    </select>
                </div>

            </div>

            <!-- Details Input -->
            


        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Update') }}</button>
            <a href="@route(getRouteName().'.customer.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
