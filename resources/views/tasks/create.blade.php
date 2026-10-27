<x-app-layout>
    <div class="min-h-screen bg-slate-950">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-3xl">

                {{-- Header --}}
                <div class="mb-8">
                    <p class="text-sm text-slate-400">
                        Tasks
                    </p>

                    <h1 class="mt-1 text-3xl font-bold text-white">
                        Create New Task
                    </h1>

                    <p class="mt-2 text-slate-400">
                        Add a new task to your workspace.
                    </p>
                </div>

                {{-- Form --}}
                <div class="rounded-2xl border border-white/10 bg-slate-900 p-6">

                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        {{-- Title --}}
                        <div>
                            <label
                                for="title"
                                class="text-sm font-medium text-slate-300"
                            >
                                Task title
                            </label>

                            <input
                                id="title"
                                name="title"
                                type="text"
                                value="{{ old('title') }}"
                                placeholder="e.g. Finish portfolio website"
                                required
                                class="mt-2 w-full rounded-xl border border-white/10 bg-slate-950 px-4 py-3 text-white outline-none placeholder:text-slate-600 focus:border-indigo-500"
                            >

                            @error('title')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mt-6">
                            <label
                                for="description"
                                class="text-sm font-medium text-slate-300"
                            >
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Describe what needs to be done..."
                                class="mt-2 w-full resize-none rounded-xl border border-white/10 bg-slate-950 px-4 py-3 text-white outline-none placeholder:text-slate-600 focus:border-indigo-500"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Priority and Due Date --}}
                        <div class="mt-6 grid gap-6 sm:grid-cols-2">

                            {{-- Priority --}}
                            <div>
                                <label
                                    for="priority"
                                    class="text-sm font-medium text-slate-300"
                                >
                                    Priority
                                </label>

                                <select
                                    id="priority"
                                    name="priority"
                                    class="mt-2 w-full rounded-xl border border-white/10 bg-slate-950 px-4 py-3 text-white outline-none focus:border-indigo-500"
                                >
                                    <option
                                        value="low"
                                        {{ old('priority', 'medium') === 'low' ? 'selected' : '' }}
                                    >
                                        Low
                                    </option>

                                    <option
                                        value="medium"
                                        {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}
                                    >
                                        Medium
                                    </option>

                                    <option
                                        value="high"
                                        {{ old('priority', 'medium') === 'high' ? 'selected' : '' }}
                                    >
                                        High
                                    </option>
                                </select>

                                @error('priority')
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Due Date --}}
                            <div>
                                <label
                                    for="due_date"
                                    class="text-sm font-medium text-slate-300"
                                >
                                    Due date
                                </label>

                                <input
                                    id="due_date"
                                    name="due_date"
                                    type="date"
                                    value="{{ old('due_date') }}"
                                    class="mt-2 w-full rounded-xl border border-white/10 bg-slate-950 px-4 py-3 text-white outline-none focus:border-indigo-500"
                                >

                                @error('due_date')
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="mt-8 flex items-center justify-end gap-3">

                            <a
                                href="{{ route('dashboard') }}"
                                class="rounded-xl px-5 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="rounded-xl bg-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-400"
                            >
                                Create Task
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>