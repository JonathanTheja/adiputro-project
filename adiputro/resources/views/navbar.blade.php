<nav class="bg-gray-900 fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center h-16">
            <div class="flex items-center">
                <img src="{{ asset('img/logo_adiputro.png') }}" style="width: 130px;height:30px" alt="logo" />
                <div class="ml-4 flex items-center flex-grow space-x-4">
                    <a href="{{ url('/master/user') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('master/user') ? 'text-white underline' : 'text-gray-300' }}">User</a>
                    <a href="{{ url('/master/departemen') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('master/departemen') ? 'text-white underline' : 'text-gray-300' }}">Departemen</a>
                    <a href="{{ url('/dashboard') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('dashboard') ? 'text-white underline' : 'text-gray-300' }}">Dashboard</a>
                    <a href="{{ url('/master/data') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('master/data') ? 'text-white underline' : 'text-gray-300' }}">Data</a>
                    <a href="{{ url('/master/input') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('master/input') ? 'text-white underline' : 'text-gray-300' }}">Input</a>
                    <a href="{{ url('/process-entry') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('process-entry') ? 'text-white underline' : 'text-gray-300' }}">Process
                        Entry</a>
                    {{-- <a href="{{ url('/notifikasi/report') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('notifikasi/report') ? 'text-white underline' : 'text-gray-300' }}">Notifikasi
                        Report</a> --}}

                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('notifikasi/report') ? 'text-white underline' : 'text-gray-300' }} {{ Request::is('notifikasi/report/approval') ? 'text-white underline' : 'text-gray-300' }}"
                        type="button">
                        <span class="flex items-center">
                            Report
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-gray-900 divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li class="border-b border-gray-100">
                                <a href="{{ url('/notifikasi/report') }}"
                                    class="block px-4 py-2 hover:bg-blue-500 hover:text-white dark:hover:bg-gray-600 dark:hover:text-white">Notifikasi
                                    Report</a>
                            </li>
                            <li>
                                <a href="{{ url('/notifikasi/report/approval') }}"
                                    class="block px-4 py-2 hover:bg-blue-500 hover:text-white dark:hover:bg-gray-600 dark:hover:text-white">Report
                                    Approval</a>
                            </li>
                        </ul>
                    </div>

                    {{-- <a href="{{ url('/notifikasi/report/approval') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('notifikasi/report/approval') ? 'text-white underline' : 'text-gray-300' }}">Report
                        Approval</a> --}}
                    <a href="{{ url('/login') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('/login') ? 'text-white underline' : 'text-gray-300' }}">Logout</a>

                </div>
            </div>
        </div>
    </div>
</nav>
