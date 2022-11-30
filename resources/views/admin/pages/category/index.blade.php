@extends('layouts.admin')

@section('title', 'Daftar Kategori')

@section('css')

@endsection

@section('js')
    <script>
        $(function () {
            @if(session('isModalOpen'))
            $('#updateCategoryModal').modal('show');
            @endif

            const formSubmit = document.getElementById("delete-form");

            $("#deleteCategoryModal").on("show.bs.modal", (e) => {
                formSubmit.action = route(
                    "admin.category.destroy",
                    $(e.relatedTarget).data("id")
                );
            });
        });
    </script>
@endsection

@section('content')

    <x-content>
        <x-slot name="modul">
            <h1>Daftar Kategori</h1>
        </x-slot>

        <div class="card">
            <div class="card-header">
                <button class="btn btn-success" data-target="#createCategoryModal" data-toggle="modal">Tambah</button>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped" id="myTable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Katgeori</th>
                            <th style="width: 72px"><i class="fas fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('admin.category.edit', $category->id) }}"
                                       class="btn btn-primary btn-icon"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <button class="btn btn-danger btn-icon" data-target="#deleteCategoryModal"
                                            data-toggle="modal" data-id="{{ $category->id }}"><i
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
        @include('admin.pages.category.partials.update-modal', ['category' => session('data')])
    @endif
    @include('admin.pages.category.partials.delete-modal')
    @include('admin.pages.category.partials.create-modal')
@endsection
