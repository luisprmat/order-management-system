<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $editing ? __('Edit').' '.__('Order') : __('Create').' '.__('Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:text-gray-100 dark:border-gray-900 dark:bg-inherit">

                    <form wire:submit.prevent="save">
                        @csrf

                        <div>
                            <x-input-label class="mb-1" for="country" :value="__('Customer')" />

                            <x-select2 class="mt-1" id="country" name="country" :options="$this->listsForFields['users']" wire:model="order.user_id" />
                            <x-input-error :messages="$errors->get('order.user_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label class="mb-1" for="order_date" :value="__('Order date')" />

                            <x-text-input
                                x-data
                                x-init="new Pikaday({ field: $el, format: 'MM/DD/YYYY' })"
                                type="text"
                                id="order_date"
                                wire:model.lazy="order.order_date"
                                autocomplete="off"
                                class="w-full " />
                            <x-input-error :messages="$errors->get('order.order_date')" class="mt-2" />
                        </div>

                        {{-- Order Products --}}
                        <table class="mt-4 min-w-full border divide-y divide-gray-200 dark:divide-gray-800 dark:border-gray-500">
                            <thead>
                                <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                    <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Product') }}</span>
                                </th>
                                <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                    <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Quantity') }}</span>
                                </th>
                                <th class="px-6 py-3 w-56 text-left bg-gray-50 dark:bg-gray-800"></th>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid dark:divide-gray-600">
                                @forelse($orderProducts as $index => $orderProduct)
                                    <tr>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            @if($orderProduct['is_saved'])
                                                <x-text-input type="hidden" name="orderProducts[{{$index}}][product_id]" wire:model="orderProducts.{{$index}}.product_id" />
                                                @if($orderProduct['product_name'] && $orderProduct['product_price'])
                                                    {{ $orderProduct['product_name'] }}
                                                    (${{ number_format($orderProduct['product_price'], 0, ',', '.') }})
                                                @endif
                                            @else
                                                <div class="flex flex-col">
                                                    <x-select-input name="orderProducts[{{ $index }}][product_id]" class="focus:outline-none w-full border {{ $errors->has('$orderProducts.' . $index) ? 'border-red-500' : 'border-indigo-500' }} rounded-md p-1" wire:model="orderProducts.{{ $index }}.product_id">
                                                        <option value="">-- {{ __('choose product') }} --</option>
                                                        @foreach ($this->allProducts as $product)
                                                            <option value="{{ $product->id }}">
                                                                {{ $product->name }}
                                                                (${{ number_format($product->price, 0, ',', '.') }})
                                                            </option>
                                                        @endforeach
                                                    </x-select-input>
                                                    @error('orderProducts.' . $index)
                                                        <em class="text-sm text-red-500">
                                                            {{ $message }}
                                                        </em>
                                                    @enderror
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            @if($orderProduct['is_saved'])
                                                <x-text-input type="hidden" name="orderProducts[{{$index}}][quantity]" wire:model="orderProducts.{{$index}}.quantity" />
                                                {{ $orderProduct['quantity'] }}
                                            @else
                                                <x-text-input type="number" step="1" name="orderProducts[{{$index}}][quantity]" class="p-1 w-full rounded-md border border-indigo-500 focus:outline-none" wire:model="orderProducts.{{$index}}.quantity" />
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            @if($orderProduct['is_saved'])
                                                <x-primary-button wire:click.prevent="editProduct({{$index}})">
                                                    {{ __('Edit') }}
                                                </x-primary-button>
                                            @elseif($orderProduct['product_id'])
                                                <x-primary-button wire:click.prevent="saveProduct({{$index}})" class="mx-2">
                                                    {{ __('Save') }}
                                                </x-primary-button>
                                            @endif
                                            <button class="px-4 py-2 text-xs text-red-500 uppercase bg-red-200 rounded-md border border-transparent hover:text-red-700 hover:bg-red-300" wire:click.prevent="removeProduct({{$index}})">
                                                {{ __('Delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-nowrap">
                                            {{ __('Start adding products to order.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <x-primary-button wire:click.prevent="addProduct">+ {{ __('Add Product') }}</x-primary-button>
                        </div>
                        {{-- End Order Products --}}

                        <div class="flex justify-end text-gray-700 dark:text-gray-300">
                            <table>
                                <tr>
                                    <th class="text-left p-2">{{ __('Subtotal') }}</th>
                                    <td class="p-2">${{ number_format($order->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="text-left border-t border-gray-300">
                                    <th class="p-2">{{ __('Taxes') }} ({{ $taxesPercent }}%)</th>
                                    <td class="p-2">
                                        ${{ number_format($order->taxes, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="text-left border-t border-gray-300">
                                    <th class="p-2">{{ __('Total') }}</th>
                                    <td class="p-2">${{ number_format($order->total, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="mt-4">
                            <x-primary-button type="submit">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
@endpush
