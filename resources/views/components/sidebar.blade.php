<aside id="layout-sidebar"
    class="overlay overlay-open:translate-x-0 drawer drawer-start sm:w-75 inset-y-0 start-0 hidden h-full
           [--auto-close:lg] lg:z-50 lg:block lg:translate-x-0 lg:shadow-none"
    aria-label="Sidebar" tabindex="-1">

    <div class="drawer-body border-base-content/20 h-full border-e p-0">
        <div class="flex h-full max-h-full flex-col">

            <!-- Tombol Close -->
            <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3 lg:hidden" aria-label="Close"
                data-overlay="#layout-sidebar">
                <span class="icon-[tabler--x] size-4.5"></span>
            </button>

            <!-- Profil -->
            <!-- Profil -->
            <div class="text-base-content border-base-content/20 flex items-center gap-3 border-b px-4 py-4">
                <!-- Avatar -->
                <div class="avatar shrink-0">
                    <div class="size-8 rounded-full">
                        <img src="{{ asset('template/assets/img/avatars/2.png') }}" alt="avatar" />
                    </div>
                </div>

                <!-- Nama dan Email -->
                <div class="flex flex-col overflow-hidden">
                    <h3 class="text-base-content text-sm font-semibold truncate max-w-[140px]">
                        {{ auth()->user()->name ?? 'Mitchell Johnson' }}
                    </h3>
                    <p class="text-base-content/80 text-xs truncate max-w-[140px]">
                        {{ auth()->user()->email ?? 'flyonui@mitchell' }}
                    </p>
                </div>
            </div>


            <!-- Menu -->
            <div class="h-full overflow-y-auto">
                <ul class="accordion menu menu-sm gap-1 p-3">

                    {{-- Dashboard --}}
                    <li class="accordion-item">
                        <button
                            class="accordion-toggle accordion-item-active:bg-neutral/10 inline-flex w-full items-center p-2 text-start text-sm font-normal"
                            aria-controls="dashboard-collapse" aria-expanded="true">
                            <span class="icon-[tabler--dashboard] size-4.5"></span>
                            <span class="grow">Dashboard</span>
                            <span
                                class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-4.5 shrink-0 transition-transform"></span>
                        </button>

                        <div id="dashboard-collapse" class="accordion-content mt-1 block">
                            <ul class="space-y-1">
                                <li>
                                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                        <span>Default</span>
                                    </x-nav-link>
                                </li>
                                <li>
                                    <x-nav-link
                                        href="https://demos.flyonui.com/templates/html/dashboard-default/common-dashboard.html"
                                        target="_blank">
                                        <span>Analytics</span>
                                        <span class="badge badge-primary badge-sm badge-soft">Pro</span>
                                    </x-nav-link>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Section Divider -->
                    <li
                        class="text-base-content/50 before:bg-base-content/20 mt-2 p-2 text-xs uppercase
                     before:absolute before:-start-3 before:top-1/2 before:h-0.5 before:w-2.5">
                        Pages
                    </li>

                    {{-- Account Setting --}}
                    <li class="accordion-item">
                        <button
                            class="accordion-toggle accordion-item-active:bg-neutral/10 inline-flex w-full items-center p-2 text-start text-sm font-normal"
                            aria-controls="account-settings-collapse" aria-expanded="false">
                            <span class="icon-[tabler--settings] size-4.5"></span>
                            <span class="grow">Account Setting</span>
                            <span
                                class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-4.5 shrink-0 transition-transform"></span>
                        </button>
                        <div id="account-settings-collapse" class="accordion-content mt-1 hidden">
                            <ul class="space-y-1">
                                {{-- <li>
                                    <x-nav-link :href="route('account')" :active="request()->routeIs('account')">
                                        <span>Account</span>
                                    </x-nav-link>
                                </li>
                                <li>
                                    <x-nav-link :href="route('notifications')" :active="request()->routeIs('notifications')">
                                        <span>Notifications</span>
                                    </x-nav-link>
                                </li> --}}
                            </ul>
                        </div>
                    </li>


                    {{-- <li>
                        <x-nav-link :href="route('faq')" :active="request()->routeIs('faq')">
                            <span class="icon-[tabler--help] size-4.5"></span>
                            <span class="grow">FAQ</span>
                        </x-nav-link>
                    </li>


                    <li>
                        <x-nav-link :href="route('pricing')" :active="request()->routeIs('pricing')">
                            <span class="icon-[tabler--currency-dollar] size-4.5"></span>
                            <span class="grow">Pricing</span>
                        </x-nav-link>
                    </li> --}}

                </ul>
            </div>


        </div>
    </div>
</aside>
