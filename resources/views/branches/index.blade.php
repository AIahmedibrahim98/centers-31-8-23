<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          {{ App\Models\Branch::count() }} - {{ trans_choice('messages.branches_b', App\Models\Branch::count()) }}
        </h2>
    </x-slot>
    {{-- {{ auth()->id() }} --}}
    {{-- {{ auth()->user() }} --}}
    {{-- {{ auth()->user()->name }} --}}
    {{-- @dump(app\models\User::all()) --}}
    <div class="p-1 py-5 m-3 bg-white rounded">
        <form action="{{ route('branches.index') }}">
            <div class="w-1/2 text-center" style="margin:  0 auto">
                <x-input-label for='search'>Search</x-input-label>
                <x-text-input value="{{ request()->get('search') }}" placeholder="Branch Name Or Compnay Name"
                    class="w-full" name='search'></x-text-input>
            </div>
        </form>
        <div class="max-w-full mx-auto sm:px-3 lg:px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @if (session()->has('status'))
                    <div
                        class="flex items-center justify-center px-2 py-1 m-1 font-medium text-green-700 bg-white bg-green-100 border border-green-300 rounded-md ">
                        <div slot="avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-5 h-5 mx-2 feather feather-check-circle">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <div class="flex-initial max-w-full text-xl font-normal">
                            {{ session('status') }}</div>
                        <div class="flex flex-row-reverse flex-auto">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="w-5 h-5 ml-2 rounded-full cursor-pointer feather feather-x hover:text-green-400">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
            <div class="p-6 text-gray-900">
                <div class="flex justify-end">
                    <x-primary-button class="bg-red-800">
                        <a href="{{ route('branches.create') }}">Add New Branch</a>
                    </x-primary-button>
                </div>
                <!-- component -->
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead class="bg-gray-200 border-b rounded-xl">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                #
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                location
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                mobile
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                company
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                Created At
                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($branches as $key => $branch)
                                            <tr
                                                class="transition duration-300 ease-in-out bg-white border-b hover:bg-gray-100">
                                                <td
                                                    class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $branches->firstItem() + $key }}</td>
                                                <td
                                                    class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
                                                    {{ $branch->name }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
                                                    {{ $branch->location }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
                                                    {{ $branch->mobile }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
                                                    {{ $branch->company->name }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
                                                    {{ $branch->created_at }}
                                                </td>
                                                <td>
                                                    <div class="flex justify-between">

                                                        <div>
                                                            <a href="{{ route('branches.edit', $branch->id) }}"> <i
                                                                    class="fa-solid fa-pen-to-square"></i></a>

                                                        </div>
                                                        <div>
                                                            <form method="POST"
                                                                action="{{ route('branches.destroy', $branch->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"> <i class="fa-solid fa-trash"
                                                                        style="color: #e02f18;"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $branches->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
