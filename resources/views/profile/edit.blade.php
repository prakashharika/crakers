<x-app-layout>
    <style>
        .bg-gray-800 {
        background-color: #2B60A6 !important;
    }
        </style>
    <div class="main main-app p-3 p-lg-4">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    <div class="main-footer mt-5">
        <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
        <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
      </div><!-- main-footer -->
  </div>
</x-app-layout>
