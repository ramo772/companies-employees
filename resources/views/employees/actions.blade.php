<div class="d-flex">

    <x-operation-button  type="button" type="button" data-bs-toggle="modal"
        data-bs-target="#edit-modal-{{ $id }}" data-id="{{ $id }}" data-url="">
        Update employee </x-operation-button>

    <x-modal id="edit-modal-{{ $id }}" method="put" role="document"
        action="{{ route('employees.update', $id) }}">
        <x-slot name="header">Update employee</x-slot>
        <x-slot name="body">
            @include('forms.edit-employee')
        </x-slot>

    </x-modal>


    <x-operation-button type="button" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $id }}"
        data-id="{{ $id }}" data-url="{{ $id }}">
        Delete employee</x-operation-button>
    <x-modal id="delete-modal-{{ $id }}" method="delete" action="{{ route('employees.destroy', $id) }}">
        <x-slot name="header"> delete employee </x-slot>
        <x-slot name="body">
        </x-slot>
    </x-modal>





</div>
