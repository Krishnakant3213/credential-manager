<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post" action="{{ route('users.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                            <x-input-label for="name`" :value="__('Name')"/>
                            <x-text-input id="name`" name="name" type="text" class="mt-1 block w-full"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <div class="col-span-3">
                            <x-input-label for="email" :value="__('Email')"/>
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <div class="col-span-3">
                            <x-input-label for="username" :value="__('Username')"/>
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <div class="col-span-3">
                            <x-input-label for="password" :value="__('Password')"/>
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>
                        <div class="col-span-3">
                            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')"/>
                            <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                          type="password" class="mt-1 block w-full" autocomplete="new-password"/>
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"
                                           class="mt-2"/>
                        </div>

                        <div class="col-span-full">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300" id="dynamicTable">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Url
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Password
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            <x-text-input id="name" name="credential[0][name]" type="text"
                                                          class="mt-1 block w-full" placeholder="Enter Name"/>
                                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <x-text-input id="url" name="credential[0][url]" type="text"
                                                          class="mt-1 block w-full" placeholder="Enter Url"/>
                                            <x-input-error :messages="$errors->get('url')" class="mt-2"/>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <x-text-input id="password" name="credential[0][password]" type="text"
                                                          class="mt-1 block w-full" placeholder="Enter password"/>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <button type="button" name="add" id="add" class="btn btn-success">Add More
                                            </button>
                                            {{--                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>--}}
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" href="{{ route('users.index') }}" type="button">{{ __('Back') }}</a>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script type="text/javascript">
        var i = 0;

        jQuery("#add").click(function () {
            ++i;
            jQuery("#dynamicTable").append('<tr><td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"><input type="text" name="credential[' + i + '][name]" placeholder="Enter Name" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" /></td><td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><input type="text" name="credential[' + i + '][url]" placeholder="Enter Url" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" /></td><td><input type="text" name="credential[' + i + '][password]" placeholder="Enter Password" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" /></td><td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });

        jQuery(document).on('click', '.remove-tr', function () {
            jQuery(this).parents('tr').remove();
        });

    </script>
</x-app-layout>
