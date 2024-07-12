<x-app-layout>
    <x-slot name="header">
        @if (Auth::user()->usertype == 'Admin')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Appointment') }}
        </h2>
        @elseif (Auth::user()->usertype == 'Employee')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Appointments') }}
        </h2>
        @else
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Request Appointments') }}
        </h2>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <center>
                        @if (Auth::user()->usertype == 'Admin')
                        <div class="mb-4">
                            {{ __('Create Appointment') }}
                        </div>
                        @elseif (Auth::user()->usertype == 'Employee')
                        <div class="mb-4">
                            {{ __('Create Appointments') }}
                        </div>
                        @else
                        <div class="mb-4">
                            {{ __('Request Appointments') }}
                        </div>
                        @endif
                    </center>
                    @if (Auth::user()->usertype == 'Admin' || Auth::user()->usertype == 'Employee')
                    <form method="POST" action="{{ route('appointment.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Date</label>
                            <input type="date" name="date" id="date" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        </div>
                        <label for="time">Time</label>
                        <select name="time" id="time" class="form-control">
                            @foreach($timeBlocks as $time)
                            <option value="{{ $time }}">{{ $time }}</option>
                            @endforeach
                        </select>
                        <div hidden class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Comment</label>
                            <input type="text" name="comment" id="comment" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        </div>
                        <div class="mb-4">
                            <label for="employee_id" class="block text">Employee</label>
                            <select name="employee_id" id="employee_id" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option disabled>Choose an employee</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="customer_id" class="block text">Customer</label>
                            <select name="customer_id" id="customer_id" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option disabled>Choose a customer</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                            <select name="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option disabled>Choose a status</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Declined">Declined</option>
                            </select>
                        </div>
                        <x-primary-button>
                            {{ __('Create Appointment') }}
                        </x-primary-button>
                    </form>
                    @endif

                    @if (Auth::user()->usertype == 'Customer')
                    <form method="POST" action="{{ route('appointment.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Date</label>
                            <input type="date" name="date" id="date" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        </div>
                        <div class="mb-4">
                            <label for="time" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Time</label>
                            <select name="time" id="time" class="form-input rounded-md shadow-sm mt-1 block w-full">
                                @foreach($timeBlocks as $time)
                                <option value="{{ $time }}">{{ $time }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Comment</label>
                            <input type="text" name="comment" id="comment" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        </div>
                        <div class="mb-4">
                            <label for="employee_id" class="block text">Employee</label>
                            <select name="employee_id" id="employee_id" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option disabled>Choose an employee</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div hidden class="mb-4">
                            <label for="customer_id" class="block text">Customer</label>
                            <select name="customer_id" id="customer_id">
                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                            </select>
                        </div>
                        <div hidden class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                            <select name="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <x-primary-button>
                            {{ __('Request Appointment') }}
                        </x-primary-button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>