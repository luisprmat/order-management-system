<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:text-gray-100 dark:border-gray-900 dark:bg-inherit">

                    <x-primary-button class="mb-4">
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
                                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800 w-56">
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid dark:bg-gray-900 dark:divide-gray-600">
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="px-6">
                                            <button>
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                                    <path fill="none" d="M0 0h256v256H0z" />
                                                    <path fill="none" class="stroke-current" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M156.3 203.7 128 232l-28.3-28.3M128 160v72M99.7 52.3 128 24l28.3 28.3M128 96V24M52.3 156.3 24 128l28.3-28.3M96 128H24M203.7 99.7 232 128l-28.3 28.3M160 128h72" />
                                                </svg>
                                            </button>
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            {{ $category->slug }}
                                        </td>
                                        <td class="px-6">
                                            <div class="inline-block relative mr-2 w-10 align-middle transition duration-200 ease-in select-none">
                                                <input type="checkbox" name="toggle" class="block absolute w-6 h-6 bg-white rounded-full border-4 appearance-none cursor-pointer focus:outline-none toggle-checkbox" />
                                                <label for="toggle" class="block overflow-hidden h-6 bg-gray-300 dark:bg-gray-400 rounded-full cursor-pointer toggle-label"></label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            <x-primary-button>
                                                {{ __('Edit') }}
                                            </x-primary-button>
                                            <button class="px-4 py-2 text-xs text-red-500 uppercase bg-red-200 rounded-md border border-transparent hover:text-red-700 hover:bg-red-300">
                                                {{ __('Delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
