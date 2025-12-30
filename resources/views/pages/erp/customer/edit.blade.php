 @extends('layout.erp.app');

 @section('content')
     <div class="container-fluid">
         <div class="row">
             <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">
                 <h3 class="mb-4">Add New Customer</h3>

                 <form action="{{ URL('customer/update', $customer->id) }}" method="post" class="p-4 border rounded"
                     enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                     <div class="mb-3">
                         <label for="name" class="form-label">Customer Name</label>
                         <input type="text" value="{{ $customer->name }}" class="form-control" id="name"
                             name="name" placeholder="Enter name">
                     </div>

                     <div class="mb-3">
                         <label for="email" class="form-label">Customer Email</label>
                         <input type="email" value="{{ $customer->email }}" class="form-control" id="email"
                             name="email" placeholder="Enter email">
                     </div>



                     <div class="mb-3">
                         <label for="address" class="form-label">Customer Address</label>
                         <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address">{{ $customer->address }}</textarea>
                     </div>

                     <div class="mb-3">
                         <label for="photo" class="form-label">Customer Photo</label>
                         <input type="file" value="{{ $customer->photo }}" class="form-control" name="photo"
                             id="photo">
                     </div>

                     <button type="submit" class="btn btn-primary">Save Customer</button>
                     <button type="reset" class="btn btn-secondary">Reset</button>
                 </form>
             </div>
         </div>

     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 @endsection
