<div>
    <div
        class="relative z-50"
        role="dialog"
        aria-modal="true"
        @close.stop="isOpen = false"
        @keydown.escape.window="isOpen = false"
        @keydown.window.prevent.cmd.k="toggleOpen()"
        @keydown.window.prevent.cmd.slash="toggleOpen()"
        @keydown.window.prevent.ctrl.k="toggleOpen()"
        @keydown.window.prevent.ctrl.slash="toggleOpen()"
        @toggle-spotlight.window="toggleOpen()"
        x-cloak
        x-data="Spotlight({
            componentId: '{{ $this->id }}',
            placeholder: '{{ trans('livewire-ui-spotlight::spotlight.placeholder') }}',
            commands: @js($commands),
            showResultsWithoutInput: '{{ config('livewire-ui-spotlight.show_results_without_input') }}',
        })"
        x-init="init()"
        x-show="isOpen"
    >
        <div
            class="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity"
            @click="toggleOpen()"
            x-show="isOpen"
            x-transition:enter-end="opacity-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter="ease-out duration-300"
            x-transition:leave-end="opacity-0"
            x-transition:leave-start="opacity-100"
            x-transition:leave="ease-in duration-200"
        ></div>

        <div class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 md:p-20">
            <div
                class="mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all"
                @click.away="isOpen = false"
                @close.stop="isOpen = false"
                x-show="isOpen"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter="transition ease-out duration-200"
                x-transition:leave-end="transform opacity-0 scale-95"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
            >
                <div class="relative">
                    <x-heroicons:outline-magnifying-glass
                        class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-gray-400"
                    />

                    <input
                        class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
                        type="text"
                        role="combobox"
                        aria-controls="options"
                        aria-expanded="false"
                        placeholder="Search..."
                        wire:model="searchQuery"
                        @keydown.tab.prevent=""
                        @keydown.prevent.stop.enter="executeCommand()"
                        @keydown.prevent.arrow-up="goToPrevious()"
                        @keydown.prevent.arrow-down="goToNext()"
                        x-ref="input"
                    >
                </div>

                @if ($command)
                    {!! $command !!}
                @elseif ($commands->isNotEmpty())
                    <ul
                        class="max-h-96 scroll-py-3 overflow-y-auto p-3"
                        role="listbox"
                        x-ref="results"
                    >
                        @foreach ($commands as $command)
                            <li
                                class="group flex cursor-default select-none rounded-xl p-3 hover:bg-gray-100"
                                role="option"
                                tabindex="-1"
                                wire:key="{{ $command->getId() }}"
                                wire:click="executeCommand('{{ $command->getId() }}')"
                            >
                                <div
                                    class="bg-{{ $command->getIconColor() }}-500 flex h-10 w-10 flex-none items-center justify-center rounded-lg">
                                    <x-dynamic-component
                                        class="h-6 w-6 text-white"
                                        :component="$command->getIcon()"
                                    />
                                </div>

                                <div class="ml-4 flex-auto">
                                    <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                                        {{ $command->getName() }}
                                    </p>

                                    <p class="text-sm text-gray-500 group-hover:text-gray-700">
                                        {{ $command->getDescription() }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="px-6 py-14 text-center text-sm sm:px-14">
                        <svg
                            class="mx-auto h-6 w-6 text-gray-400"
                            aria-hidden="true"
                            fill="none"
                            stroke-width="1.5"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <p class="mt-4 font-semibold text-gray-900">No results found</p>
                        <p class="mt-2 text-gray-500">No components found for this search term. Please try again.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @include('livewire-spotlight::scripts')
@endpush
