@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">

            📥 Data Pisang Masuk

        </h4>

        <a href="{{ route('barang-masuk.create') }}" class="btn btn-warning">

            <i class="bi bi-plus-circle"></i>

            Tambah Pisang Masuk

        </a>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-success">

                    <tr>

                        <th width="60">No</th>

                        <th>Jenis Pisang</th>

                        <th>Petani / Supplier</th>

                        <th>Jumlah (Kg)</th>

                        <th>Tanggal Masuk</th>

                        <th width="170">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($barangMasuk as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            {{ $item->barang->nama_barang }}

                        </td>

                        <td>

                            {{ $item->supplier->nama_supplier }}

                        </td>

                        <td>

                            <span class="badge bg-success">

                                {{ $item->jumlah }} Kg

                            </span>

                        </td>

                        <td>

                            {{ $item->tanggal_masuk }}

                        </td>

                        <td>

                            <a href="{{ route('barang-masuk.edit',$item->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form
                                action="{{ route('barang-masuk.destroy',$item->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Belum ada data pisang masuk.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection