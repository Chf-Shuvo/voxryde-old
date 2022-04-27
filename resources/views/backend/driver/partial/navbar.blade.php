<div class="header">
  <div class="header-left">
    <div class="menu-icon dw dw-menu"></div>
    <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
  </div>
  <div class="header-right">
    <div class="user-info-dropdown">
      <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
          <span class="user-icon">
            <img src="{{ Storage::url('driver_images/' . auth('driver')->user()->image) }}" alt="">
          </span>
          <span class="user-name">{{ auth('driver')->user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
          <a class="dropdown-item" href="{{ route('driver.profile.edit', auth('driver')->user()->id) }}"><i class="dw dw-settings2"></i> Profile Settings</a>
          <a class="dropdown-item" href="{{ route('driver.logout') }}"><i class="dw dw-logout"></i> Log
            Out</a>
        </div>
      </div>
    </div>
  </div>
</div>
