@extends('layout.erp.app')

@section('content')
<div class="content-wrapper pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <form action="{{ url('telemedicine.payment') }}" method="GET">
                    <h4>This is payment Confirmation page</h4>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
