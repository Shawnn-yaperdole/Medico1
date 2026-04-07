<nav class="bg-blue-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-white text-xl font-bold">🏥 Patient Health Management</h1>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('patients.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Patients</a>
                    <a href="{{ route('appointments.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Appointments</a>
                    <a href="{{ route('medical-records.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Medical Records</a>
                    <a href="{{ route('symptoms.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Symptoms</a>
                    <a href="{{ route('test-results.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Test Results</a>
                </div>
            </div>
        </div>
    </div>
</nav>