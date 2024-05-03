<li class="list-divider"></li>
<li class="nav-small-cap"><span class="hide-menu">{{ __('CRUD Menu') }}</span></li>

@if(auth()->user()->role == 'admin')

<li class='sidebar-item'>
    <a class='sidebar-link has-arrow' href="javascript:void(0)" aria-expanded="false">
        <i class="icon-settings"></i>
        <span class="hide-menu">التعريفات</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level base-level-line">


        <li class="sidebar-item @isActive(getRouteName().'.'.'room'.'.read')">
            <a href="@route(getRouteName().'.'.'room'.'.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'room'.'.read')">
                <span class="hide-menu"> الغرف</span>
            </a>
        </li>

        <li class="sidebar-item @isActive(getRouteName().'.'.'servicecategories'.'.read')">
            <a href="@route(getRouteName().'.'.'servicecategory'.'.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'room'.'.read')">
                <span class="hide-menu"> اصناف الخدمات</span>
            </a>
        </li>

        <li class="sidebar-item @isActive(getRouteName().'.'.'expensecategory'.'.read')">
            <a href="@route(getRouteName().'.'.'expensecategory'.'.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'room'.'.read')">
                <span class="hide-menu"> اصناف المصاريف</span>
            </a>
        </li>

        <li class="sidebar-item @isActive(getRouteName().'.'.'incomecat'.'.read')">
            <a href="@route(getRouteName().'.'.'incomecat'.'.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'room'.'.read')">
                <span class="hide-menu"> اصناف الواردات</span>
            </a>
        </li>
       

        <li class="sidebar-item @isActive(getRouteName().'.'.'user'.'.read')">
            <a href="@route(getRouteName().'.'.'user'.'.read')"
                class="sidebar-link @isActive(getRouteName().'.'.'user'.'.read')">
                <span class="hide-menu"> المستخدمين</span>
            </a>
        </li>




    </ul>
</li>

<li class="sidebar-item @isActive(getRouteName().'.'.'service'.'.read')">
    <a href="@route(getRouteName().'.'.'service'.'.read')"
        class="sidebar-link @isActive(getRouteName().'.'.'service'.'.read')">
        <i class="fa fa-file"></i>

        <span class="hide-menu"> الخدمات</span>
    </a>
</li>
@endif

@if(auth()->user()->role == 'admin' || auth()->user()->role == 'استقبال')

<li class="sidebar-item @isActive(getRouteName().'.'.'customer'.'.read')">
    <a href="@route(getRouteName().'.'.'customer'.'.read')"
        class="sidebar-link @isActive(getRouteName().'.'.'customer'.'.read')">
        <i class="fa fa-users"></i>

        <span class="hide-menu"> بيانات الزبائن</span>
    </a>
</li>

<li class="sidebar-item @isActive(getRouteName().'.'.'bookednow'.'.create','selected')">
    <a href="@route(getRouteName().'.'.'bookednow'.'.read')"
        class="sidebar-link @isActive(getRouteName().'.'.'bookednow'.'.read')">

        <i class="fa fa-home"></i>
        <span class="hide-menu"> الاستقبال</span>
    </a>
</li>


<li class="sidebar-item ">
    <a href="@route(getRouteName().'.'.'booking'.'.read')" class="sidebar-link">

        <i class="fa fa-list"></i>
        <span class="hide-menu"> الحجوزات السابقة</span>
    </a>
</li>

<li class="sidebar-item ">
    <a href="@route(getRouteName().'.'.'prebook'.'.read')" class="sidebar-link">

        <i class="fa fa-list"></i>
        <span class="hide-menu"> الحجوزات المسبقة</span>
    </a>
</li>

@endif


@if(auth()->user()->role == 'admin' || auth()->user()->role == 'محاسب')

<li class="sidebar-item ">
    <a href="@route(getRouteName().'.'.'expense'.'.read')" class="sidebar-link ">

        <i class="fa fa-redo"></i>
        <span class="hide-menu"> المصاريف</span>
    </a>
</li>

<li class="sidebar-item @isActive('admin.transaction.create','selected')">
    <a href="@route(getRouteName().'.'.'transaction'.'.read')" class="sidebar-link ">

        <i class="fa fa-box"></i>
        <span class="hide-menu"> القاصة</span>
    </a>
</li>

@endif

@if(auth()->user()->role == 'admin')

<li class="sidebar-item @isActive('admin.transaction.create','selected')">
    <a href="@route('admin.report')" class="sidebar-link ">

        <i class="fa fa-file"></i>
        <span class="hide-menu">التقرير العام</span>
    </a>
</li>

@endif