<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('UpdateTitle', ['name' => __('User') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.user.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('User')) }}</a></li>
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
</div>          
 
       <div class="col-md-6">
        <div class='form-group'>
            <label for='input-email' class=' control-label '> {{ __('Email') }}</label>
            <input type='email' id='input-email' wire:model.lazy='email' class="form-control  @error('email') is-invalid @enderror" placeholder='' autocomplete='on'>
            @error('email') <div class='invalid-feedback'>{{ $message }}</div> @enderror
        </div>
       </div>
        <div class="col-md-6">
            <div class='form-group'>
                <label for='inputpassword' class=' control-label '> {{ __('Password') }}</label>
                <input type='password' id='input-password' wire:model.lazy='password' class="form-control  @error('password') is-invalid @enderror" placeholder=''>
                @error('password') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
        </div>
           
            <!-- Role Input -->
            <div class="col-md-6">
            <div class='form-group'>
                <label for='input-role' class='control-label '> {{ __('Role') }}</label>
                <select name="" id="" class="form-control  @error('role') is-invalid @enderror"" wire:model.lazy="role">
                    <option value="admin">Admin</option>
                    <option value="استقبال">استقبال</option>
                    <option value="محاسب">محاسب</option>
                    <option value="لوندري">لوندري</option>
                </select>
                @error('role') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
</div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Update') }}</button>
            <a href="@route(getRouteName().'.user.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
