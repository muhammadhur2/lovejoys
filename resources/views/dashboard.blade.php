@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="container mx-auto py-6 px-4">
                        <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Approved Evaluation Requests</h1>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @forelse ($requests as $request)
                                <div style="background-color: lightgrey;" class="dark:bg-gray-800 shadow-lg p-4 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div class="w-1/3">
                                            @if ($request->image)
                                                <img src="{{ Storage::url($request->image) }}" alt="Uploaded Image" class="max-w-full max-h-full rounded-lg">
                                            @endif
                                        </div>
                                        <div class="w-2/3 ml-4">
                                            <p class="text-gray-600 dark:text-gray-200 font-bold">{{ $request->comment }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-right">
                                        <button class="px-3 py-1 border border-green-500 text-green-500 rounded-full bg-lightgrey">
                                            Approved
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600 dark:text-gray-400">No approved requests found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
