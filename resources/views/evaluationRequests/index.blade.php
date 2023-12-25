@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6 px-4">
        <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Evaluation Requests</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse ($requests as $request)
                <div style="background-color: lightgrey;" class="dark:bg-gray-800 shadow-lg p-4 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="w-1/3">
                        @if ($request->image)
                             <img src="data:image/jpeg;base64,{{ $request->image }}" alt="Uploaded Image">
                        @endif

                        </div>
                        <div class="w-2/3 ml-4">
                            <p class="text-gray-600 dark:text-gray-200 font-bold">{{ $request->comment }}</p>
                            <!-- Approval Status -->
                            <p>Status: {{ $request->is_approved ? 'Approved' : 'Pending' }}</p>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <!-- Approval Button -->
                        <form action="{{ route('evaluation-requests.approve', $request->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1 mr-2 text-white bg-green-500 rounded-full">
                                {{ $request->is_approved ? 'Unapprove' : 'Approve' }}
                            </button>
                        </form>
                        <!-- Delete Button -->
                        <form action="{{ route('evaluation-requests.destroy', $request->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded-full">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-400">No requests found.</p>
            @endforelse
        </div>
    </div>
@endsection
