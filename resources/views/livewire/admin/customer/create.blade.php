<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Customer') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.customer.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Customer')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">
                        <!-- Name Input -->
            <div class='form-group'>
                <label for='input-name' class='col-sm-2 control-label '> {{ __('Name') }}</label>
                <input type='text' id='input-name' wire:model.lazy='name' class="form-control  @error('name') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Phone Input -->
            <div class='form-group'>
                <label for='input-phone' class='col-sm-2 control-label '> {{ __('Phone') }}</label>
                <input type='text' id='input-phone' wire:model.lazy='phone' class="form-control  @error('phone') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('phone') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- City Input -->
            <div class='form-group'>
                <label for='input-city' class='col-sm-2 control-label '> {{ __('City') }}</label>
                <select type='text' id='input-city' wire:model.lazy='city' class="form-control  @error('city') is-invalid @enderror" placeholder='' autocomplete='on'>
                    <option value="">يرجى اختيار المحافظة</option>
                    <!-- Iraq cities -->
                    <option value="بغداد">بغداد</option>
<option value="البصرة">البصرة</option>
<option value="الموصل">الموصل</option>
<option value="كربلاء">كربلاء</option>
<option value="النجف">النجف</option>
<option value="الأنبار">الأنبار</option>
<option value="صلاح الدين">صلاح الدين</option>
<option value="ديالى">ديالى</option>
<option value="ميسان">ميسان</option>
<option value="واسط">واسط</option>
<option value="كركوك">كركوك</option>
<option value="نينوى">نينوى</option>
<option value="القادسية">القادسية</option>
<option value="ذي قار">ذي قار</option>
<option value="ميسان">ميسان</option>
<option value="بابل">بابل</option>
<option value="دهوك">دهوك</option>
<option value="اربيل">اربيل</option>
<option value="سليمانية">سليمانية</option>
                    
                   
                    
                </select>
                @error('city') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Details Input -->
            <div class='form-group'>
                <label for='input-details' class='col-sm-2 control-label '> {{ __('Details') }}</label>
                <textarea id="input-details" wire:model.lazy='details' class="form-control  @error('details') is-invalid @enderror" placeholder='' autocomplete='on'></textarea>
                @error('details') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.customer.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
