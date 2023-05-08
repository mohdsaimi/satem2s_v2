<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        {{-- <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#signet') }}"></use>
        </svg> --}}
        <h5><i class="fas fa-fingerprint"></i>{{-- <i class="c-icon c-icon-lg cil-paw"> --}}</i> SATEM2S</h5>
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>

{{-- <li class="c-sidebar-nav-title">DASAR</li> --}}
                {{-- ASAS --}}
                @if($logged_in_user->hasAllAccess() ||
                (
                    $logged_in_user->can('bppl') ||
                    $logged_in_user->can('bkkl') ||
                    $logged_in_user->can('bppa') 
                ))

                <li class="c-sidebar-nav-dropdown {{-- {{ activeClass(Route::is('admin.auth.role.*'), 'c-open c-show') }} --}}">
                    <x-utils.link
                        href="#"
                        icon="c-sidebar-nav-icon fas fa-sitemap"
                        class="c-sidebar-nav-dropdown-toggle"
                        :text="__('Pengurusan Dasar')" />

                    <ul class="c-sidebar-nav-dropdown-items">

                        @if($logged_in_user->can('bppl'))
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.course')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Pengurusan Kursus')"
                                    :active="activeClass(Route::is('admin/course.*'), 'c-active')" />
                            </li>

                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.student')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Pengurusan Pelajar')"
                                    :active="activeClass(Route::is('admin/student.*'), 'c-active')" />
                            </li>

                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.semester')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Pengurusan Semester')"
                                    :active="activeClass(Route::is('admin/semester.*'), 'c-active')" />
                            </li>
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.tetapan_dkp')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Tetapan DKP')"
                                    :active="activeClass(Route::is('admin/tetapan_dkp.*'), 'c-active')" />
                            </li>
                        @endif



                    </ul>
                </li>{{-- end Pengurusan Dasar --}}

                @endif
                {{-- end ASAS --}}

                {{-- no 2 --}}
                @if($logged_in_user->hasAllAccess() ||
                (
                    $logged_in_user->can('bppl') ||
                    $logged_in_user->can('bkkl') ||
                    $logged_in_user->can('bppa') ||
                    $logged_in_user->can('techteam') ||
                    $logged_in_user->can('atateam')
                ))
                <li class="c-sidebar-nav-dropdown {{-- {{ activeClass(Route::is('admin.course.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }} --}}">
                    <x-utils.link
                        href="#"
                        icon="c-sidebar-nav-icon fas fa-fingerprint"
                        class="c-sidebar-nav-dropdown-toggle"
                        :text="__('SATEM2S')" />

                    <ul class="c-sidebar-nav-dropdown-items">

                        @if($logged_in_user->hasAllAccess())
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.rfid')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Pengurusan RFID')"
                                    :active="activeClass(Route::is('admin/rfid.*'), 'c-active')" />
                            </li>
                        @endif

                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.kehadiran')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Kehadiran Pelajar')"
                                    :active="activeClass(Route::is('admin/kehadiran.*'), 'c-active')" />
                            </li>

                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.kehadiran_dkp')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Laporan DKP')"
                                    :active="activeClass(Route::is('admin/kehadiran_dkp.*'), 'c-active')" />
                            </li>

                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.log_in_out')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Laporan Keluar/Masuk')"
                                    :active="activeClass(Route::is('admin/log_in_out.*'), 'c-active')" />
                            </li>

                    </ul>
                </li>{{-- end satem2s --}}

                @endif
                {{-- end no 2 --}}


        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
            )
        )
            <li class="c-sidebar-nav-title">@lang('System')</li>

            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-user"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.user.index')"
                                class="c-sidebar-nav-link"
                                :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')" />
                    </li>
                </ul>
            </li>
        @endif
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
