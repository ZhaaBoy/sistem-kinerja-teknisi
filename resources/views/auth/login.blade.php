<!doctype html>
<html lang="en" data-theme="light" data-assets-path="{{ asset('template/assets') }}/"
    data-layout-path="dashboard-free/" dir="ltr" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Login | PT. Complus System</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('template/assets/dist/css/output.css') }}" />
</head>

<body>
    <div class="flex h-auto min-h-screen items-center justify-center overflow-x-hidden bg-cover bg-center bg-no-repeat py-10"
        style="background-image: url('{{ asset('template/assets/img/illustrations/auth-background-2.png') }}');">

        <div class="relative flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div
                class="bg-base-100 shadow-base-300/20 z-1 sm:min-w-md w-full space-y-6 rounded-xl p-6 shadow-md lg:p-8">

                <div class="flex flex-col items-center justify-center text-center mb-4">
                    <img src="{{ asset('logo.png') }}" alt="Logo" width="120" height="120"
                        class=" w-24 h-24 object-contain">
                    <h2 class="text-base-content text-2xl font-semibold">PT. Complus Sistem Solusi</h2>
                </div>


                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="space-y-4">
                    {{-- <h3 class="text-base-content mb-1.5 text-lg font-semibold">Sign in</h3> --}}
                    {{-- ✅ FORM LOGIN --}}
                    <form class="mb-4 space-y-4" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div>
                            <label class="label-text" for="userEmail">Email address*</label>
                            <input type="email" name="email" placeholder="Enter your email address"
                                class="input w-full" id="userEmail" required autofocus />
                        </div>
                        <div>
                            <label class="label-text" for="userPassword">Password*</label>
                            <div class="input">
                                <input id="userPassword" type="password" name="password" placeholder="············"
                                    required />
                                <button type="button" data-toggle-password='{ "target": "#userPassword" }'
                                    class="block cursor-pointer" aria-label="userPassword">
                                    <span
                                        class="icon-[tabler--eye] password-active:block hidden size-5 shrink-0"></span>
                                    <span
                                        class="icon-[tabler--eye-off] password-active:hidden block size-5 shrink-0"></span>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-y-2">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" id="rememberMe"
                                    name="remember" />
                                <label class="label-text text-base-content/80 p-0 text-base" for="rememberMe">Remember
                                    Me</label>
                            </div>
                        </div>

                        <button class="btn btn-lg btn-primary btn-gradient btn-block" type="submit">
                            Sign in
                        </button>
                    </form>

                    <p class="text-base-content/80 mb-4 text-center">
                        Belum punya akun?
                        <a href="#" class="link link-animated link-primary font-normal">Hubungi Administrator</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/assets/dist/libs/flyonui/flyonui.js') }}"></script>
    <script src="{{ asset('template/assets/dist/js/theme-utils.js') }}"></script>
    <script src="{{ asset('template/assets/dist/js/main.js') }}"></script>
</body>

</html>
