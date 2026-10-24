<x-layouts.chatapp>
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-gray-900 mb-4">
            {{ __('Welcome to Chaddity Chat') }}
        </h1>

        <p class="text-lg text-blue-gray-600 mb-8">
            {{ __('Connect, communicate, and collaborate with your team in real-time. Start a new conversation or continue chatting with your contacts.') }}
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Messages Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-blue-500">
                        <path d="M8.25 4.5a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM12 1.5a6 6 0 00-5.98 6.496c.08.85-.01 1.771-.484 2.605l-1.47 2.94a2.25 2.25 0 00-.04 2.814l.658 1.317a2.25 2.25 0 002.025 1.228h5.68a2.25 2.25 0 002.025-1.228l.658-1.317a2.25 2.25 0 00-.04-2.814l-1.47-2.94a6.002 6.002 0 00-.484-2.605A6 6 0 0012 1.5z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-blue-gray-900">
                        {{ __('Messages') }}
                    </h3>
                </div>
                <p class="text-blue-gray-600 mb-4">
                    {{ __('Send and receive messages instantly with your contacts.') }}
                </p>
                <a href="#" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    {{ __('View Messages') }}
                </a>
            </div>

            <!-- Contacts Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-green-500">
                        <path d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5A2.25 2.25 0 008.25 22.5h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 6.75h3m-3 3h3m-3 3h3M9 19.5h6"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-blue-gray-900">
                        {{ __('Contacts') }}
                    </h3>
                </div>
                <p class="text-blue-gray-600 mb-4">
                    {{ __('Manage your contacts and organize your chat groups.') }}
                </p>
                <a href="#" class="inline-block px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                    {{ __('View Contacts') }}
                </a>
            </div>

            <!-- Search Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-purple-500">
                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 002.25 10.5z" clip-rule="evenodd"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-blue-gray-900">
                        {{ __('Search') }}
                    </h3>
                </div>
                <p class="text-blue-gray-600 mb-4">
                    {{ __('Find messages, contacts, or conversations easily.') }}
                </p>
                <a href="#" class="inline-block px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors">
                    {{ __('Search Chats') }}
                </a>
            </div>
        </div>

        <!-- Getting Started Section -->
        <div class="mt-12 bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-semibold text-blue-gray-900 mb-4">
                {{ __('Getting Started') }}
            </h2>
            <p class="text-blue-gray-600 mb-6">
                {{ __('Here are some tips to help you get the most out of Chaddity Chat:') }}
            </p>
            <ul class="space-y-3 text-blue-gray-700">
                <li class="flex items-start gap-3">
                    <span class="text-blue-500 font-bold mt-1">•</span>
                    <span>{{ __('Start a new conversation by clicking on the "New Chat" button') }}</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-blue-500 font-bold mt-1">•</span>
                    <span>{{ __('Add your friends and colleagues to your contacts') }}</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-blue-500 font-bold mt-1">•</span>
                    <span>{{ __('Use the search feature to find specific messages or conversations') }}</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-blue-500 font-bold mt-1">•</span>
                    <span>{{ __('Customize your settings in the profile menu') }}</span>
                </li>
            </ul>
        </div>
    </div>
</x-layouts.chatapp>
