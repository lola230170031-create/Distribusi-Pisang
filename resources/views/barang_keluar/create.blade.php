@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-danger text-white">

        <h4 class="mb-0">

            🚚 Tambah Distribusi Pisang

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

        <form action="{{ route('barang-keluar.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Jenis Pisang

                </label>

                <select
                    name="barang_id"
                    class="form-select"
                    required>

                    <option value="">

                        -- Pilih Jenis Pisang --

                    </option>

                    @foreach($barang as $item)

                        <option value="{{ $item->id }}">

                            {{ $item->nama_barang }}

                            (Stok : {{ $item->stok }} Kg)

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Tanggal Distribusi

                        </label>

                        <input
                            type="date"
                            name="tanggal_keluar"
                            class="form-control"
                            required>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Jumlah (Kg)

                        </label>

                        <input
                            type="number"
                            name="jumlah"
                            class="form-control"
                            placeholder="Masukkan jumlah distribusi"
                            required>

                    </div>

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Tujuan Pengiriman

                </label>

                <input
                    type="text"
                    name="tujuan"
                    class="form-control"
                    placeholder="Contoh: Supermarket ABC, Pasar Induk Medan"
                    required>

            </div>

            <div class="d-flex justify-content-between">

                <a href="{{ route('barang-keluar.index') }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

                <button class="btn btn-danger">

                    <i class="bi bi-truck"></i>

                    Simpan Distribusi

                </button>

            </div>

        </form>

    </div>

</div>

@endsection