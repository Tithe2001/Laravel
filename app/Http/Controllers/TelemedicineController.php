<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentMeetMail;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Telemedicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TelemedicineController extends Controller
{
   public function index()
    {
        $appointments = Telemedicine::with('doctor')->get();
        return view('pages.erp.telemedicine.index', compact('appointments'));
    }

    // Show form to create new appointment
    public function create()
    {
        $departments = Department::all();
        $doctors = Doctor::all();
        return view('pages.erp.telemedicine.create', compact('departments', 'doctors'));
    }

    // Show payment form (general, no specific appointment)
    public function paymentForm()
    {
        return view('pages.erp.telemedicine.payment_form');
    }

    // Show payment for a specific appointment
    public function payment($id)
    {
        $appointment = Telemedicine::findOrFail($id);
        return view('pages.erp.telemedicine.payment', compact('appointment'));
    }

    // Confirm payment (POST)
    public function confirmPayment(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|integer|exists:lav_telemedicines,id',
        ]);

        $appointment = Telemedicine::findOrFail($request->appointment_id);
        $appointment->payment_status = 'Paid';
        $appointment->save();

        return redirect()->route('pages.erp.telemedicine.index')->with('success', 'Payment confirmed.');
    }

    // Store new appointment
  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'date_of_birth' => 'required|date',
        'gender' => 'required|in:Male,Female',
        'specialist' => 'required|string|max:255',
        'doctor' => 'required|string|max:255',
        'appointment_date' => 'required|date',
        'appointment_time' => 'required',
    ]);

    $appointment = new Telemedicine();
    $appointment->name = $request->name;
    $appointment->email = $request->email;
    $appointment->phone = $request->phone;
    $appointment->date_of_birth = $request->date_of_birth;
    $appointment->gender = $request->gender;
    $appointment->specialist = $request->specialist;
    $appointment->doctor = $request->doctor;
    $appointment->appointment_date = $request->appointment_date;
    $appointment->appointment_time = $request->appointment_time;
    $appointment->save();

    return redirect()->route('telemedicine.index')->with('success', 'Appointment booked successfully.');
}


    // AJAX: get doctors by department
    public function getDoctors($department_id)
    {
        $doctors = Doctor::where('department_id', $department_id)->get();
        return response()->json($doctors);
    }
}
