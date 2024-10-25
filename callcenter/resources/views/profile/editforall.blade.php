@extends('admin.test')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Le profil de {{ $user->name }}
        </h2>
    </x-slot>

    <div class=" bg-white py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partialsforall.update-profile-information-form-all-users')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partialsforall.update-password-form-all-users')
                </div>
            </div>

            <!-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partialsforall.delete-user-form-all-users')
                </div> -->
            </div>
        </div>

</x-app-layout>

@endsection


