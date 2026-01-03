@extends('layout.erp.app')

@section('content')
<form action="{{ URL('telemedicine') }}" enctype="multipart/form-data" method="get">

  <div class="relative flex items-center justify-center py-5 md:py-10 px-4 md:px-10"
        style="background: linear-gradient(105deg, rgba(119, 245, 248, 0.50) 1.05%, rgba(255, 139, 92, 0.15) 46.17%, rgba(56, 195, 197, 0.30) 79.3%, rgba(255, 139, 92, 0.10) 92.12%);">

        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">

                <!-- Left Section -->
                <div class="md:col-span-7 text-center md:text-left">
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-semibold text-black leading-tight">24/7 Expert
                        Healthcare
                        Consultation – Right at Your
                        Fingertips</h1>
                    <p class="mt-6 md:mt-10 text-lg md:text-xl text-gray-600">Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit.
                        Aenean nulla nisi, mattis sed tortor eu, condimentum tincidunt orci. Donec sit amet rhoncus
                        lorem, ut volutpat nisi. Phasellus viverra tortor viverra nulla tempor pellentesque sed et
                        massa.</p>

                    <!-- Buttons -->
                    <div
                        class="mt-8 md:mt-14 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-4">
                        <a href="desktop.html"
                            class="px-6 py-3 bg-[#FF8B5C] text-white border-2 border-[#FF8B5C] font-bold rounded-lg transition text-lg w-full md:w-auto">
                            Book a Consultation</a>
                        <button
                            class="px-6 py-3 bg-transparent text-[#FF8B5C] border-2 border-[#FF8B5C] font-bold rounded-lg transition text-lg w-full md:w-auto">
                            View Services</button>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="md:col-span-5 flex justify-center relative mt-10 md:mt-0">
                    <!-- Background Circles -->
                    <div class="absolute top-[40px] left-1/2 transform -translate-x-1/2 w-[200px] md:w-[366px] h-[200px] md:h-[366px] rounded-full opacity-100"
                        style="background: conic-gradient(from 180deg at 50% 50%, rgba(96, 203, 205, 0.50) 175.95deg, #5BDBDD 360deg);">
                    </div>

                    <div class="absolute top-10 -right-3 md:top-4 md:-right-8 lg:top-20 lg:-right-10 xl:right-2 w-[40px] md:w-[70px] h-[40px] md:h-[70px] rounded-full opacity-100"
                        style="background: conic-gradient(from 180deg at 50% 50%, rgba(96, 203, 205, 0.50) 175.95deg, #5BDBDD 360deg);">
                    </div>
                    <div class="absolute bottom-16 right-2 md:bottom-32 md:-right-8 lg:right-6 w-[40px] md:w-[70px] h-[40px] md:h-[70px] rounded-full opacity-100"
                        style="background: conic-gradient(from 180deg at 50% 50%, rgba(96, 203, 205, 0.50) 175.95deg, #5BDBDD 360deg);">
                    </div>
                    <div class="absolute bottom-4 left-2 md:bottom-10 md:-left-4 lg:left-0 w-[40px] md:w-[70px] h-[40px] md:h-[70px] rounded-full opacity-100"
                        style="background: conic-gradient(from 180deg at 50% 50%, rgba(96, 203, 205, 0.50) 175.95deg, #5BDBDD 360deg);">
                    </div>
                    <!-- Image -->
                    <img src="https://placehold.co/316x680" alt="home-image"
                        class="w-[180px] md:w-[316px] h-auto relative z-10 top-5 md:top-10">
                </div>
            </div>
        </div>
    </div>
</form>


@endsection
