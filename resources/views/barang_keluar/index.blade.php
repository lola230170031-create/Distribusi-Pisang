@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            🚚 Data Distribusi Pisang
        </h4>

        <a href="{{ route('barang-keluar.create') }}" class="btn btn-warning">
            <i class="bi bi-plus-circle"></i> Tambah Distribusi
        </a>

    </div>

    <div class="card-body">

        {{-- Alert Notifikasi dengan tombol closing --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-danger">

                    <tr>

                        <th width="60" class="text-center">No</th>

                        <th>Jenis Pisang</th>

                        <th>Tanggal Distribusi</th>

                        <th>Jumlah (Kg)</th>

                        <th>Tujuan Pengiriman</th>

                        <th width="170" class="text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($barangKeluar as $item)

                    <tr>

                        <td class="text-center">{{ $loop->iteration }}</td>

                        <td>
                            {{-- Nullsafe: Mencegah crash jika relasi barang null --}}
                            {{ $item->barang?->nama_barang ?? 'Barang Dihapus/Tidak Ditemukan' }}
                        </td>

                        <td>
                            {{-- Format tanggal Indonesia yang rapi --}}
                            {{ \Carbon\Carbon::parse($item->tanggal_keluar)->translatedFormat('d F Y') }}
                        </td>

                        <td>

                            <span class="badge bg-danger">

                                {{ number_format($item->jumlah, 0, ',', '.') }} Kg

                            </span>

                        </td>

                        <td>{{ $item->tujuan }}</td>

                        <td class="text-center">

                            <a href="{{ route('barang-keluar.edit', $item->id) }}"
                               class="btn btn-warning btn-sm"
                               title="Edit Data">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form action="{{ route('barang-keluar.destroy', $item->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus distribusi ini? Stok akan dikembalikan ke gudang.')"
                                        title="Hapus Data">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center text-muted py-4">

                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                            Belum ada data distribusi pisang.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection