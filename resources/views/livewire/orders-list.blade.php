<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:text-gray-100 dark:border-gray-900 dark:bg-inherit">

                    <div class="mb-4">
                        <div class="mb-4">
                            <a href="{{ route('orders.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white dark:text-gray-800 uppercase bg-gray-800 dark:bg-gray-200 rounded-md border border-transparent hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white cursor-pointer">
                                {{ __('Create Order') }}
                            </a>
                        </div>

                        <button type="button"
                                wire:click="deleteConfirm('deleteSelected')"
                                wire:loading.attr="disabled"
                                {{ $this->selectedCount ? '' : 'disabled' }}
                                class="px-4 py-2 mr-5 text-xs text-red-500 dark:text-red-700 uppercase bg-red-200 dark:bg-red-300 rounded-md border border-transparent hover:text-red-700 hover:bg-red-300 disabled:opacity-50 disabled:cursor-not-allowed">
                            {{ __('Delete Selected') }}
                        </button>
                    </div>

                    <div class="overflow-hidden overflow-x-auto mb-4 min-w-full align-middle sm:rounded-md dark:border-gray-500">
                        <table class="min-w-full border divide-y divide-gray-200 dark:divide-gray-800">
                            <thead class="bg-white divide-y divide-gray-200 divide-solid dark:divide-gray-600">
                                <tr>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                    </th>
                                    <th wire:click="sortByColumn('order_date')" class="px-6 py-3 w-40 text-left bg-gray-50 dark:bg-gray-800 whitespace-nowrap">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Order date') }}</span>
                                        @if ($sortColumn == 'order_date')
                                            @include('svg.sort-' . $sortDirection)
                                        @else
                                            @include('svg.sort')
                                        @endif
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('User Name') }}</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800 w-fit">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Products') }}</span>
                                    </th>
                                    <th wire:click="sortByColumn('subtotal')" class="px-6 py-3 w-36 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Subtotal') }}</span>
                                        @if ($sortColumn == 'subtotal')
                                            @include('svg.sort-' . $sortDirection)
                                        @else
                                            @include('svg.sort')
                                        @endif
                                    </th>
                                    <th wire:click="sortByColumn('taxes')" class="px-6 py-3 w-32 text-left bg-gray-50 dark:bg-gray-800 whitespace-nowrap">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Taxes') }}</span>
                                        @if ($sortColumn == 'taxes')
                                            @include('svg.sort-' . $sortDirection)
                                        @else
                                            @include('svg.sort')
                                        @endif
                                    </th>
                                    <th wire:click="sortByColumn('total')" class="px-6 py-3 w-32 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Total') }}</span>
                                        @if ($sortColumn == 'total')
                                            @include('svg.sort-' . $sortDirection)
                                        @else
                                            @include('svg.sort')
                                        @endif
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                    </th>
                                </tr>
                                <tr class="dark:bg-gray-900">
                                    <td>
                                    </td>
                                    <td class="px-1 py-1 text-sm">
                                        <div>
                                            {{ __('From') }}
                                            <x-text-input
                                                x-data
                                                x-init="new Pikaday({
                                                    field: $el,
                                                    format: 'MM/DD/YYYY',
                                                    i18n: $store.pikaday.dateLocale.{{ config('app.locale') }}
                                                })"
                                                wire:model.lazy="searchColumns.order_date.0"
                                                type="text"
                                                placeholder="{{ __('MM/DD/YYYY') }}"
                                                class="mr-2 w-full text-sm" />
                                        </div>
                                        <div>
                                            {{ __('To') }}
                                            <x-text-input
                                                x-data
                                                x-init="new Pikaday({
                                                    field: $el,
                                                    format: 'MM/DD/YYYY',
                                                    i18n: $store.pikaday.dateLocale.{{ config('app.locale') }}
                                                })"
                                                wire:model.lazy="searchColumns.order_date.1"
                                                type="text"
                                                placeholder="{{ __('MM/DD/YYYY') }}"
                                                class="w-full text-sm" />
                                        </div>
                                    </td>
                                    <td class="px-1 py-1 text-sm">
                                        <x-text-input class="w-full" wire:model="searchColumns.username" type="text" placeholder="{{ __('Search') }}..." />
                                    </td>
                                    <td class="px-1 py-1">
                                    </td>
                                    <td class="px-1 py-1 text-sm">
                                        {{ __('From') }}
                                        <x-text-input wire:model="searchColumns.subtotal.0" type="number" class="mr-2 w-full text-sm" />
                                        {{ __('To') }}
                                        <x-text-input wire:model="searchColumns.subtotal.1" type="number" class="w-full text-sm" />
                                    </td>
                                    <td class="px-1 py-1 text-sm">
                                        {{ __('From') }}
                                        <x-text-input wire:model="searchColumns.taxes.0" type="number"
                                               class="mr-2 w-full text-sm" />
                                        {{ __('To') }}
                                        <x-text-input wire:model="searchColumns.taxes.1" type="number" class="w-full text-sm" />
                                    </td>
                                    <td class="px-1 py-1 text-sm">
                                        {{ __('From') }}
                                        <x-text-input wire:model="searchColumns.total.0" type="number" class="mr-2 w-full text-sm" />
                                        {{ __('To') }}
                                        <x-text-input wire:model="searchColumns.total.1" type="number" class="w-full text-sm" />
                                    </td>
                                    <td></td>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid dark:divide-gray-600">
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="px-4 py-2 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            <input type="checkbox" value="{{ $order->id }}" wire:model="selected">
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            {{ $order->order_date->format('m/d/Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            {{ $order->username }}
                                        </td>
                                        <td class="flex flex-wrap w-72 gap-1 items-baseline px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200">
                                            @foreach($order->products as $product)
                                                <span class="px-2 py-1 text-xs text-indigo-700 bg-indigo-200 dark:text-indigo-200 dark:bg-indigo-600 rounded-md whitespace-nowrap">{{ $product->excerpt }}</span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            ${{ number_format($order->subtotal, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            ${{ number_format($order->taxes, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            ${{ number_format($order->total, 0, ',', '.') }}
                                        </td>
                                        <td class="dark:bg-gray-900 whitespace-nowrap">
                                            <a href="{{ route('orders.edit', $order) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent hover:bg-gray-700">
                                                {{ __('Edit') }}
                                            </a>
                                            <button wire:click="deleteConfirm('delete', {{ $order->id }})" class="px-4 py-2 text-xs text-red-500 uppercase bg-red-200 rounded-md border border-transparent hover:text-red-700 hover:bg-red-300">
                                                {{ __('Delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $orders->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
@endpush
