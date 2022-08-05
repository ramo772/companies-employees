@extends('layouts.main')
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Employee Crud System</h2>
                </div>
                <div class="form-group">
                    <label><strong>Company :</strong></label>
                    <select id='company' class="form-control" style="width: 200px">
                        <option value="">--Select Company--</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered" id="datatable-crud">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th style="
                        width: 20%;
                    ">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#datatable-crud').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('employees.index') }}",
                    data: function(d) {
                        d.company = $('#company').val(),
                        d.search = $('input[type="search"]').val()

                    }
                },

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },

                    {
                        data: 'profile_image',
                        name: 'profile_image',
                        render: function(data, type, full, meta) {
                            return "<img src=\"/storage/" + data + "\" height=\"50\"/>";
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });
            $('#company').change(function(e) {
                var table = $('#datatable-crud').DataTable();

                table.draw();
            });

        });
    </script>
@endsection
