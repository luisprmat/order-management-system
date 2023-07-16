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

                    <div class="mb-4">
                        <div class="mb-4">
                            <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white dark:text-gray-800 uppercase bg-gray-800 dark:bg-gray-200 rounded-md border border-transparent hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white cursor-pointer">
                                {{ __('Create Product') }}
                            </a>
                        </div>
                    </div>

                    <div class="overflow-hidden overflow-x-auto mb-4 min-w-full align-middle sm:rounded-md dark:border-gray-500">
                        <table class="min-w-full border divide-y divide-gray-200 dark:divide-gray-800">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Name') }}</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Categories') }}</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Country') }}</span>
                                    </th>
                                    <th class="px-6 py-3 w-32 text-left bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 dark:text-gray-400 uppercase">{{ __('Price') }}</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800 w-48">
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid dark:divide-gray-600">
                                @foreach($products as $product)
                                    <tr class="bg-white">
                                        <td class="px-4 py-2 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            <input type="checkbox" value="{{ $product->id }}" wire:model="selected">
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            {{ str($product->name)->limit(25, '...') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200">
                                            @foreach($product->categories as $category)
                                                <span class="px-2 py-1 text-xs text-indigo-700 bg-indigo-200 rounded-md whitespace-nowrap">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            {{ $product->country->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 dark:bg-gray-900 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            $ {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="dark:bg-gray-900">
                                            <x-primary-link class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent hover:bg-gray-700">
                                                {{ __('Edit') }}
                                            </x-primary-link>
                                            <button class="px-4 py-2 text-xs text-red-500 dark:text-red-700 uppercase bg-red-200 dark:bg-red-300 rounded-md border border-transparent hover:text-red-700 hover:bg-red-300">
                                                {{ __('Delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $products->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
