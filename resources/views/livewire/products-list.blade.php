<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:text-gray-100 dark:border-gray-900 dark:bg-inherit">

                    @error('orderexist')
                        <div class="p-3 mb-4 text-green-700 bg-green-200 dark:text-green-200 dark:bg-green-800">
                            {!! $message !!}
                        </div>
                    @enderror

                    <div class="mb-4">
                        <div class="mb-4">
                            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white dark:text-gray-800 uppercase bg-gray-800 dark:bg-gray-200 rounded-md border border-transparent hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white cursor-pointer">
                                {{ __('Create Product') }}
                            </a>
                        </div>

                        <button type="button"
                                wire:click="deleteConfirm('deleteSelected')"
                                wire:loading.attr="disabled"
                                @disabled(! $this->selectedCount)
                                class="px-4 py-2 mr-5 text-xs text-red-500 dark:text-red-700 uppercase bg-red-200 dark:bg-red-300 rounded-md border border-transparent hover:text-red-700 hover:bg-red-300 disabled:opacity-50 disabled:cursor-not-allowed">
                            {{ __('Delete Selected') }}
                        </button>

                        <x-primary-button wire:click="export('csv')">CSV</x-primary-button>
                        <x-primary-button wire:click="export('xlsx')">XLSX</x-primary-button>
                        <x-primary-button wire:click="export('pdf')">PDF</x-primary-button>
                    </div>

                    <div class="overflow-hidden overflow-x-auto mb-4 min-w-full align-middle sm:rounded-md dark:border-gray-500">
                        <table class="min-w-full border divide-y divide-gray-200 dark:divide-gray-800">
                            <thead class="bg-white divide-y divide-gray-200 divide-solid dark:divide-gray-600">
                                <tr>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                    </th>
                                    <th wire:click="sortByColumn('products.name')" class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800 cursor-pointer">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Name') }}</span>
                                        @if ($sortColumn == 'products.name')
                                            @include('svg.sort-' . $sortDirection)
                                        @else
                                            @include('svg.sort')
                                        @endif
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Categories') }}</span>
                                    </th>
                                    <th wire:click="sortByColumn('countryName')" class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Country') }}</span>
                                        @if ($sortColumn == 'countryName')
                                            @include('svg.sort-' . $sortDirection)
                                        @else
                                            @include('svg.sort')
                                        @endif
                                    </th>
                                    <th wire:click="sortByColumn('price')" class="px-6 py-3 w-32 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Price') }}</span>
                                        @if ($sortColumn == 'price')
                                            @include('svg.sort-' . $sortDirection)
                                        @else
                                            @include('svg.sort')
                                        @endif
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                    </th>
                                </tr>

                                <tr class="dark:bg-gray-900">
                                    <td></td>
                                    <td class="px-2 py-2">
                                        <x-text-input wire:model="searchColumns.name" type="text" placeholder="{{ __('Search') }}..." />
                                    </td>
                                    <td class="px-2 py-1">
                                        <x-select-input wire:model="searchColumns.category_id"
                                                class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <option value="">-- {{ __('choose category') }} --</option>
                                            @foreach($categories as $id => $category)
                                                <option value="{{ $id }}">{{ $category }}</option>
                                            @endforeach
                                        </x-select-input>
                                    </td>
                                    <td class="px-2 py-1">
                                        <x-select-input wire:model="searchColumns.country_id"
                                                class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <option value="">-- {{ __('choose country') }} --</option>
                                            @foreach($countries as $id => $country)
                                                <option value="{{ $id }}">{{ $country }}</option>
                                            @endforeach
                                        </x-select-input>
                                    </td>
                                    <td class="px-2 py-1 text-sm">
                                        <div>
                                            {{ __('From') }}
                                            <x-text-input wire:model="searchColumns.price.0" type="number" class="mr-2 w-full text-sm" />
                                        </div>
                                        <div>
                                            {{ __('To') }}
                                            <x-text-input wire:model="searchColumns.price.1" type="number" class="w-full text-sm" />
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid dark:divide-gray-600">
                                @forelse($products as $product)
                                    <tr class="bg-white">
                                        <td class="px-4 py-2 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            <input type="checkbox" value="{{ $product->id }}" wire:model="selected">
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            {{ str($product->name)->limit(25, '...') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200">
                                            @foreach($product->categories as $category)
                                                <span class="px-2 py-1 text-xs text-indigo-700 bg-indigo-200 dark:text-indigo-200 dark:bg-indigo-600 rounded-md whitespace-nowrap">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            {{ $product->countryName }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            $ {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="dark:bg-gray-900 whitespace-nowrap">
                                            <x-primary-link href="{{ route('products.edit', $product) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent hover:bg-gray-700">
                                                {{ __('Edit') }}
                                            </x-primary-link>
                                            <button wire:click="deleteConfirm('delete', {{ $product->id }})" class="px-4 py-2 text-xs text-red-500 dark:text-red-700 uppercase bg-red-200 dark:bg-red-300 rounded-md border border-transparent hover:text-red-700 hover:bg-red-300">
                                                {{ __('Delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-gray-300 dark:bg-gray-900">
                                        <td colspan="6" class="text-center">{{ __('No results found!') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $products->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
