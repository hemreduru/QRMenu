<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
         data-kt-scroll-activate="true" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
         data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
             data-kt-menu="true" data-kt-menu-expand="false">
            <!--DASHBOARD-->
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">@lang('common.main')</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion {{ request()->routeIs('dashboard') ? 'here show' : '' }}">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <span class="menu-icon">{!! getIcon('category', 'fs-1') !!}</span>
                        <span class="menu-title">@lang('common.dashboard')</span>
                    </a>
                </div>
            </div>
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">@lang('common.user_management')</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion {{ request()->routeIs('user-management.*') ? 'here show' : '' }}">
                <!--USERS-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('user-management.users.*') ? 'active' : '' }}"
                       href="{{ route('user-management.users.index') }}">
                        <span class="menu-icon">{!! getIcon('user-square', 'fs-1') !!}</span>
                        <span class="menu-title">@lang('common.users')</span>
                    </a>
                </div>
                <!--ROLES-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('user-management.roles.*') ? 'active' : '' }}"
                       href="{{ route('user-management.roles.index') }}">
                        <span class="menu-icon">{!! getIcon('profile-user', 'fs-1') !!}</span>
                        <span class="menu-title">@lang('common.roles')</span>
                    </a>
                </div>
                <!--PERMISSIONS-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('user-management.permissions.*') ? 'active' : '' }}"
                       href="{{ route('user-management.permissions.index') }}">
                        <span class="menu-icon">{!! getIcon('key', 'fs-1') !!}</span>
                        <span class="menu-title">@lang('common.permissions')</span>
                    </a>
                </div>
            </div>
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">@lang('common.table_management')</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion {{ request()->routeIs('user-management.*') ? 'here show' : '' }}">
                <!--TABLES-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('table.*') ? 'active' : '' }}"
                       href="{{ route('table.index') }}">
                        <span class="menu-icon">{!! getIcon('user-square', 'fs-1') !!}</span>
                        <span class="menu-title">@lang('common.table')</span>
                    </a>
                    <a class="menu-link {{ request()->routeIs('table.create.*') ? 'active' : '' }}"
                       href="{{ route('table.create') }}">
                        <span class="menu-icon">{!! getIcon('user-square', 'fs-1') !!}</span>
                        <span class="menu-title">@lang('common.table_create')</span>
                    </a>
                </div>
            </div>
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">@lang('common.category_management')</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion {{ request()->routeIs('menu-management.categories.*') ? 'here show' : '' }}">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('menu-management.categories.index') ? 'active' : '' }}"
                       href="{{ route('menu-management.categories.index') }}">
                        <span class="menu-icon">{!! getIcon('abstract-14', 'fs-1') !!}</span>
                        <span class="menu-title">@lang('common.categories_index')</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('menu-management.categories.create') ? 'active' : '' }}"
                       href="{{ route('menu-management.categories.create') }}">
                        <span class="menu-icon">{!! getIcon('abstract-10', 'fs-1') !!}</span>
                        <span class="menu-title">@lang('common.categories_create')</span>
                    </a>
                </div>
            </div>
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">@lang('common.product_management')</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion {{ request()->routeIs('menu-management.products.*') ? 'here show' : '' }}">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('menu-management.products.index') ? 'active' : '' }}"
                       href="{{ route('menu-management.products.index') }}">
                        <span class="menu-icon">{!! getIcon('lots-shopping', 'fs-1') !!}</span>
                        <span class="menu-title">@lang('common.products_index')</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('menu-management.products.create') ? 'active' : '' }}"
                       href="{{ route('menu-management.products.create') }}">
                        <span class="menu-icon">{!! getIcon('abstract-10', 'fs-1') !!}</span>
                        <span class="menu-title">@lang('common.products_create')</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

