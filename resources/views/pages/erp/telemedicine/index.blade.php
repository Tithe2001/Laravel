@extends('layout.erp.app')

@section('content')
    <div class="content-wrapper"> {{-- IMPORTANT --}}
        <form action="{{ url('telemedicine') }}" method="GET">

            <div class="py-5 px-4"
                style="background: linear-gradient(105deg, rgba(119,245,248,0.50) 1.05%, rgba(255,139,92,0.15) 46.17%, rgba(56,195,197,0.30) 79.3%, rgba(255,139,92,0.10) 92.12%);">

                <div class="container-fluid"> {{-- container-fluid is IMPORTANT --}}
                    <div class="row align-items-center g-4">

                        <!-- Left Content -->
                        <div class="col-lg-7 col-md-12 text-center text-lg-start">
                            <h1 class="fw-bold display-5">
                                24/7 Expert Healthcare Consultation – Right at Your Fingertips
                            </h1>

                            <p class="mt-4 text-muted fs-5">
                                Connect instantly with certified doctors and healthcare professionals for trusted medical
                                advice,
                                first-aid guidance, and prescription support — anytime, anywhere.
                            </p>

                            <div
                                class="mt-4 d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                                <a href="{{ route('telemedicine.create') }}" class="btn btn-primary btn-lg"
                                    style="background:#FF8B5C;border-color:#FF8B5C;">
                                    Book a Consultation
                                </a>
                                <form  action="{{ route('telemedicine.create') }}" method="GET"
                                        class="d-none">
                                        @csrf
                                    </form>

                                <button type="button" class="btn btn-outline-primary btn-lg"
                                    style="color:#FF8B5C;border-color:#FF8B5C;">
                                    View Services
                                </button>
                            </div>
                        </div>

                        <!-- Right Image -->
                        <div class="col-lg-5 col-md-12 text-center mt-4 mt-lg-0">
                            <img src="{{ asset('assets') }}/images/home-blog_1.png" class="img-fluid mx-auto" style="max-height:680px;"
                                alt="Telemedicine">
                        </div>

                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
