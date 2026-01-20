@extends('layout.erp.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid pt-5">
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
                        <form method="post" action="{{ route('telemedicine.save') }}">
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

                                <!-- Date of Birth -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="date_of_birth" class="form-control rounded-3" id="floatingDOB" placeholder="Date of Birth" required>
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

                                <!-- Specialist Service -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="specialist" id="department" required>
                                            <option value="">Select Specialist Service</option>
                                            @foreach ($departments as $department)
<option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        <label>Specialist Service*</label>
                                    </div>
                                </div>

                                <!-- Doctor -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="doctor" id="doctor" required>
                                            <option value="">Select Doctor</option>
                                        </select>
                                        <label>Doctor*</label>
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
                                    <button type="submit" class="btn btn-primary px-5">
                                        Send Appointment Request
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AJAX for dynamic doctor dropdown -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const departmentSelect = document.getElementById('department');
    const doctorSelect = document.getElementById('doctor');

    departmentSelect.addEventListener('change', function () {
        const departmentName = this.value;
        doctorSelect.innerHTML = '<option value="">Loading...</option>';

        fetch("{{ url('/get-doctors') }}/" + encodeURIComponent(departmentName))
            .then(response => response.json())
            .then(data => {
                doctorSelect.innerHTML = '<option value="">Select Doctor</option>';
                if (data.length === 0) {
                    doctorSelect.innerHTML += '<option value="">No doctors available</option>';
                }
                data.forEach(doctor => {
                    doctorSelect.innerHTML += `<option value="${doctor.name}">${doctor.name}</option>`;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                doctorSelect.innerHTML = '<option value="">Error loading doctors</option>';
            });
    });
});
</script>
@endsection
