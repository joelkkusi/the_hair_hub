<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <center>
                        <div class="mb-4">
                            {{ __('Edit Appointment') }}
                        </div>
                        <form method="POST" action="/appointment/{{ $appointments->id }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-4">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="border-2 rounded-md p-2 w-full" value="{{ $appointments->date }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="time">Time</label>
                                <select name="time" id="time" class="form-control">
                                    @foreach($timeBlocks as $time)
                                    <option value="{{ $time }}" {{ $appointments->time == $time ? 'selected' : '' }}>{{ $time }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="comment">Comment</label>
                                <input type="text" name="comment" id="comment" class="border-2 rounded-md p-2 w-full" value="{{ $appointments->comment }}">
                            </div>
                            <div class="mb-4">
                                <label for="employee_id">Employee</label>
                                <select name="employee_id" id="employee_id" class="border-2 rounded-md p-2 w-full" required>
                                    <option disabled>Choose an employee</option>
                                    @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" class="border-2 rounded-md p-2 w-full" required>
                                    <option disabled>Choose an customer</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="border-2 rounded-md p-2 w-full" required>
                                    <option disabled>Current: {{ $appointments->status }}</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Cancelled">Declined</option>
                                </select>
                            </div>

                            <x-secondary-button>
                                <a href="{{ route('appointment.show') }}">
                                    {{ __('Cancel') }}
                                </a>
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Edit Appointment') }}
                            </x-primary-button>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>