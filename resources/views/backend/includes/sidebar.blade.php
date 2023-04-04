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

                        @if($logged_in_user->can('bppa'))
                        {{-- @can('bppa') --}}
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.lokasi')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Pengurusan Lokasi Ruang')"
                                    :active="activeClass(Route::is('admin/lokasi.*'), 'c-active')" />
                            </li>
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.bppa')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Tetapan BPPA')"
                                    :active="activeClass(Route::is('admin/bppa.*'), 'c-active')" />
                            </li>
                        {{-- @endcan --}}

                        @endif

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

                    </ul>
                </li>{{-- end satem2s --}}

                @endif
                {{-- end no 2 --}}

                {{-- no 3 --}}
                @if($logged_in_user->hasAllAccess() ||
                (
                    $logged_in_user->can('bppa') ||
                    $logged_in_user->can('techteam')
                ))
                <li class="c-sidebar-nav-dropdown">
                    <x-utils.link
                        href="#"
                        icon="c-sidebar-nav-icon fas fa-landmark"
                        class="c-sidebar-nav-dropdown-toggle"
                        :text="__('ASET ALIH')" />

                    <ul class="c-sidebar-nav-dropdown-items">

                        @if($logged_in_user->can('bppa'))
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.hartamodal')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Senarai Harta Modal')"
                                    :active="activeClass(Route::is('admin/hartamodal.*'), 'c-active')" />
                            </li>

                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.abr')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Senarai ABR')"
                                    :active="activeClass(Route::is('admin/abr.*'), 'c-active')" />
                            </li>

                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.hmrosak')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Aduan Kerosakan (HM)')"
                                    :active="activeClass(Route::is('admin/hmrosak.*'), 'c-active')" />
                            </li>

                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.abrrosak')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Aduan Kerosakan (ABR)')"
                                    :active="activeClass(Route::is('admin/abrrosak.*'), 'c-active')" />
                            </li>
                        @endif

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.hmrosaktin')"
                                class="c-sidebar-nav-link"
                                :text="__('Tindakan Aduan (HM)')"
                                :active="activeClass(Route::is('admin/hmrosaktin.*'), 'c-active')" />
                        </li>

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.abrrosaktin')"
                                class="c-sidebar-nav-link"
                                :text="__('Tindakan Aduan (ABR)')"
                                :active="activeClass(Route::is('admin/abrrosaktin.*'), 'c-active')" />
                        </li>

                        @if($logged_in_user->can('bppa'))

                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.hmlupus')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Permohonan Pelupusan (HM)')"
                                    :active="activeClass(Route::is('admin/hmlupus.*'), 'c-active')" />
                            </li>

                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                    :href="route('admin.abrlupus')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Permohonan Pelupusan (ABR)')"
                                    :active="activeClass(Route::is('admin/abrlupus.*'), 'c-active')" />
                            </li>
                        @endif

                        {{-- next menu --}}

                    </ul>
                </li>{{-- end asset --}}

                @endif
                {{-- end no 3 --}}

                {{-- no 4 --}}
                @if($logged_in_user->hasAllAccess() ||
                (
                    $logged_in_user->can('bppa') ||
                    $logged_in_user->can('atateam')
                ))
                <li class="c-sidebar-nav-dropdown">
                    <x-utils.link
                        href="#"
                        icon="c-sidebar-nav-icon fas fa-images"
                        class="c-sidebar-nav-dropdown-toggle"
                        :text="__('ASET TAK ALIH')" />

                    <ul class="c-sidebar-nav-dropdown-items">

                    @if($logged_in_user->can('bppa'))

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.kamus_ata')"
                                class="c-sidebar-nav-link"
                                :text="__('Kamus Komponen ATA')"
                                :active="activeClass(Route::is('admin/kamus_ata.*'), 'c-active')" />
                        </li>

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.asetalih')"
                                class="c-sidebar-nav-link"
                                :text="__('Senarai ATA')"
                                :active="activeClass(Route::is('admin/asetalih.*'), 'c-active')" />
                        </li>

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.atarosak')"
                                class="c-sidebar-nav-link"
                                :text="__('Senarai Aduan ATA')"
                                :active="activeClass(Route::is('admin/atarosak.*'), 'c-active')" />
                        </li>
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.strrosak')"
                                class="c-sidebar-nav-link"
                                :text="__('Senarai Aduan ATA (Struktur)')"
                                :active="activeClass(Route::is('admin/strrosak.*'), 'c-active')" />
                        </li>
                    @endif

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.atarosaktin')"
                                class="c-sidebar-nav-link"
                                :text="__('Tindakan Aduan (ATA)')"
                                :active="activeClass(Route::is('admin/atarosaktin.*'), 'c-active')" />
                        </li>

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.strrosaktin')"
                                class="c-sidebar-nav-link"
                                :text="__('Tindakan Aduan (ATA-Struktur)')"
                                :active="activeClass(Route::is('admin/strrosaktin.*'), 'c-active')" />
                        </li>
                

                        {{-- next menu --}}

                    </ul>
                </li>{{-- end asset x alih--}}

                @endif
                {{-- end no 4 --}}





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
