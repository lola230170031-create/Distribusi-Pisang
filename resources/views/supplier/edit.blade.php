@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h4 class="mb-0">

            ✏️ Edit Petani / Supplier

        </h4>

    </div>

    <div class="card-body">

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('supplier.update',$supplier->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">

                    Nama Petani / Supplier

                </label>

                <input
                    type="text"
                    name="nama_supplier"
                    class="form-control"
                    value="{{ $supplier->nama_supplier }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Alamat

                </label>

                <textarea
                    name="alamat"
                    rows="4"
                    class="form-control"
                    required>{{ $supplier->alamat }}</textarea>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Nomor Telepon

                        </label>

                        <input
                            type="text"
                            name="telepon"
                            class="form-control"
                            value="{{ $supplier->telepon }}"
                            required>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ $supplier->email }}">

                    </div>

                </div>

            </div>

            <div class="d-flex justify-content-between">

                <a href="{{ route('supplier.index') }}" class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

                <button type="submit" class="btn btn-warning">

                    <i class="bi bi-check-circle"></i>

                    Update Data

                </button>

            </div>

        </form>

    </div>

</div>

@endsection