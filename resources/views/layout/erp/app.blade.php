
{{-- header --}}

@include('layout.erp.partials.header');


{{-- sidebar --}}

  @include('layout.erp.partials.sidebar');

  <!-- Content Wrapper. Contains page content -->
 @yield("content");
  <!-- /.content-wrapper -->

  {{-- footer --}}

  @include('layout.erp.partials.footer');


   @yield("js")
 @stack("js")



