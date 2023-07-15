<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:text-gray-100 dark:border-gray-900 dark:bg-inherit">

                    <x-primary-button wire:click.prevent="openModal" class="mb-4">
                        {{ __('Add Category') }}
                    </x-primary-button>

                    <div class="overflow-hidden overflow-x-auto mb-4 min-w-full align-middle sm:rounded-md dark:border-gray-500">
                        <table class="min-w-full border divide-y divide-gray-200 dark:divide-gray-800">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 w-10 text-left bg-gray-50 dark:bg-gray-800">
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4  dark:text-gray-400 uppercase">{{ __('Name') }}</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4  dark:text-gray-400 uppercase">{{ __('Slug') }}</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4  dark:text-gray-400 uppercase">{{ __('Active') }}</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800 w-72">
                                    </th>
                                </tr>
                            </thead>

                            <tbody wire:sortable="updateOrder" wire:sortable.options="{ animation: 150, ghostClass: 'bg-blue-100' }" class="bg-white divide-y divide-gray-200 divide-solid dark:bg-gray-900 dark:divide-gray-600">
                                @foreach ($categories as $category)
                                    <tr wire:sortable.item="{{ $category->id }}" wire:key="{{ $loop->index }}">
                                        <td class="px-6">
                                            <button wire:sortable.handle class="cursor-move">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                                    <path fill="none" d="M0 0h256v256H0z" />
                                                    <path fill="none" class="stroke-current" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M156.3 203.7 128 232l-28.3-28.3M128 160v72M99.7 52.3 128 24l28.3 28.3M128 96V24M52.3 156.3 24 128l28.3-28.3M96 128H24M203.7 99.7 232 128l-28.3 28.3M160 128h72" />
                                                </svg>
                                            </button>
                                        </td>

                                        {{-- Inline Edit Start --}}
                                        <td class="@if($editedCategoryId !== $category->id) hidden @endif px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            <x-text-input wire:model="category.name" id="category.name" class="py-2 pr-4 pl-2 w-full text-sm rounded-lg border border-gray-400 sm:text-base focus:outline-none focus:border-blue-400" />
                                            @error('category.name')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td class="@if($editedCategoryId !== $category->id) hidden @endif px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            <x-text-input wire:model="category.slug" id="category.slug" class="py-2 pr-4 pl-2 w-full text-sm rounded-lg border border-gray-400 sm:text-base focus:outline-none focus:border-blue-400" />
                                            @error('category.slug')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        {{-- Inline Edit End --}}

                                        {{-- Show Category Name/Slug Start --}}
                                        <td class="@if($editedCategoryId === $category->id) hidden @endif px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            {{ $category->name }}
                                        </td>
                                        <td class="@if($editedCategoryId === $category->id) hidden @endif px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            {{ $category->slug }}
                                        </td>
                                        {{-- Show Category Name/Slug End --}}

                                        <td class="px-6">
                                            <div class="inline-block relative mr-2 w-10 align-middle transition duration-200 ease-in select-none">
                                                <input wire:model="active.{{ $category->id }}" wire:click="toggleIsActive({{ $category->id }})" type="checkbox" name="toggle" id="{{ $loop->index.$category->id }}" class="block absolute w-6 h-6 bg-white rounded-full border-4 appearance-none cursor-pointer focus:outline-none toggle-checkbox" />
                                                <label for="{{ $loop->index.$category->id }}" class="block overflow-hidden h-6 bg-gray-300 rounded-full cursor-pointer toggle-label"></label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            @if($editedCategoryId === $category->id)
                                                <x-primary-button wire:click="save">
                                                    {{ __('Save') }}
                                                </x-primary-button>
                                                <x-primary-link wire:click.prevent="cancelCategoryEdit">
                                                    {{ __('Cancel') }}
                                                </x-primary-link>
                                            @else
                                                <x-primary-button wire:click="editCategory({{ $category->id }})">
                                                    {{ __('Edit') }}
                                                </x-primary-button>
                                                <button class="px-4 py-2 text-xs text-red-500 uppercase bg-red-200 rounded-md border border-transparent hover:text-red-700 hover:bg-red-300">
                                                    {{ __('Delete') }}
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {!! $links !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for create category --}}
    <div class="@if (!$showModal) hidden @else flex @endif items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800 bg-opacity-90">
        <div class="w-1/2 bg-white rounded-lg">
            <form wire:submit.prevent="save" class="w-full">
                <div class="flex flex-col items-start p-4">
                    <div class="flex items-center pb-4 mb-4 w-full border-b">
                        <div class="text-lg font-medium text-gray-900">{{ __('Create Category') }}</div>
                        <svg wire:click.prevent="$set('showModal', false)"
                             class="ml-auto w-6 h-6 text-gray-700 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>
                    <div class="mb-2 w-full">
                        <label class="block text-sm font-medium text-gray-700" for="category.name">
                            {{ __('Name') }}
                        </label>
                        <input wire:model="category.name" id="category.name"
                               class="py-2 pr-4 pl-2 mt-2 w-full text-sm rounded-lg border border-gray-400 sm:text-base focus:outline-none focus:border-blue-400" />
                        @error('category.name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2 w-full">
                        <label class="block text-sm font-medium text-gray-700" for="category.slug">
                            {{ __('Slug') }}
                        </label>
                        <input wire:model="category.slug" id="category.slug"
                               class="py-2 pr-4 pl-2 mt-2 w-full text-sm rounded-lg border border-gray-400 sm:text-base focus:outline-none focus:border-blue-400" />
                        @error('category.slug')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4 ml-auto">
                        <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700" type="submit">
                            {{ __('Create') }}
                        </button>
                        <button wire:click.prevent="$set('showModal', false)" class="px-4 py-2 font-bold text-white bg-gray-500 rounded" type="button" data-dismiss="modal">
                            {{ __('Close') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
