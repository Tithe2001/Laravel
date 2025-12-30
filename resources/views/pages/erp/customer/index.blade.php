@extends('layout.erp.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid px-4 pt-4">

            <h3 class="mb-4">Customer List</h3>
            <div> <a href="{{ url('customer/create') }}" class="btn btn-primary">
        Create Customer
    </a></div>

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <form action="{{ URL('customer') }}" method="GET" enctype="multipart/form-data">

                            <div class="mb-3">
                                <input value="{{ request('search') }}" type="text" class="form-control" id="search"
                                    name="search" placeholder="Search data">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>

                        </form>

                        <table class="table table-bordered table-striped align-middle text-center mb-0">
                            <thead  class="table-white text-dark">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th width="10%">Photo</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>
                                            <img src="{{ $customer->photo }}" class="img-fluid rounded" width="50"
                                                alt="photo">
                                        </td>
                                        <td>
                                            <a href="{{ url('customer/edit/' . $customer->id) }}"
                                                class="btn btn-sm btn-secondary">
                                                Edit
                                            </a>

                                            <form action="{{ url('customer/delete/' . $customer->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')"
                                                    class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
     {{-- <div class="">
        {{ $customers->appends(request()->query())->links() }}
    </div> --}}
@endsection
