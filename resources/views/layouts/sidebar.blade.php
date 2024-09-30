 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="/" class="menu-link">
        <img style="width: 200px; margin-top: 10px"  src="https://projects.multibizdev.com/tess_kyc/assets/img/tess_logo.png" alt="">
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- e-commerce-app menu end -->
     
      <li class="menu-item {{ Request::is('merchants') || Request::is('merchantskyc') || Request::is('merchantsdocuments') || Request::is('merchantsSales') ||  Request::is('merchantService') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-users"></i>
            <div data-i18n="Merchants">Merchants</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('merchants.index') ? 'active' : '' }}">
                <a href="{{ route('merchants.index') }}" class="menu-link">
                    <div data-i18n="All-Merchants">All Merchants</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('create.merchants.kfc') ? 'active' : '' }}">
                <a href="{{ route('create.merchants.kfc') }}" class="menu-link">
                    <div data-i18n="Create-Merchants">Create Merchants</div>
                </a>
            </li>
        </ul>
    </li>
    

    
    <li class="menu-item {{ request()->routeIs('users.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-users"></i>
        <div data-i18n="Users">Users</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
          <a href="{{ route('users.index') }}" class="menu-link">
            <div data-i18n="All-Users">All Users</div>
          </a>
        </li>
        <li class="menu-item {{ request()->routeIs('users.create') ? 'active' : '' }}">
          <a href="{{ route('users.create') }}" class="menu-link">
            <div data-i18n="Create-User">Create User</div>
          </a>
        </li>
      </ul>
    </li>
    
    <li class="menu-item {{ request()->routeIs('departments.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-building"></i>
        <div data-i18n="Departments">Departments</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('departments.index') ? 'active' : '' }}">
          <a href="{{ route('departments.index') }}" class="menu-link">
            <div data-i18n="All-Departments">All Departments</div>
          </a>
        </li>
      </ul>
    </li>
    
    <li class="menu-item {{ request()->routeIs('documents.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-file"></i>
        <div data-i18n="Documents">Documents</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('documents.index') ? 'active' : '' }}">
          <a href="{{ route('documents.index') }}" class="menu-link">
            <div data-i18n="All-Documents">All Documents</div>
          </a>
        </li>
      </ul>
    </li>
    
    <li class="menu-item {{ request()->routeIs('services.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-briefcase"></i>
        <div data-i18n="Services">Services</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('services.index') ? 'active' : '' }}">
          <a href="{{ route('services.index') }}" class="menu-link">
            <div data-i18n="All-Services">All Services</div>
          </a>
        </li>
      </ul>
    </li>
    
    <li class="menu-item {{ request()->routeIs('merchant-categories.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-tag"></i>
        <div data-i18n="Merchant-Categories">Merchant Categories</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('merchant-categories.index') ? 'active' : '' }}">
          <a href="{{ route('merchant-categories.index') }}" class="menu-link">
            <div data-i18n="All-Merchant-Categories">All Merchant Categories</div>
          </a>
        </li>
      </ul>
    </li>
    
    <li class="menu-item {{ request()->routeIs('countries.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-world"></i>
        <div data-i18n="Country">Country</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('countries.index') ? 'active' : '' }}">
          <a href="{{ route('countries.index') }}" class="menu-link">
            <div data-i18n="All-Countries">All Countries</div>
          </a>
        </li>
      </ul>
    </li>
    



    </ul>
  </aside>
  <!-- / Menu -->