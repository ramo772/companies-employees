@extends('layouts.main')
@section('content')

    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Companies Crud System</h2>
                </div>
                <div class="pull-right mb-2">
                    <x-button-add button class=" btn-primary " type="button" data-bs-toggle="modal"
                        data-bs-target="#create-modal">
                        Add new company </x-button-add>
                    <x-modal id="create-modal" method="post" action="{{ route('companies.store') }}">
                        <x-slot name="header"> Add new company </x-slot>
                        <x-slot name="body">
                            @include('forms.create-company')
                        </x-slot>
                    </x-modal>
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
                        <th>Address</th>
                        <th>Logo</th>
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
                ajax: "{{ url('companies') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'logo',
                        name: 'logo',
                        render: function(data, type, full, meta) {
                            return "<img src=\"" + data + "\" height=\"75\"/>";
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

        });
    </script>
@endsection
