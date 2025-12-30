@extends('admin.layouts.header')

@section('title', 'Categories | Quiz App')

@section('content')
<div class="w-full px-4 py-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Categories</h1>

    <!-- Flash Messages -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-green-100 text-green-700 p-3 rounded mb-6 shadow w-full max-w-3xl mx-auto">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-red-100 text-red-700 p-3 rounded mb-6 shadow w-full max-w-3xl mx-auto">
            {{ session('error') }}
        </div>
    @endif

    <!-- Add Category Form -->
    <div class="bg-white rounded-xl shadow p-6 mb-8 w-full max-w-3xl mx-auto">
        <h2 class="text-xl font-semibold mb-4">Add New Category</h2>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-medium text-gray-700">Category Name</label>
                <input type="text" name="name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200 focus:border-indigo-400"
                    placeholder="Enter category name" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition w-full">
                + Add Category
            </button>
        </form>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-xl shadow p-6 w-full">
        <h2 class="text-xl font-semibold mb-4">Category List</h2>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 table-fixed divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="w-1/12 px-4 py-3 text-left text-gray-700 font-medium">S.No</th>
                        <th class="w-5/12 px-4 py-3 text-left text-gray-700 font-medium">Category Name</th>
                        <th class="w-4/12 px-4 py-3 text-left text-gray-700 font-medium">Creator</th>
                        <th class="w-2/12 px-4 py-3 text-left text-gray-700 font-medium">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categories as $index => $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-gray-700 font-medium text-left">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-gray-800 text-left">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-gray-700 text-left">{{ $category->creator }}</td>
                            <td class="px-4 py-3 text-left flex gap-2">
                                <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" x-data
                                    @submit.prevent="if(confirm('Are you sure you want to delete this category?')) $el.submit()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                No categories found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Alpine.js for popup auto-dismiss -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
