@extends('layouts.admin')

@section('title', 'User')

@section('css')

@endsection

@section('js')
    <script>
        $(function () {
            @if(session('isModalOpen'))
            $('#updateUserModal').modal('show');
            @endif

            const formSubmit = document.getElementById("delete-form");

            $("#deleteUserModal").on("show.bs.modal", (e) => {
                formSubmit.action = route(
                    "admin.user.destroy",
                    $(e.relatedTarget).data("id")
                );
            });
        });
    </script>
@endsection

@section('content')

<x-content>
    <x-slot name="modul">
        <h1>Users</h1>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <button class="mx-1 btn btn-success" data-target="#createUserModal" data-toggle="modal">Tambah</button>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width: 72px"><i class="fas fa-cog"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                   class="btn btn-primary btn-icon"><i
                                        class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-danger btn-icon" data-target="#deleteUserModal"
                                        data-toggle="modal" data-id="{{ $user->id }}"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-content>
@if(session('isModalOpen'))
    @include('admin.pages.user.partials.update-modal', ['user' => session('data')])
@endif
@include('admin.pages.user.partials.delete-modal')
@include('admin.pages.user.partials.create-modal')
@endsection
