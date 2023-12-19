@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-4">
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Profile</h1>

    <!-- Update Profile Information Form -->
    <div class="mb-6 bg-white shadow-md rounded px-8 pt-6 pb-8">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Update Password Form -->
    <div class="mb-6 bg-white shadow-md rounded px-8 pt-6 pb-8">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete User Form -->
    <div class="mb-6 bg-white shadow-md rounded px-8 pt-6 pb-8">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
