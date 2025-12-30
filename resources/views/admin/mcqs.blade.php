@extends('admin.layouts.header')

@section('title', 'MCQs | Quiz App')

@section('content')
    <div class="w-full px-4 py-8">

        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">MCQs for Quiz: {{ $quiz->name }}</h1>

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

        <!-- Add MCQ Form -->
        <div class="bg-white rounded-xl shadow p-6 mb-8 w-full max-w-3xl mx-auto">
            <h2 class="text-xl font-semibold mb-4">Add New MCQ</h2>

            <form action="{{ route('admin.mcqs.store', $quiz->id) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Question</label>
                    <textarea name="question" rows="2"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200 focus:border-indigo-400"
                        placeholder="Enter question" required>{{ old('question') }}</textarea>
                    @error('question')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Option A</label>
                        <input type="text" name="option1" value="{{ old('option1') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200 focus:border-indigo-400"
                            placeholder="Enter option A" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Option B</label>
                        <input type="text" name="option2" value="{{ old('option2') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200 focus:border-indigo-400"
                            placeholder="Enter option B" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Option C</label>
                        <input type="text" name="option3" value="{{ old('option3') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200 focus:border-indigo-400"
                            placeholder="Enter option C" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Option D</label>
                        <input type="text" name="option4" value="{{ old('option4') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200 focus:border-indigo-400"
                            placeholder="Enter option D" required>
                    </div>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Correct Option</label>
                    <select name="correct_option"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200 focus:border-indigo-400"
                        required>
                        <option value="">Select Correct Option</option>
                        <option value="option1" {{ old('correct_option') == 'option1' ? 'selected' : '' }}>A</option>
                        <option value="option2" {{ old('correct_option') == 'option2' ? 'selected' : '' }}>B</option>
                        <option value="option3" {{ old('correct_option') == 'option3' ? 'selected' : '' }}>C</option>
                        <option value="option4" {{ old('correct_option') == 'option4' ? 'selected' : '' }}>D</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition w-full">
                    + Add MCQ
                </button>
            </form>

        </div>

        <!-- MCQs Table -->
        <div class="bg-white rounded-xl shadow p-6 w-full">
            <h2 class="text-xl font-semibold mb-4">MCQs List</h2>

            <div class="overflow-x-auto w-full">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200 table-auto w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700 font-medium">S.No</th>
                            <th class="px-6 py-3 text-left text-gray-700 font-medium">Question</th>
                            <th class="px-6 py-3 text-left text-gray-700 font-medium">Options</th>
                            <th class="px-6 py-3 text-left text-gray-700 font-medium">Correct Option</th>
                            <th class="px-6 py-3 text-left text-gray-700 font-medium">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $correctMap = [
                                'option1' => 'A',
                                'option2' => 'B',
                                'option3' => 'C',
                                'option4' => 'D',
                            ];
                        @endphp

                        @forelse($mcqs as $index => $mcq)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3 whitespace-nowrap text-gray-700 font-medium">{{ $index + 1 }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-gray-800">{{ $mcq->question }}</td>
                                <td class="px-6 py-3 text-gray-700">
                                    A: {{ $mcq->option1 }} <br>
                                    B: {{ $mcq->option2 }} <br>
                                    C: {{ $mcq->option3 }} <br>
                                    D: {{ $mcq->option4 }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-gray-700">
                                    {{ $correctMap[$mcq->correct_option] ?? '' }}
                                </td>
                                <td class="px-6 py-3 flex gap-2 flex-wrap">
                                    <form action="{{ route('admin.mcqs.delete', $mcq->id) }}" method="POST" x-data
                                        @submit.prevent="if(confirm('Are you sure you want to delete this MCQ?')) $el.submit()">
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
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No MCQs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
