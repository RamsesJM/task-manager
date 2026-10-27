<x-app-layout>

    @php
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('completed', true)->count();
        $pendingTasks = $tasks->where('completed', false)->count();

        $hasFilters =
            request('search') ||
            request('status') ||
            (request('priority') && request('priority') !== 'all');
    @endphp

    <div class="min-h-screen bg-slate-50">

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-indigo-600"></span>

                        <span class="text-sm font-semibold text-indigo-600">
                            Workspace
                        </span>
                    </div>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                        Mis tareas
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Administra, organiza y realiza seguimiento de tus tareas.
                    </p>

                </div>


                <a
                    href="{{ route('tasks.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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
                            stroke-width="2"
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Nueva tarea

                </a>

            </div>


            {{-- SUMMARY --}}
            <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-3">


                {{-- TOTAL --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Total
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                {{ $totalTasks }}
                            </p>

                        </div>


                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

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

                        </div>

                    </div>

                </div>


                {{-- PENDING --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Pendientes
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight text-amber-500">
                                {{ $pendingTasks }}
                            </p>

                        </div>


                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

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
                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="mt-4 text-xs text-slate-400">
                        Tareas pendientes de completar
                    </p>

                </div>


                {{-- COMPLETED --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Completadas
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight text-emerald-600">
                                {{ $completedTasks }}
                            </p>

                        </div>


                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="mt-4 text-xs text-slate-400">
                        Tareas finalizadas
                    </p>

                </div>

            </div>


            {{-- SEARCH AND FILTERS --}}
            <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="mb-5">

                    <h2 class="text-base font-semibold text-slate-900">
                        Buscar y filtrar
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Encuentra rápidamente una tarea.
                    </p>

                </div>


                <form
                    method="GET"
                    action="{{ route('tasks.index') }}"
                    class="grid grid-cols-1 gap-4 md:grid-cols-4"
                >

                    {{-- SEARCH --}}
                    <div class="md:col-span-2">

                        <label
                            for="search"
                            class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500"
                        >
                            Buscar
                        </label>


                        <div class="relative">

                            <svg
                                class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                />
                            </svg>


                            <input
                                id="search"
                                name="search"
                                type="text"
                                value="{{ request('search') }}"
                                placeholder="Buscar por título o descripción..."
                                class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                            >

                        </div>

                    </div>


                    {{-- STATUS --}}
                    <div>

                        <label
                            for="status"
                            class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500"
                        >
                            Estado
                        </label>


                        <select
                            id="status"
                            name="status"
                            class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                        >

                            <option value="">
                                Todos
                            </option>

                            <option
                                value="pending"
                                @selected(request('status') === 'pending')
                            >
                                Pendientes
                            </option>

                            <option
                                value="completed"
                                @selected(request('status') === 'completed')
                            >
                                Completadas
                            </option>

                        </select>

                    </div>


                    {{-- PRIORITY --}}
                    <div>

                        <label
                            for="priority"
                            class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500"
                        >
                            Prioridad
                        </label>


                        <select
                            id="priority"
                            name="priority"
                            class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                        >

                            <option value="all">
                                Todas
                            </option>

                            <option
                                value="high"
                                @selected(request('priority') === 'high')
                            >
                                Alta
                            </option>

                            <option
                                value="medium"
                                @selected(request('priority') === 'medium')
                            >
                                Media
                            </option>

                            <option
                                value="low"
                                @selected(request('priority') === 'low')
                            >
                                Baja
                            </option>

                        </select>

                    </div>


                    {{-- FILTER BUTTONS --}}
                    <div class="flex flex-col gap-2 md:col-span-4 sm:flex-row sm:justify-end">

                        @if ($hasFilters)

                            <a
                                href="{{ route('tasks.index') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                            >
                                Limpiar filtros
                            </a>

                        @endif


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2"
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
                                    d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                />
                            </svg>

                            Aplicar filtros

                        </button>

                    </div>

                </form>

            </div>


            {{-- TASK LIST --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


                {{-- LIST HEADER --}}
                <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                    <div>

                        <div class="flex items-center gap-3">

                            <h2 class="text-lg font-bold text-slate-900">
                                Todas las tareas
                            </h2>

                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                {{ $totalTasks }}
                            </span>

                        </div>

                        <p class="mt-1 text-sm text-slate-500">
                            Tu lista completa de tareas.
                        </p>

                    </div>

                </div>


                {{-- TASKS --}}
                @if ($tasks->count() > 0)

                    <div class="divide-y divide-slate-100">

                        @foreach ($tasks as $task)

                            <div class="px-5 py-5 transition hover:bg-slate-50 sm:px-6">

                                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">


                                    {{-- TASK INFORMATION --}}
                                    <div class="min-w-0 flex-1">

                                        <div class="flex items-start gap-3">


                                            {{-- TOGGLE --}}
                                            <form
                                                method="POST"
                                                action="{{ route('tasks.toggle', $task) }}"
                                                class="mt-0.5 shrink-0"
                                            >

                                                @csrf
                                                @method('PATCH')


                                                @if ($task->completed)

                                                    <button
                                                        type="submit"
                                                        title="Reabrir tarea"
                                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition hover:bg-emerald-100"
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
                                                                stroke-width="2.5"
                                                                d="M5 13l4 4L19 7"
                                                            />
                                                        </svg>

                                                    </button>

                                                @else

                                                    <button
                                                        type="submit"
                                                        title="Completar tarea"
                                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-400 transition hover:bg-indigo-50 hover:text-indigo-600"
                                                    >

                                                        <span class="h-4 w-4 rounded-full border-2 border-current"></span>

                                                    </button>

                                                @endif

                                            </form>


                                            {{-- CONTENT --}}
                                            <div class="min-w-0 flex-1">


                                                {{-- TITLE --}}
                                                @if ($task->completed)

                                                    <h3 class="truncate text-base font-semibold text-slate-400 line-through">
                                                        {{ $task->title }}
                                                    </h3>

                                                @else

                                                    <h3 class="truncate text-base font-semibold text-slate-900">
                                                        {{ $task->title }}
                                                    </h3>

                                                @endif


                                                {{-- DESCRIPTION --}}
                                                @if ($task->description)

                                                    <p class="mt-1 line-clamp-2 text-sm text-slate-500">
                                                        {{ $task->description }}
                                                    </p>

                                                @endif


                                                {{-- METADATA --}}
                                                <div class="mt-3 flex flex-wrap items-center gap-2">


                                                    {{-- PRIORITY --}}
                                                    @if ($task->priority === 'high')

                                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-600">
                                                            <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                                            Alta
                                                        </span>

                                                    @elseif ($task->priority === 'medium')

                                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-600">
                                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                            Media
                                                        </span>

                                                    @else

                                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">
                                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                            Baja
                                                        </span>

                                                    @endif


                                                    {{-- STATUS --}}
                                                    @if ($task->completed)

                                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">

                                                            <svg
                                                                class="h-3 w-3"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M5 13l4 4L19 7"
                                                                />
                                                            </svg>

                                                            Completada

                                                        </span>

                                                    @else

                                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">
                                                            Pendiente
                                                        </span>

                                                    @endif


                                                    {{-- DUE DATE --}}
                                                    @if ($task->due_date)

                                                        <span class="inline-flex items-center gap-1.5 text-xs text-slate-400">

                                                            <svg
                                                                class="h-3.5 w-3.5"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="1.8"
                                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                                />
                                                            </svg>

                                                            {{ $task->due_date->format('d/m/Y') }}

                                                        </span>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                    </div>


                                    {{-- ACTIONS --}}
                                    <div class="flex shrink-0 items-center gap-2 pl-12 lg:pl-0">


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('tasks.edit', $task) }}"
                                            title="Editar tarea"
                                            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600"
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
                                                    stroke-width="1.8"
                                                    d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.25 18.463 4 19.75l1.287-4.25L16.862 3.487z"
                                                />
                                            </svg>

                                            Editar

                                        </a>


                                        {{-- DELETE --}}
                                        <form
                                            method="POST"
                                            action="{{ route('tasks.destroy', $task) }}"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Eliminar tarea"
                                                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600"
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
                                                        stroke-width="1.8"
                                                        d="M6 7h12M10 11v6M14 11v6M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m3 0v12a1 1 0 01-1 1H7a1 1 0 01-1-1V7h12z"
                                                    />
                                                </svg>

                                                Eliminar

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>


                {{-- EMPTY STATE --}}
                @else

                    <div class="px-6 py-20 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">

                            <svg
                                class="h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 12l2 2 4-4m5-3.5A8.5 8.5 0 0112 21a8.5 8.5 0 01-8.5-8.5A8.5 8.5 0 0112 4a8.5 8.5 0 018 5.5z"
                                />
                            </svg>

                        </div>


                        <h3 class="mt-5 text-lg font-bold text-slate-900">
                            No se encontraron tareas
                        </h3>


                        @if ($hasFilters)

                            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                                No hay tareas que coincidan con los filtros seleccionados.
                            </p>


                            <a
                                href="{{ route('tasks.index') }}"
                                class="mt-6 inline-flex items-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                            >
                                Limpiar filtros
                            </a>

                        @else

                            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                                Todavía no tienes tareas. Crea tu primera tarea para comenzar.
                            </p>


                            <a
                                href="{{ route('tasks.create') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
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

                                Crear primera tarea

                            </a>

                        @endif

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>