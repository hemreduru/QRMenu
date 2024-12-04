<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::User menu-->
    <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="d-flex align-items-center" style="margin-right: 2vh;">
            <div class="dropdown">
                <button class="btn btn-light-primary dropdown-toggle" type="button" id="languageDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-translate"></i>
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                           href="{{ route('change.language', ['lang' => 'en']) }}">
                            <img src="/assets/media/flags/united-states.svg" class="me-3" alt="EN"
                                 style="width: 20px; height: auto;">
                            @lang('common.english')
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                           href="{{ route('change.language', ['lang' => 'tr']) }}">
                            <img src="/assets/media/flags/turkey.svg" class="me-3" alt="TR"
                                 style="width: 20px; height: auto;">
                            @lang('common.turkish')
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex align-items-center" style="margin-right: 2vh;">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="themeDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-moon-stars"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" onclick="toggleTheme()">
                            <i class="bi bi-sun me-2"></i> @lang('common.light_theme')
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" onclick="toggleTheme()">
                            <i class="bi bi-moon me-2"></i> @lang('common.dark_theme')
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                 data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                @if(Auth::user()->profile_photo_url)
                    <div class="d-flex align-items-center">
                        <img src="{{ \Auth::user()->profile_photo_url }}" class="rounded-3 me-2" alt="user"/>
                        <strong class="ms-2 bold">{{ Auth::user()->name }}</strong>
                    </div>
                @else
                    <div class="d-flex align-items-center">
                        <div
                            class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', Auth::user()->name) }}">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <strong class="ms-2 bold">{{ Auth::user()->name }}</strong>
                    </div>
                @endif
            </div>
        </div>
        @include('partials/menus/_user-account-menu')
    </div>
</div>
