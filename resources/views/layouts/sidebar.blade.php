 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="/" class="app-brand-link">
        
        <span class="app-brand-text demo menu-text fw-bold">Admin</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

      <!-- e-commerce-app menu start -->
      <li class="menu-item">
        <li class="menu-item">
          <a href="/" class="menu-link">
            <i class="menu-icon tf-icons ti ti-dashboard"></i>
            <div data-i18n="Dashboard">Dashboard</div>
          </a>

        </li>


      </li>
      <!-- e-commerce-app menu end -->

      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-users"></i>
          <div data-i18n="Users">Users</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('users.index') }}" class="menu-link">
              <div data-i18n="All-Users">All Users</div>
            </a>
          </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-building"></i> <!-- Changed icon to represent department -->
          <div data-i18n="Departments">Departments</div> <!-- Changed label to Departments -->
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('departments.index') }}" class="menu-link"> 
              <div data-i18n="All-Departments">All Departments</div> <!-- Changed inner label to List -->
            </a>
          </li>
        </ul>
      </li>
      
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-file"></i> 
          <div data-i18n="Documents">Documents</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('documents.index') }}" class="menu-link">
              <div data-i18n="All-Documents">All Documents</div> 
            </a>
          </li>
        </ul>
      </li>
      
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-briefcase"></i> <!-- Changed icon to represent services -->
          <div data-i18n="Services">Services</div> <!-- Changed label to Services -->
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('services.index') }}" class="menu-link"> 
              <div data-i18n="All-Services">All Services</div> <!-- Changed inner label to All Services -->
            </a>
          </li>
        </ul>
      </li>
      
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-tag"></i> <!-- Changed icon to represent categories -->
            <div data-i18n="Merchant-Categories">Merchant Categories</div> <!-- Changed label to Merchant Categories -->
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{ route('merchant-categories.index') }}" class="menu-link"> 
                    <div data-i18n="All-Merchant-Categories">All Merchant Categories</div> <!-- Changed inner label to All Merchant Categories -->
                </a>
            </li>
        </ul>
    </li>
    
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-world"></i> <!-- Changed icon to represent country -->
          <div data-i18n="Country">Country</div> <!-- Changed label to Country -->
      </a>
      <ul class="menu-sub">
          <li class="menu-item">
              <a href="{{ route('countries.index') }}" class="menu-link"> 
                  <div data-i18n="All-Countries">All Countries</div> <!-- Changed inner label to All Countries -->
              </a>
          </li>
      </ul>
  </li>

  
    </ul>
  </aside>
  <!-- / Menu -->