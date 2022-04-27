<div class="left-side-bar">
  {{-- logo --}}
  <div class="brand-logo">
    <a href="{{ route('customer.home') }}">
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
          <a href="javascript:;" class="dropdown-toggle">
            <span class="micon dw dw-list1"></span><span class="mtext">Orders</span>
          </a>
          <ul class="submenu">
            <li>
              <a href="{{ route('customer.order.new') }}" class="{{ Request::routeIs('customer.order.new') ? 'active' : '' }}">Place New
                Order</a>
            </li>
            <li>
              <a href="{{ route('customer.order.all') }}" class="{{ Request::routeIs('customer.order.*') ? 'active' : '' }}">My Orders</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" class="dropdown-toggle no-arrow {{ Request::routeIs('customer.*') ? 'active' : '' }}">
            <span class="micon dw dw-money-2"></span><span class="mtext">Payment History</span>
          </a>
        </li>
        <li>
          <a href="{{ route('customer.price.range', auth()->user()->id) }}" class="dropdown-toggle no-arrow {{ Request::routeIs('price.*') ? 'active' : '' }}">
            <span class="micon dw dw-analytics-13"></span><span class="mtext">Price Ranges</span>
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
