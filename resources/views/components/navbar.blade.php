<nav class="bg-base-100 border-base-content/20 lg:ps-75 sticky top-0 z-50 flex border">
    <div class="mx-auto w-full max-w-7xl">
        <div class="navbar py-2">
            <!-- START: Tombol Kiri -->
            <div class="navbar-start items-center gap-2">
                <!-- Toggle Sidebar -->
                <button type="button" class="btn btn-soft btn-square btn-sm lg:hidden" aria-haspopup="dialog"
                    aria-expanded="false" aria-controls="layout-sidebar" data-overlay="#layout-sidebar">
                    <span class="icon-[tabler--menu-2] size-4.5"></span>
                </button>

                <!-- Search Bar -->
                <div class="input no-focus border-0 px-0">
                    <span class="icon-[tabler--search] text-base-content/80 my-auto me-2 size-4 shrink-0"></span>
                    <input type="search" class="grow placeholder:text-sm" placeholder="Cari sesuatu..."
                        id="navbarSearch" />
                    <label class="sr-only" for="navbarSearch">Search</label>
                </div>
            </div>

            <!-- END: Navbar kanan -->
            <div class="navbar-end items-center gap-6"> <!-- ubah items-end → items-center -->

                <!-- Profile Dropdown -->
                <div class="dropdown relative inline-flex [--offset:21] items-center">
                    <button id="profile-dropdown" type="button"
                        class="dropdown-toggle avatar ring-offset-2 ring-offset-base-100 focus:outline-none"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        @php
                            $colors = [
                                '#3b82f6', // blue (primary)
                                '#8b5cf6', // purple (secondary)
                                '#14b8a6', // teal (accent)
                                '#22c55e', // green (success)
                                '#eab308', // yellow (warning)
                                '#ef4444', // red (error)
                            ];
                            $color = $colors[crc32(auth()->user()->name ?? 'user') % count($colors)];
                        @endphp

                        <div class="avatar">
                            <div class="w-10 h-10 rounded-full text-white flex items-center text-center justify-center font-semibold uppercase shadow-sm ring-1 ring-base-200"
                                style="background-color: {{ $color }}">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-open:opacity-100 max-w-75 hidden w-full space-y-0.5"
                        role="menu" aria-orientation="vertical" aria-labelledby="profile-dropdown">

                        <!-- Header -->
                        <li class="dropdown-header pt-4.5 mb-1 gap-4 px-5 pb-3.5 flex items-center">
                            <div class="avatar avatar-online-top">
                                <div class="w-10 h-10 rounded-full text-white flex items-center justify-center font-semibold uppercase"
                                    style="background-color: {{ $color }}">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                </div>
                            </div>
                            <div>
                                <h6 class="text-base-content mb-0.5 font-semibold">
                                    {{ auth()->user()->name ?? 'User' }}
                                </h6>
                            </div>
                        </li>

                        {{-- <li>
                            <a class="dropdown-item px-3" href="#">
                                <span class="icon-[tabler--user] size-5"></span>
                                Profil Saya
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="#">
                                <span class="icon-[tabler--settings] size-5"></span>
                                Pengaturan
                            </a>
                        </li> --}}


                        <!-- Logout -->
                        <li class="dropdown-footer p-2 pt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-text btn-error btn-block h-11 justify-start px-3 font-normal">
                                    <span class="icon-[tabler--logout] size-5"></span>
                                    Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</nav>
