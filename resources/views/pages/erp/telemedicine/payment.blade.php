@section('content')
    <div class="content-wrapper pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h4>Payment Confirmation</h4>

                    <p>Name: {{ $appointment->name }}</p>
                    <p>Specialist: {{ $appointment->specialist }}</p>
                    <p>Date: {{ $appointment->appointment_date }}</p>
                    <p>Time: {{ $appointment->appointment_time }}</p>

                    <form method="POST" action="{{ route('telemedicine.payment.confirm') }}">
                        @csrf
                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

                        <label>
                            <input type="radio" name="payment_method" value="bkash" required> bKash
                        </label>

                        <label>
                            <input type="radio" name="payment_method" value="nagad"> Nagad
                        </label>

                        <button class="btn btn-success mt-3">
                            Confirm Payment
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

