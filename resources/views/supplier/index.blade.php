@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">

            👨‍🌾 Data Petani / Supplier

        </h4>

        <a href="{{ route('supplier.create') }}" class="btn btn-warning">

            <i class="bi bi-plus-circle"></i>

            Tambah Supplier

        </a>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>

                        <th>No</th>

                        <th>Nama Supplier</th>

                        <th>Alamat</th>

                        <th>No HP</th>

                        <th width="150">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($supplier as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->nama_supplier }}</td>

                        <td>{{ $item->alamat }}</td>

                        <td>{{ $item->telepon }}</td>

                        <td>

                            <a href="{{ route('supplier.edit',$item->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form
                                action="{{ route('supplier.destroy',$item->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus supplier?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            Belum ada data supplier.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection