<div>
    <div x-data="{
        open: @entangle('showDropdown'),
        search: @entangle('search'),
        selected: @entangle('selected'),
        highlightedIndex: 0,
        highlightPrevious() {
            if (this.highlightedIndex > 0) {
                this.highlightedIndex = this.highlightedIndex - 1;
                this.scrollIntoView();
            }
        },
        highlightNext() {
            if (this.highlightedIndex < this.$refs.results.children.length - 1) {
                this.highlightedIndex = this.highlightedIndex + 1;
                this.scrollIntoView();
            }
        },
        updateSelected(id, name) {
            this.selected = id;
            this.search = name;
            this.open = false;
            this.highlightedIndex = 0;
        },
        reset() {
            this.selected = '';
            this.search = '';
            this.open = false;
            this.highlightedIndex = 0;
        },
        scrollIntoView() {
            this.$refs.results.children[this.highlightedIndex].scrollIntoView({
                block: 'nearest',
                behavior: 'smooth'
            });
        },
    }" class="space-y-1">
        <div class="js-focus-state {{ $placement == 'home' ? '' : 'd-none' }}">
            <label class="sr-only" for="searchproduct">Search</label>
            <div class="input-group" x-on:value-selected="updateSelected($event.detail.id, $event.detail.name)">
                <div class="flex-fill position-relative">
                    <input type="search"
                        class="form-control py-2 pl-5 font-size-15 border-right-0 height-40 border-width-2 rounded-left-pill border-primary"
                        id="searchproduct-item" placeholder="Search for Products"
                        wire:model.live.debounce.300ms="search" x-on:keydown.arrow-down.stop.prevent="highlightNext()"
                        x-on:keydown.arrow-up.stop.prevent="highlightPrevious()"
                        x-on:keydown.enter.stop.prevent="(!$refs.input.text) ? $dispatch('value-selected', {
                            name: $refs.results.children[highlightedIndex].getAttribute('data-result-name')
                        }) : ''">

                    <div x-show="open" x-on:click.away="open = false" x-transition:enter="" x-transition:enter-start=""
                        x-transition:enter-end="" x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="bg-white card ml-5 mt-1 position-absolute shadow-lg"
                        style="width: 96% !important;z-index: 999999;">
                        <ul x-ref="results" tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                            aria-activedescendant="listbox-item-3" class="py-1 pl-0 mb-0" style="list-style: none;">
                            @forelse($results as $index => $result)
                                <li wire:key="{{ $index }}" data-result-name="{{ $result }}"
                                    x-on:click.stop="$dispatch('value-selected', {
                                    name: '{{ addslashes($result) }}'
                                })"
                                    class="relative py-2 pl-5 cursor-pointer-on custom-menu-item"
                                    :class="{
                                        'bg-indigo-400': {{ $index }} === highlightedIndex
                                    }"
                                    role="option">
                                    <span class="block truncate">
                                        {{ $result }}
                                    </span>
                                </li>
                            @empty
                                <li
                                    class="relative py-2 pl-5 text-gray-900 cursor-default select-none pr-9 hover:bg-indigo-600 ">
                                    No results found</li>
                            @endforelse
                        </ul>
                    </div>

                </div>
                <div class="input-group-append">
                    <button class="btn btn-primary height-40 py-2 px-3 rounded-right-pill" type="button"
                        id="searchProduct1"
                        wire:click="$dispatch('value-selected', {name: '{{ addslashes($search) }}'})">
                        <span class="ec ec-search font-size-24"></span>
                    </button>
                </div>
            </div>

        </div>


        @if ($placement == 'home_for_mobile')
            <div class="position-relative" x-on:value-selected="updateSelected($event.detail.id, $event.detail.name)">
                <div class="js-focus-state input-group px-3">
                    <input class="form-control" type="search" placeholder="Search Product"
                        wire:model.live.debounce.300ms="search" x-on:keydown.arrow-down.stop.prevent="highlightNext()"
                        x-on:keydown.arrow-up.stop.prevent="highlightPrevious()"
                        x-on:keydown.enter.stop.prevent="(!$refs.input.text) ? $dispatch('value-selected', {
                        name: $refs.results.children[highlightedIndex].getAttribute('data-result-name')
                    }) : ''">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-3" type="button"
                            wire:click="$dispatch('value-selected', {name: '{{ addslashes($search) }}'})"><i
                                class="font-size-18 ec ec-search"></i></button>
                    </div>
                </div>
                <div x-show="open" x-on:click.away="open = false" x-transition:enter="" x-transition:enter-start=""
                    x-transition:enter-end="" x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="bg-white card ml-5 mt-1 position-absolute shadow-lg"
                    style="width: 83% !important;z-index: 999999;">
                    <ul x-ref="results" tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                        aria-activedescendant="listbox-item-3" class="py-1 pl-0 mb-0" style="list-style: none;">
                        @forelse($results as $index => $result)
                            <li wire:key="{{ $index }}" data-result-name="{{ $result }}"
                                x-on:click.stop="$dispatch('value-selected', {
                        name: '{{ addslashes($result) }}'
                    })"
                                class="relative py-2 pl-5 cursor-pointer-on custom-menu-item"
                                :class="{
                                    'bg-indigo-400': {{ $index }} === highlightedIndex
                                }"
                                role="option">
                                <span class="block truncate">
                                    {{ $result }}
                                </span>
                            </li>
                        @empty
                            <li
                                class="relative py-2 pl-5 text-gray-900 cursor-default select-none pr-9 hover:bg-indigo-600 ">
                                No results found</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        @endif
        @if ($placement == 'content')
            <div class="js-focus-state">
                <div class="position-relative">
                    <label class="sr-only" for="searchProduct">Search</label>
                    <div class="input-group">
                        <input type="email"
                            class="form-control py-2 pl-5 font-size-15 border-0 height-40 rounded-left-pill"
                            name="search" id="searchProduct" placeholder="Search for Products"
                            aria-label="Search for Products" aria-describedby="searchProduct1"
                            wire:model.live.debounce.300ms="search"
                            x-on:keydown.arrow-down.stop.prevent="highlightNext()"
                            x-on:keydown.arrow-up.stop.prevent="highlightPrevious()"
                            x-on:keydown.enter.stop.prevent="(!$refs.input.text) ? $dispatch('value-selected', {
                            name: $refs.results.children[highlightedIndex].getAttribute('data-result-name')
                        }) : ''">
                        <div class="input-group-append">
                            <button class="btn btn-dark height-40 py-2 px-3 rounded-right-pill" type="button"
                                id="searchProduct1"
                                wire:click="$dispatch('value-selected', {name: '{{ addslashes($search) }}'})">
                                <span class="ec ec-search font-size-24"></span>
                            </button>
                        </div>
                    </div>
                    <div x-show="open" x-on:click.away="open = false" x-transition:enter=""
                        x-transition:enter-start="" x-transition:enter-end=""
                        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" class="bg-white card ml-5 mt-1 position-absolute shadow-lg"
                        style="width: 96% !important;z-index: 999999;">
                        <ul x-ref="results" tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                            aria-activedescendant="listbox-item-3" class="py-1 pl-0 mb-0" style="list-style: none;">
                            @forelse($results as $index => $result)
                                <li wire:key="{{ $index }}" data-result-name="{{ $result }}"
                                    x-on:click.stop="$dispatch('value-selected', {
                                    name: '{{ addslashes($result) }}'
                                })"
                                    class="relative py-2 pl-5 cursor-pointer-on custom-menu-item"
                                    :class="{
                                        'bg-indigo-400': {{ $index }} === highlightedIndex
                                    }"
                                    role="option">
                                    <span class="block truncate">
                                        {{ $result }}
                                    </span>
                                </li>
                            @empty
                                <li
                                    class="relative py-2 pl-5 text-gray-900 cursor-default select-none pr-9 hover:bg-indigo-600 ">
                                    No results found</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        @if ($placement == 'content_for_mobile')
            <div class="position-relative" x-on:value-selected="updateSelected($event.detail.id, $event.detail.name)">
                <div class="js-focus-state input-group px-3">
                    <input class="form-control" type="search" placeholder="Search Product"
                        wire:model.live.debounce.300ms="search" x-on:keydown.arrow-down.stop.prevent="highlightNext()"
                        x-on:keydown.arrow-up.stop.prevent="highlightPrevious()"
                        x-on:keydown.enter.stop.prevent="(!$refs.input.text) ? $dispatch('value-selected', {
                    name: $refs.results.children[highlightedIndex].getAttribute('data-result-name')
                }) : ''">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-3" type="button"
                            wire:click="$dispatch('value-selected', {name: '{{ addslashes($search) }}'})"><i
                                class="font-size-18 ec ec-search"></i></button>
                    </div>
                </div>
                <div x-show="open" x-on:click.away="open = false" x-transition:enter="" x-transition:enter-start=""
                    x-transition:enter-end="" x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="bg-white card ml-5 mt-1 position-absolute shadow-lg"
                    style="width: 83% !important;z-index: 999999;">
                    <ul x-ref="results" tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                        aria-activedescendant="listbox-item-3" class="py-1 pl-0 mb-0" style="list-style: none;">
                        @forelse($results as $index => $result)
                            <li wire:key="{{ $index }}" data-result-name="{{ $result }}"
                                x-on:click.stop="$dispatch('value-selected', {name: '{{ addslashes($result) }}'})"
                                class="relative py-2 pl-5 cursor-pointer-on custom-menu-item"
                                :class="{
                                    'bg-indigo-400': {{ $index }} === highlightedIndex
                                }"
                                role="option">
                                <span class="block truncate">
                                    {{ $result }}
                                </span>
                            </li>
                        @empty
                            <li
                                class="relative py-2 pl-5 text-gray-900 cursor-default select-none pr-9 hover:bg-indigo-600 ">
                                No results found</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
