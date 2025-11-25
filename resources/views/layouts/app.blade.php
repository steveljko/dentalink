<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'DentaLink')</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
            rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    </head>

    <body hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}' class="bg-base-100">
        <x-htmx-error-handler />

        <dialog id="dialog" class="modal" role="dialog" hx-target="this"></dialog>

        <div class="drawer lg:drawer-open">
            <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <nav class="navbar pl-4 pr-6 bg-base-200 min-h-0 h-16">
                    <div class="flex-1">
                        <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="inline-block size-5">
                                <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                <path d="M9 4v16"></path>
                                <path d="M14 10l2 2l-2 2"></path>
                            </svg>
                        </label>
                        <span class="ml-2 text-base font-semibold">@yield('page')</span>
                    </div>

                    <div class="flex-none">
                        <div class="flex items-center gap-5">
                            <div class="dropdown dropdown-end">
                                <input
                                    type="text"
                                    placeholder="Pretraži pacijente..."
                                    class="input input-bordered input-sm w-32 md:w-64"
                                    id="patientSearch"
                                    autocomplete="off"
                                />
                                <ul class="dropdown-content menu bg-base-100 rounded-box z-[1] w-full p-2 shadow max-h-80 overflow-y-auto" id="searchSuggestions">
                                    <li>
                                        <a href="/patient/1" class="flex items-center justify-between hover:bg-base-200">
                                            <div class="flex items-center gap-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <div class="flex flex-col items-start">
                                                    <span class="font-medium">Miloš Savić</span>
                                                    <span class="text-xs text-base-content/60">Br. kartona: 123</span>
                                                </div>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </li>
                                    <div class="divider my-1"></div>
                                    <li>
                                        <a href="/patients" class="text-center text-primary hover:bg-primary/10">
                                            <span class="font-medium">Prikaži sve pacijente</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="dropdown dropdown-end">
                                <div tabindex="0" role="button" class="btn btn-ghost btn-circle btn-sm avatar">
                                    <div class="w-8 rounded-full">
                                        <img
                                            alt="User Avatar"
                                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                    </div>
                                </div>
                                <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                                    <li class="menu-title">
                                        <span>{{ auth()->user()->name }}</span>
                                    </li>
                                    <li>
                                        <a href="#" class="justify-between">
                                            <span>Profil</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="justify-between">
                                            <span>Podešavanja</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <div class="divider my-1"></div>
                                    <li>
                                        <a class="justify-between text-error" hx-delete="{{ route('logout') }}">
                                            <span>Odjavi se</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="p-6">@yield('content')</div>
            </div>

            <div class="drawer-side is-drawer-close:overflow-visible">
                <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
                <div class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
                    <ul class="menu w-full grow">
                        <li>
                            <a href="{{ route('dashboard') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Kontrolna tabla">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>

                                <span class="is-drawer-close:hidden">Kontrolna tabla</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('patient.index') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Pacijenti">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 my-1.5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="is-drawer-close:hidden">Pacijenti</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('appointment.index') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Zakazivanja">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 my-1.5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="is-drawer-close:hidden">Zakazivanja</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <script>
        window.userId = {{ auth()->id() ?? 'null' }};
        </script>
    </body>

</html>
