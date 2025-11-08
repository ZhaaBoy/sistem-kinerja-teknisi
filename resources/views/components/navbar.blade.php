<nav class="bg-base-100 border-base-content/20 lg:ps-75 sticky top-0 z-50 flex border">
    <div class="mx-auto w-full max-w-7xl">
        <div class="navbar py-2">
            <div class="navbar-start items-center gap-2">
                <button type="button" class="btn btn-soft btn-square btn-sm lg:hidden" aria-haspopup="dialog"
                    aria-expanded="false" aria-controls="layout-sidebar" data-overlay="#layout-sidebar">
                    <span class="icon-[tabler--menu-2] size-4.5"></span>
                </button>
                <div class="input no-focus border-0 px-0">
                    <span class="icon-[tabler--search] text-base-content/80 my-auto me-2 size-4 shrink-0"></span>
                    <input type="search" class="grow placeholder:text-sm" placeholder="Type to Search..."
                        id="kbdInput" />
                </div>
            </div>
            <div class="navbar-end items-end gap-6">
                <div class="dropdown relative inline-flex [--offset:21]">
                    <button id="profile-dropdown" type="button" class="dropdown-toggle avatar">
                        <span class="rounded-field size-9.5">
                            <img src="{{ asset('template/assets/img/avatars/2.png') }}" alt="User Avatar" />
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>
