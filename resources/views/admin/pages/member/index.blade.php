@extends('layouts.admin')

@section('title', 'Member')

@section('css')

@endsection

@section('js')
    <script>
        $(function () {
            @if(session('isModalOpen'))
            $('#updateMemberModal').modal('show');
            @endif

            const formSubmit = document.getElementById("delete-form");

            $("#deleteMemberModal").on("show.bs.modal", (e) => {
                formSubmit.action = route(
                    "admin.member.destroy",
                    $(e.relatedTarget).data("id")
                );
            });
        });
    </script>
@endsection

@section('content')

<x-content>
    <x-slot name="modul">
        <h1>Member</h1>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <button class="mx-1 btn btn-success" data-target="#createMemberModal" data-toggle="modal">Tambah</button>
            <a href="{{ route('admin.member.download') }}" class="mx-1 btn btn-warning"><i class="fas fa-id-card"></i> Cetak Member</a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th style="width: 72px"><i class="fas fa-cog"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $member->code }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->phone }}</td>
                            <td>{{ $member->address }}</td>
                            <td>
                                <a href="{{ route('admin.member.edit', $member->id) }}"
                                   class="btn btn-primary btn-icon"><i
                                        class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-danger btn-icon" data-target="#deleteMemberModal"
                                        data-toggle="modal" data-id="{{ $member->id }}"><i
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
    @include('admin.pages.member.partials.update-modal', ['member' => session('data')])
@endif
@include('admin.pages.member.partials.delete-modal')
@include('admin.pages.member.partials.create-modal')
@endsection
