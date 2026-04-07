<nav class="bg-blue-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-white text-xl font-bold">🏥 Patient Health Management</h1>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    @auth
                        <a href="{{ route('patients.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Patients</a>
                        <a href="{{ route('appointments.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Appointments</a>
                        <a href="{{ route('medical-records.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Medical Records</a>
                        <a href="{{ route('symptoms.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Symptoms</a>
                        <a href="{{ route('test-results.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Test Results</a>
                        
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Admin</a>
                        @endif
                    @endauth
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                @auth
                    <div class="flex items-center space-x-3">
                        <span class="text-white text-sm font-medium">
                            Welcome, {{ auth()->user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm font-medium transition duration-200">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-md text-sm font-medium transition duration-200">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>