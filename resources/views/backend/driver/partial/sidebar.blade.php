<div class="left-side-bar">
  {{-- logo --}}
  <div class="brand-logo">
    <a href="{{ route('driver.home') }}">
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
        <li>
          <a href="{{ route('driver.order.mine') }}" class="dropdown-toggle no-arrow  {{ Request::routeIs('driver.order.*') ? 'active' : '' }}">
            <span class="micon dw dw-list1"></span><span class="mtext">My Orders</span>
          </a>
        </li>
        <li>
          <a href="{{ route('driver.document.provide.index') }}" class="dropdown-toggle no-arrow  {{ Request::routeIs('driver.order.*') ? 'active' : '' }}">
            <span class="micon dw dw-id-card2"></span><span class="mtext">My Documents</span>
          </a>
        </li>
        <li>
          <a href="#" class="dropdown-toggle no-arrow {{ Request::routeIs('price.*') ? 'active' : '' }}">
            <span class="micon dw dw-support"></span><span class="mtext">Contact Support</span>
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
