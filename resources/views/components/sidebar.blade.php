<aside id="layout-sidebar"
    class="overlay overlay-open:translate-x-0 drawer drawer-start sm:w-75 inset-y-0 start-0 hidden h-full
           [--auto-close:lg] lg:z-50 lg:block lg:translate-x-0 lg:shadow-none"
    aria-label="Sidebar" tabindex="-1">

    <div class="drawer-body border-base-content/20 h-full border-e p-0">
        <div class="flex h-full max-h-full flex-col">

            <!-- Tombol Close -->
            <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3 lg:hidden" aria-label="Close"
                data-overlay="#layout-sidebar">
                <i class="close icon text-lg"></i>
            </button>

            <!-- Profil -->
            <div class="text-base-content border-base-content/20 flex items-center gap-3 border-b px-4 py-4">
                <div class="avatar shrink-0">
                    <div class="size-8 rounded-full">
                        <img src="{{ asset('template/assets/img/avatars/2.png') }}" alt="avatar" />
                    </div>
                </div>
                <div class="flex flex-col overflow-hidden">
                    <h3 class="text-sm font-semibold truncate max-w-[140px]">
                        {{ auth()->user()->name ?? 'User' }}
                    </h3>
                    <p class="text-xs text-base-content/70 truncate max-w-[140px]">
                        {{ auth()->user()->email ?? 'email@domain.com' }}
                    </p>
                </div>
            </div>

            <!-- Menu -->
            <div class="flex flex-col h-full">
                <div class="flex-1 overflow-y-auto">
                    <ul class="accordion menu menu-sm gap-1 p-3">

                        {{-- DASHBOARD (untuk semua role) --}}
                        <li>
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                <span class="icon-[tabler--dashboard] size-4.5"></span>
                                <span class="grow">Dashboard</span>
                            </x-nav-link>
                        </li>

                        {{-- ROLE ADMIN --}}
                        @if (auth()->user()->role === 'admin')
                            <li>
                                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                                    <span class="icon-[tabler--user] size-4.5"></span>
                                    <span class="grow">Kelola User</span>
                                </x-nav-link>
                            </li>
                        @endif

                        {{-- ROLE KEPALA GUDANG --}}
                        @if (auth()->user()->role === 'kepala_gudang')
                            <li>
                                <x-nav-link :href="route('penugasan-enrollment.index')" :active="request()->routeIs('penugasan-enrollment.*')">
                                    <span class="icon-[tabler--checklist] size-4.5"></span>
                                    <span class="grow">Penugasan Enrollment</span>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link :href="route('penugasan-pengiriman.index')" :active="request()->routeIs('penugasan-pengiriman.*')">
                                    <i class="truck icon"></i>
                                    <span class="grow">Pengiriman Barang</span>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link href="{{ route('laporan-enrollment.index') }}" :active="request()->routeIs('laporan-enrollment.*')">

                                    <span class="icon-[tabler--table] size-4.5"></span>
                                    <span class="grow">Laporan Enrollment</span>
                                </x-nav-link>
                            </li>
                        @endif

                        {{-- ROLE TEKNISI --}}
                        @if (auth()->user()->role === 'teknisi')
                            <li>
                                <x-nav-link :href="route('penugasan-enrollment.index')" :active="request()->routeIs('penugasan-enrollment.*')">
                                    <span class="icon-[tabler--checklist] size-4.5"></span>
                                    <span class="grow">Penugasan Enrollment</span>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link :href="route('hasil-enrollment.index')" :active="request()->routeIs('hasil-enrollment.*')">
                                    <span class="icon-[tabler--layout-grid] size-4.5"></span>
                                    <span class="grow">Hasil Enrollment</span>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link href="{{ route('laporan-enrollment.index') }}" :active="request()->routeIs('laporan-enrollment.*')">

                                    <span class="icon-[tabler--table] size-4.5"></span>
                                    <span class="grow">Laporan Enrollment</span>
                                </x-nav-link>
                            </li>
                        @endif

                        {{-- ROLE HELPER --}}
                        @if (auth()->user()->role === 'helper')
                            <li>
                                <x-nav-link href="{{ route('laporan-enrollment.index') }}" :active="request()->routeIs('laporan-enrollment.*')">
                                    <span class="icon-[tabler--table] size-4.5"></span>
                                    <span class="grow">Laporan Enrollment</span>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link :href="route('penugasan-enrollment.index')" :active="request()->routeIs('penugasan-enrollment.*')">
                                    <span class="icon-[tabler--checklist] size-4.5"></span> <span
                                        class="grow">Penugasan Enrollment</span>
                                </x-nav-link>
                            </li>
                        @endif

                    </ul>
                </div>

                <!-- Tombol Logout di bawah -->
                <div class="border-t border-base-content/20 p-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-error btn-block flex items-center justify-center gap-2">
                            <i class="sign-out icon"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</aside>
