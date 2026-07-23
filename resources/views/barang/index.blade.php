@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            🍌 Data Pisang
        </h4>

        @if(auth()->user()->role == 'admin')

        <div>

            <a href="{{ route('barang.create') }}" class="btn btn-warning">

                <i class="bi bi-plus-circle"></i>

                Tambah Pisang

            </a>

            {{-- 
<a href="{{ route('laporan.barang.pdf') }}" class="btn btn-danger">
    <i class="bi bi-file-earmark-pdf"></i>
    Export PDF
</a>
--}}
        </div>

        @endif

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        <form method="GET" action="{{ route('barang.index') }}" class="row mb-4">

            <div class="col-md-9">

                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    value="{{ $keyword }}"
                    placeholder="Cari nama atau kode pisang...">

            </div>

            <div class="col-md-3">

                <button class="btn btn-success w-100">

                    <i class="bi bi-search"></i>

                    Cari

                </button>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-success">

                    <tr>

                        <th width="60">No</th>

                        <th>Kode</th>

                        <th>Jenis Pisang</th>

                        <th>Kategori</th>

                        <th>Stok</th>

                        <th>Harga / Kg</th>

                        <th>Keterangan</th>

                        @if(auth()->user()->role == 'admin')

                        <th width="160">Aksi</th>

                        @endif

                    </tr>

                </thead>

                <tbody>

                @forelse($barang as $item)

                    <tr>

                        <td>

                            {{ ($barang->currentPage()-1) * $barang->perPage() + $loop->iteration }}

                        </td>

                        <td>

                            {{ $item->kode_barang }}

                        </td>

                        <td>

                            {{ $item->nama_barang }}

                        </td>

                        <td>

                            {{ $item->kategori->nama_kategori }}

                        </td>

                        <td>

                            @if($item->stok > 100)

                                <span class="badge bg-success">

                                    {{ $item->stok }} Kg

                                </span>

                            @elseif($item->stok > 30)

                                <span class="badge bg-warning text-dark">

                                    {{ $item->stok }} Kg

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    {{ $item->stok }} Kg

                                </span>

                            @endif

                        </td>

                        <td>

                            Rp {{ number_format($item->harga,0,',','.') }}

                        </td>

                        <td>

                            {{ $item->deskripsi }}

                        </td>

                        @if(auth()->user()->role == 'admin')

                        <td>

                            <a href="{{ route('barang.edit',$item->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form
                                action="{{ route('barang.destroy',$item->id) }}"
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

                        @endif

                    </tr>

                @empty

                    <tr>

                        <td colspan="{{ auth()->user()->role == 'admin' ? 8 : 7 }}"
                            class="text-center">

                            Belum ada data pisang.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $barang->links() }}

        </div>

    </div>

</div>

@endsection