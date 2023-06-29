<nav class="bg-gray-900 fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
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
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('process-entry') ? 'text-white underline' : 'text-gray-300' }}">Entry</a>
                    <a href="{{ url('/notifikasi/report') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('notifikasi/report') ? 'text-white underline' : 'text-gray-300' }}">Notifikasi
                        Report</a>
                    <a href="{{ url('/notifikasi/report/approval') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('notifikasi/report/approval') ? 'text-white underline' : 'text-gray-300' }}">Report
                        Approval</a>
                    <a href="{{ url('/login') }}"
                        class="hover:text-white px-3 py-2 rounded-md text-sm font-medium flex-grow {{ Request::is('/login') ? 'text-white underline' : 'text-gray-300' }}">Logout</a>
                    <div class="flex-grow"></div>
                </div>
            </div>
        </div>
    </div>
</nav>
