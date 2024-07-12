<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('appointment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = User::where('usertype', 'Employee')->get();
        $customers = User::where('usertype', 'Customer')->get();
        $timeBlocks = $this->generateTimeBlocks('09:00', '18:00', '30');

        return view('appointment.create', compact('employees', 'customers', 'timeBlocks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request...
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|in:' . implode(',', $this->generateTimeBlocks('09:00', '17:00', 30)),
            'comment' => 'nullable',
            'employee_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:users,id',
            'status' => 'required|in:Pending,Approved,Declined',
        ]);

        if ($this->hasConflict($request->date, $request->time, $request->employee_id)) {
            return redirect()->back()->withErrors(['time' => 'This time slot is already taken.']);
        }

        Appointment::create($request->all());

        return redirect()->route('appointment.show')->with('success', 'Appointment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $appointments = Appointment::all();
        $filter = $request->query('filter');

        if ($filter) {
            $appointments = Appointment::where('status', $filter)->get();
        } else {
            $appointments = Appointment::whereIn('status', ['Pending', 'Approved', 'Declined'])->get();
        }

        return view('appointment.show', compact('appointments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $appointments = Appointment::findOrFail($id);
        $employees = User::where('usertype', 'Employee')->get();
        $customers = User::where('usertype', 'Customer')->get();
        $timeBlocks = $this->generateTimeBlocks('09:00', '17:00', 30);

        return view('appointment.edit', compact('appointments', 'employees', 'customers', 'timeBlocks'));
    }

    private function generateTimeBlocks($start, $end, $interval)
    {
        $startTime = strtotime($start);
        $endTime = strtotime($end);
        $timeBlocks = [];

        for ($current = $startTime; $current <= $endTime; $current = strtotime("+$interval minutes", $current)) {
            $timeBlocks[] = date('H:i', $current);
        }

        return $timeBlocks;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request...
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|in:' . implode(',', $this->generateTimeBlocks('09:00', '17:00', 30)),
            'comment' => 'nullable',
            'employee_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:users,id',
            'status' => 'required|in:Pending,Approved,Declined',
        ]);

        if ($this->hasConflict($request->date, $request->time, $request->employee_id, $id)) {
            return redirect()->back()->withErrors(['time' => 'This time slot is already taken.']);
        }

        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return redirect()->route('appointment.show')->with('success', 'Appointment updated successfully!');
    }

    private function hasConflict($date, $time, $employee_id, $excludeAppointmentId = null)
    {
        $query = Appointment::where('date', $date)
            ->where('time', $time)
            ->where('employee_id', $employee_id);


        if ($excludeAppointmentId) {
            $query->where('id', '!=', $excludeAppointmentId);
        }

        return $query->exists();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointment.show')->with('success', 'Appointment deleted successfully!');
    }

    public function totalHoursWorked(Request $request)
    {
        $employees = User::where('usertype', 'Employee')->get();
        $totalHours = [];

        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
        }
        if (!$endDate) {
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        foreach ($employees as $employee) {
            $totalMinutes = Appointment::where('employee_id', $employee->id)
                ->where('status', 'Approved')
                ->whereBetween('date', [$startDate, $endDate])
                ->sum('duration');

            $totalHours[$employee->id] = round($totalMinutes / 60, 2);
        }

        return view('appointment.totalHours', compact('employees', 'totalHours', 'startDate', 'endDate'));
    }
}
