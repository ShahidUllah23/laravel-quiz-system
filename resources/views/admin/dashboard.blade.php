@extends('admin.layouts.header')

@section('title', 'Dashboard | Quiz App')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-600">Total Users</h3>
        <p class="text-3xl font-bold text-indigo-600 mt-2">120</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-600">Total Categories</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">10</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-600">Total Quizzes</h3>
        <p class="text-3xl font-bold text-orange-500 mt-2">45</p>
    </div>

</div>
@endsection
