<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TaskFlow') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans antialiased text-slate-900">

<div class="min-h-screen">

    {{-- MOBILE HEADER --}}
    <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur lg:hidden">

        <div class="flex h-16 items-center justify-between px-4">

            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">

                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">

                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path d="M5 12l4 4L19 6"/>
                    </svg>

                </div>

                <span class="text-lg font-bold tracking-tight">
                    Task<span class="text-indigo-600">Flow</span>
                </span>

            </a>


            <div class="flex items-center gap-2">

                <span class="hidden text-sm font-medium text-slate-600 sm:block">
                    {{ Auth::user()->name }}
                </span>

                <a
                    href="{{ route('profile.edit') }}"
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700"
                >
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </a>

            </div>

        </div>

    </header>


    {{-- MAIN APP --}}
    <div class="flex min-h-screen">


        {{-- SIDEBAR --}}
        <aside class="hidden w-64 shrink-0 flex-col border-r border-slate-200 bg-white lg:flex">

            {{-- LOGO --}}
            <div class="flex h-20 items-center px-6">

                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">

                        <svg
                            class="h-6 w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M5 12l4 4L19 6"/>
                        </svg>

                    </div>


                    <div>

                        <div class="text-lg font-bold tracking-tight text-slate-900">
                            Task<span class="text-indigo-600">Flow</span>
                        </div>

                        <div class="text-xs text-slate-400">
                            Task management
                        </div>

                    </div>

                </a>

            </div>


            {{-- NAVIGATION --}}
            <nav class="flex-1 px-4 py-6">

                <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Workspace
                </p>


                <div class="space-y-1">

                    {{-- DASHBOARD --}}
                    <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                        {{ request()->routeIs('dashboard')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M3 12l9-9 9 9M5 10v10h14V10"
                            />
                        </svg>

                        Dashboard

                    </a>


                    {{-- MY TASKS --}}
                    <a
                        href="{{ route('tasks.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                        {{ request()->routeIs('tasks.index')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M9 5H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2h-4M9 5a3 3 0 016 0M9 5h6"
                            />
                        </svg>

                        My Tasks

                    </a>

                </div>


                {{-- ACCOUNT --}}
                <p class="mb-3 mt-10 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Account
                </p>


                <div class="space-y-1">

                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                        {{ request()->routeIs('profile.*')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 12a4 4 0 100-8 4 4 0 000 8zm7 8a7 7 0 00-14 0"
                            />
                        </svg>

                        Profile

                    </a>

                </div>

            </nav>


            {{-- USER AREA --}}
            <div class="border-t border-slate-200 p-4">

                <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-700">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>


                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold text-slate-900">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="truncate text-xs text-slate-500">
                            {{ Auth::user()->email }}
                        </p>

                    </div>

                </div>


                {{-- LOGOUT --}}
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="mt-3"
                >

                    @csrf

                    <button
                        type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-500 transition hover:bg-red-50 hover:text-red-600"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M15 12H3m0 0l4-4m-4 4l4 4M21 5v14a2 2 0 01-2 2h-6"
                            />
                        </svg>

                        Sign out

                    </button>

                </form>

            </div>

        </aside>


        {{-- RIGHT SIDE --}}
        <div class="flex min-w-0 flex-1 flex-col">


            {{-- DESKTOP TOP BAR --}}
            <header class="hidden h-20 items-center justify-between border-b border-slate-200 bg-white px-8 lg:flex">

                <div>

                    @isset($header)

                        {{ $header }}

                    @else

                        <h1 class="text-lg font-semibold text-slate-900">
                            TaskFlow
                        </h1>

                    @endisset

                </div>


                <div class="flex items-center gap-4">

                    {{-- NEW TASK --}}
                    <a
                        href="{{ route('tasks.create') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                        New task

                    </a>


                    {{-- PROFILE --}}
                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-200"
                    >
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </a>

                </div>

            </header>


            {{-- MOBILE NAV --}}
            <div class="border-b border-slate-200 bg-white px-4 py-3 lg:hidden">

                <div class="flex gap-2 overflow-x-auto">

                    <a
                        href="{{ route('dashboard') }}"
                        class="whitespace-nowrap rounded-lg px-3 py-2 text-sm font-medium
                        {{ request()->routeIs('dashboard')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-slate-600' }}"
                    >
                        Dashboard
                    </a>


                    <a
                        href="{{ route('tasks.index') }}"
                        class="whitespace-nowrap rounded-lg px-3 py-2 text-sm font-medium
                        {{ request()->routeIs('tasks.index')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-slate-600' }}"
                    >
                        My Tasks
                    </a>


                    <a
                        href="{{ route('tasks.create') }}"
                        class="whitespace-nowrap rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white"
                    >
                        + New task
                    </a>

                </div>

            </div>


            {{-- ⭐ AQUÍ SE MUESTRA DASHBOARD / TASKS ⭐ --}}
            <main class="flex-1">

                {{ $slot }}

            </main>


        </div>

    </div>

</div>

</body>

</html>