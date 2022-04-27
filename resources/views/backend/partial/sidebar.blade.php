<div class="left-side-bar">
  {{-- logo --}}
  <div class="brand-logo">
    <a href="{{ route('home') }}">
      {{ env('APP_NAME') }}
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close">
      <i class="ion-close-round"></i>
    </div>
  </div>
  {{-- logo ends --}}

  {{-- menu starts --}}
  <div class="menu-block customscroll">
    <div class="sidebar-menu">
      <ul id="accordion-menu">
        {{-- super-admin --}}
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle">
            <span class="micon dw dw-settings2"></span><span class="mtext">Settings</span>
          </a>
          <ul class="submenu">
            <li>
              <a href="{{ route('user-profile.index') }}" class="{{ Request::routeIs('user-profile.*') ? 'active' : '' }}">Users</a>
            </li>
            <li>
              <a href="{{ route('permission.index') }}" class="{{ Request::routeIs('permission.*') ? 'active' : '' }}">Access Control List</a>
            </li>
            <li>
              <a href="{{ route('audit.index') }}" class="{{ Request::routeIs('audit.*') ? 'active' : '' }}">Check Audtis</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="{{ route('customer.index') }}" class="dropdown-toggle no-arrow {{ Request::routeIs('customer.*') ? 'active' : '' }}">
            <span class="micon dw dw-user-11"></span><span class="mtext">Customers</span>
          </a>
        </li>
        <li>
          <a href="{{ route('vehicle-types.index') }}" class="dropdown-toggle no-arrow {{ Request::routeIs('vehicle-types.*') ? 'active' : '' }}">
            <span class="micon dw dw-car"></span><span class="mtext">Vehicle Types</span>
          </a>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle">
            <span class="micon dw dw-delivery-truck"></span><span class="mtext">Driver</span>
          </a>
          <ul class="submenu">
            <li>
              <a href="{{ route('driver-details.index') }}" class="{{ Request::routeIs('driver-details.*') ? 'active' : '' }}">Drivers</a>
            </li>
            <li>
              <a href="{{ route('driver.document.index') }}" class="{{ Request::routeIs('driver.document.*') ? 'active' : '' }}">Required Docs</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="{{ route('price.index') }}" class="dropdown-toggle no-arrow {{ Request::routeIs('price.*') ? 'active' : '' }}">
            <span class="micon dw dw-price-tag"></span><span class="mtext">Pricing</span>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
      </ul>
    </div>
  </div>
  {{-- menu ends --}}
</div>
<div class="mobile-menu-overlay"></div>
