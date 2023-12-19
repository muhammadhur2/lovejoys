@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-4">
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Request Evaluation</h1>

    <form action="{{ route('evaluation-requests.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Details:</label>
            <textarea name="comment" id="comment" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>
        <div class="mb-4">
            <label for="contact_method" class="block text-gray-700 text-sm font-bold mb-2">Preferred Contact Method:</label>
            <select name="contact_method" id="contact_method" required class="shadow border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                <option value="phone">Phone</option>
                <option value="email">Email</option>
            </select>
        </div>
        <div class="mb-6">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
            <input type="file" name="image" id="image" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Submit Request
        </button>
    </form>
</div>
@endsection
