<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Add New Course
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{--  @if ($errors->any())
                        <div class="p-5 m-2 text-red-700 bg-red-300 border border-red-500 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="font-bold text-red-800">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <form method="POST" action="{{ route('courses.store') }}" class="p-2 border rounded-2xl">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for='name'>Name</x-input-label>
                                <x-text-input value="{{ old('name') }}" class="w-full" name='name'></x-text-input>
                                @error('name')
                                    <x-input-label for='name'
                                        class="font-bold text-red-800">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for='hours'>hours</x-input-label>
                                <x-text-input value="{{ old('hours') }}" class="w-full" name='hours'></x-text-input>
                                @error('hours')
                                    <x-input-label for='hours'
                                        class="font-bold text-red-800">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for='price'>price</x-input-label>
                                <x-text-input value="{{ old('price') }}" class="w-full" name='price'></x-text-input>
                                @error('price')
                                    <x-input-label for='price'
                                        class="font-bold text-red-800">{{ $message }}</x-input-label>
                                @enderror
                            </div>

                            <div>
                                <x-input-label for='vendor_id'>Vendor</x-input-label>

                                <select name="vendor_id">
                                    <option value="">اختار</option>
                                    @foreach (App\Models\Vendor::all() as $vendor)
                                        <option id='{{ $vendor->id }}'>{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                                @error('vendor_id')
                                    <x-input-label for='vendor_id'
                                        class="font-bold text-red-800">{{ $message }}</x-input-label>
                                @enderror
                            </div>

                            <div>
                                <x-input-label for='category'>main category</x-input-label>
                                <select name="category_id" id="category">
                                    <option value="">اختار</option>
                                    @foreach (App\Models\Category::whereNull('category_id')->get() as $category)
                                        <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <x-input-label for='category_id'
                                        class="font-bold text-red-800">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for='category'>sub category</x-input-label>
                                <select name="category_id" id="subcategory">
                                    <option value="">اختار</option>

                                </select>
                                @error('category_id')
                                    <x-input-label for='category_id'
                                        class="font-bold text-red-800">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end mt-3">
                            <x-primary-button>
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#category').on('change', function(e) {
                var cat_id = e.target.value;
                $.ajax({
                    url: "{{ route('subcat') }}",
                    type: "POST",
                    data: {
                        category_id: cat_id
                    },
                    success: function(data) {
                        // console.log(data.sub_categories);
                        $('#subcategory').empty();
                        $('#subcategory').append('<option value="">Select Category</option>');
                        $.each(data.sub_categories, function(index,
                            subcategory) {
                            $('#subcategory').append('<option value="' + subcategory
                                .id + '">' + subcategory.name + '</option>');
                        })
                    }
                })
            });
        });
    </script>
</x-app-layout>
