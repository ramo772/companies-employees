<div class="d-flex">

    <x-operation-button  type="button" type="button" data-bs-toggle="modal"
        data-bs-target="#edit-modal-{{ $id }}" data-id="{{ $id }}" data-url="">
        Update Company </x-operation-button>

    <x-modal id="edit-modal-{{ $id }}" method="put" role="document"
        action="{{ route('companies.update', $id) }}">
        <x-slot name="header">Update Company</x-slot>
        <x-slot name="body">
            @include('forms.edit-company')
        </x-slot>
    </x-modal>
    <x-operation-button type="button" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $id }}"
        data-id="{{ $id }}" data-url="{{ $id }}">
        Delete Company</x-operation-button>
    <x-modal id="delete-modal-{{ $id }}" method="delete" action="{{ route('companies.destroy', $id) }}">
        <x-slot name="header"> delete company </x-slot>
        <x-slot name="body">
        </x-slot>
    </x-modal>
    <x-operation-button type="button" type="button" data-bs-toggle="modal"
        data-bs-target="#create-modal-{{ $id }}" data-id="{{ $id }}" data-url="">
        Add Employee </x-operation-button>
    <x-modal id="create-modal-{{ $id }}" method="post" role="document"
        action="{{ route('employees.store', $id) }}">
        <x-slot name="header">Add Employee</x-slot>
        <x-slot name="body">
            @include('forms.create-employee')
        </x-slot>
    </x-modal>


</div>
