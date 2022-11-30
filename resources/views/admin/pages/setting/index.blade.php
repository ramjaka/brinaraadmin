@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('css')

@endsection

@section('js')

@endsection

@section('content')

    <x-content>
        <x-slot name="modul">
            <h1>Pengaturan</h1>
        </x-slot>

        <div class="card">
            <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="col-12">
                        <div class="row my-2">
                            <div class="col-2 my-auto">
                                <h6>Nama Perusahaan</h6>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" name="name" value="{{ $setting->company_name }}">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-2 my-auto">
                                <h6>Telepon</h6>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" name="phone" value="{{ $setting->company_phone }}">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-2 my-auto">
                                <h6>Alamat</h6>
                            </div>
                            <div class="col-6">
                                <textarea type="text" class="form-control" style="height: 120px"
                                          name="address">{{ $setting->company_address }}</textarea>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-2 my-auto">
                                <h6>Logo Perusahaan</h6>
                            </div>
                            <div class="col-4">
                                <input type="file" class="form-control" name="company_logo">
                                @if($setting->hasLogoImage())
                                    <div class="mt-2">
                                        <img src="{{ $setting->getLogoImage() }}" alt="Logo">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-2 my-auto">
                                <h6>Kartu Member</h6>
                            </div>
                            <div class="col-4">
                                <input type="file" class="form-control" name="member_card">
                                @if($setting->hasMemberCardImage())
                                    <div class="mt-2">
                                        <img src="{{ $setting->getMemberCardImage() }}" alt="Member Card">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-2 my-auto">
                                <h6>Diskon (%)</h6>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="discount"
                                       value="{{ $setting->company_discount }}">
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>

    </x-content>
@endsection
