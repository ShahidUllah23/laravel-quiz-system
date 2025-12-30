@extends('admin.layouts.header')

@section('title', 'Quizzes | Quiz App')

@section('content')
    <div class="w-full px-4 py-8">

        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Quizzes</h1>

        <!-- Flash Messages -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                class="bg-green-100 text-green-700 p-3 rounded mb-6 shadow mx-auto w-full max-w-3xl">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                class="bg-red-100 text-red-700 p-3 rounded mb-6 shadow mx-auto w-full max-w-3xl">
                {{ session('error') }}
            </div>
        @endif

        <!-- Add Quiz Form -->
        <div class="bg-white rounded-xl shadow p-6 mb-8 w-full max-w-3xl mx-auto">
            <h2 class="text-xl font-semibold mb-4">Add New Quiz</h2>

            <form action="{{ route('admin.quizzes.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Quiz Name</label>
                    <input type="text" name="name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200 focus:border-indigo-400"
                        placeholder="Enter quiz name" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Category</label>
                    <select name="category_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200 focus:border-indigo-400"
                        required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition w-full">
                    + Add Quiz
                </button>
            </form>
        </div>

        <!-- Quizzes Table -->
        <div class="bg-white rounded-xl shadow p-6 w-full">
            <h2 class="text-xl font-semibold mb-4">Quiz List</h2>

            <div class="overflow-x-auto w-full">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200 table-auto w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700 font-medium">S.No</th>
                            <th class="px-6 py-3 text-left text-gray-700 font-medium">Quiz Name</th>
                            <th class="px-6 py-3 text-left text-gray-700 font-medium">Category</th>
                            <th class="px-6 py-3 text-left text-gray-700 font-medium">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($quizzes as $index => $quiz)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3 whitespace-nowrap text-gray-700 font-medium">{{ $index + 1 }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-gray-800">{{ $quiz->name }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-gray-700">{{ $quiz->category->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-3 flex gap-2 flex-wrap">
                                    <a href="{{ route('admin.mcqs.index', $quiz->id) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                                        MCQs
                                    </a>
                                    <form action="{{ route('admin.quizzes.delete', $quiz->id) }}" method="POST" x-data
                                        @submit.prevent="if(confirm('Are you sure you want to delete this quiz?')) $el.submit()">
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
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No quizzes found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
