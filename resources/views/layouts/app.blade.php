<!doctype html>
<html lang="en" data-theme="light" dir="ltr" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/dist/libs/apexcharts/dist/apexcharts.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/dist/libs/flyonui/src/vendor/apexcharts.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/dist/css/output.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/icon/tabler-icons/tabler-icons.min.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui-icon@2.4.2/icon.min.css">
    @stack('styles')
</head>

<body>
    <div class="bg-base-200 flex min-h-screen flex-col">
        {{-- ✅ Alert Global (akan muncul di pojok kanan atas) --}}
        @if (session('message'))
            <x-alert :type="session('type', 'success')" :message="session('message')" toast />
        @endif
        <!-- Header -->
        <x-navbar />

        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="lg:ps-75 flex grow flex-col">
            <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">
                @yield('content')
            </main>

            <footer class="mx-auto w-full max-w-[1280px] px-6 py-3.5 text-sm">
                <div class="flex items-center justify-between gap-3 max-lg:flex-col">
                    <p class="text-base-content text-center">
                        &copy; {{ date('Y') }} <a href="https://flyonui.com/" class="text-primary">ZhaaStore</a>,
                        Chamber Of Secret Team.
                    </p>
                    <div class="justify-enter flex items-center gap-4 max-sm:flex-col">
                        <a href="#" class="link link-primary link-animated font-normal">Linkedin</a>
                        <a href="#" class="link link-primary link-animated font-normal">Github</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('message'))
        <script>
            Swal.fire({
                icon: '{{ session('type') ?? 'info' }}', // success, error, info, warning
                title: '{{ ucfirst(session('type') ?? 'Info') }}',
                text: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        </script>
    @endif
    <script>
        document.addEventListener('alpine:init', () => {
            window.addEventListener('notify', event => {
                const {
                    type,
                    message
                } = event.detail
                const container = document.createElement('div')
                container.innerHTML = `
            <div x-data="{ show: true }" x-show="show" x-transition
                class="fixed top-4 right-4 z-[9999] bg-${type === 'error' ? 'red' : type === 'success' ? 'green' : 'blue'}-600 text-white rounded-lg shadow-lg flex items-center gap-3 p-4">
                <span>${message}</span>
                <button x-on:click="show = false" class="ml-2 hover:text-gray-200">
                    <span class='icon-[tabler--x] text-lg'></span>
                </button>
            </div>
        `
                document.body.appendChild(container)
                Alpine.initTree(container) // aktifkan Alpine di node baru
                setTimeout(() => container.remove(), 3000) // auto-hide
            })
        })
    </script>

    <script src="{{ asset('template/assets/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/assets/dist/libs/flyonui/flyonui.js') }}"></script>
    <script src="{{ asset('template/assets/dist/js/main.js') }}"></script>
    <script src="{{ asset('template/assets/dist/libs/flyonui/dist/helper-apexcharts.js') }}"></script>
    <script src="{{ asset('template/assets/dist/libs/flyonui/flyonui.js') }}"></script>
    <script src="{{ asset('template/assets/dist/js/theme-utils.js') }}"></script>
    <script src="{{ asset('template/assets/dist/js/main.js') }}"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    @stack('scripts')

</body>

</html>
