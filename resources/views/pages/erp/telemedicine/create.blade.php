@extends('layout.erp.app')

@section('content')

<!-- Start Appointment Area -->
<div class="content-wrapper">
    <div class="container-fluid pt-5"> <!-- pt-5 to clear fixed header -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-10 col-xl-10">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">

                        <!-- Header -->
                        <div class="text-center mb-4 mb-md-5">
                            <h1 class="display-5 fw-bold">Book Appointment</h1>
                            <p class="lead text-muted">Fill in your information below and we’ll connect you with a specialist.</p>
                        </div>

                        <!-- Form -->
                        <form method="GET" action="{{ URL('telemedicine/save') }}">
                            @csrf
                            <div class="row g-3">

                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control rounded-3" id="floatingName" placeholder="Name" required>
                                        <label for="floatingName">Name*</label>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control rounded-3" id="floatingEmail" placeholder="Email" required>
                                        <label for="floatingEmail">Email*</label>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="phone" class="form-control rounded-3" id="floatingPhone" placeholder="Phone Number" required>
                                        <label for="floatingPhone">Phone Number*</label>
                                    </div>
                                </div>

                                <!-- DOB -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="dob" class="form-control rounded-3" id="floatingDOB" placeholder="Date of Birth" required>
                                        <label for="floatingDOB">Date of Birth*</label>
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="col-12">
                                    <label class="form-label fw-bold mb-2">Gender:</label>
                                    <div class="d-flex gap-3 flex-wrap">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" required>
                                            <label class="form-check-label" for="genderMale">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female">
                                            <label class="form-check-label" for="genderFemale">Female</label>
                                        </div>

                                    </div>
                                </div>

                                <!-- Service -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select rounded-3" name="service" id="floatingService" required>
                                            <option value="" disabled selected>Select Specialist Service*</option>
                                            <option value="Child Specialist">pediatric</option>
                                            <option value="Medicine Specialist">Medicine Specialist</option>
                                            <option value="Emergency Dentistry">Emergency Dentistry</option>
                                            <option value="Orthopedist">Orthopedist</option>
                                        </select>
                                        <label for="floatingService">Specialist Service*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select rounded-3" name="doctor" id="floatingDoctor" required>
                                            <option value="" disabled selected>Select doctor*</option>
                                            <option value=""></option>
                                            <option value=""></option>
                                            <option value=""></option>
                                            <option value=""></option>
                                        </select>
                                        <label for="floatingDoctor">Doctor*</label>
                                    </div>
                                </div>

                                <!-- Appointment Date -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="appointment_date" class="form-control rounded-3" id="floatingAppointmentDate" placeholder="Appointment Date" required>
                                        <label for="floatingAppointmentDate">Appointment Date*</label>
                                    </div>
                                </div>

                                <!-- Appointment Time -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="time" name="appointment_time" class="form-control rounded-3" id="floatingAppointmentTime" placeholder="Appointment Time" required>
                                        <label for="floatingAppointmentTime">Appointment Time*</label>
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="notes" class="form-control rounded-3" placeholder="Notes" id="floatingNotes" style="height: 100px;"></textarea>
                                        <label for="floatingNotes">Notes (Optional)</label>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-12 text-center">
                                    <a href="{{ route('telemedicine.payment') }}" type="submit"  class="btn btn-primary rounded-3 shadow-sm px-5 py-2">Send Appointment Request</a>
                               <form  action="{{ route('telemedicine.payment') }}" method="GET"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Appointment Area -->

@endsection
