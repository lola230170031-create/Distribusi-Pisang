@extends('layouts.app')

@section('content')

<!-- 5 Top Stat Cards -->
<div class="row">
    <!-- Jenis Pisang -->
    <div class="col-md-3">
        <div class="card card-stat bg-success text-white shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-white-50">Jenis Pisang</small>
                    <h2 class="fw-bold mb-0">{{ $totalJenis }}</h2>
                </div>
                <i class="bi bi-basket fs-1 text-white-50"></i>
            </div>
        </div>
    </div>

    <!-- Supplier -->
    <div class="col-md-3">
        <div class="card card-stat bg-primary text-white shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-white-50">Supplier</small>
                    <h2 class="fw-bold mb-0">{{ $totalSupplier }}</h2>
                </div>
                <i class="bi bi-people fs-1 text-white-50"></i>
            </div>
        </div>
    </div>

    <!-- Total Stok -->
    <div class="col-md-3">
        <div class="card card-stat bg-warning text-dark shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-dark-50">Total Stok</small>
                    <h2 class="fw-bold mb-0">{{ $totalStok }} Kg</h2>
                </div>
                <i class="bi bi-box-seam fs-1 text-dark-50"></i>
            </div>
        </div>
    </div>

    <!-- Stok Habis -->
    <div class="col-md-3">
        <div class="card card-stat bg-danger text-white shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-white-50">Stok Habis</small>
                    <h2 class="fw-bold mb-0">{{ $stokHabis }}</h2>
                </div>
                <i class="bi bi-exclamation-triangle fs-1 text-white-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 mt-3">
    <div class="card bg-info text-white shadow">
        <div class="card-body">

            <h6>Total Nilai Persediaan</h6>

            <h3 class="fw-bold">
                Rp {{ number_format($totalNilaiPersediaan,0,',','.') }}
            </h3>

        </div>
    </div>
</div>

<!-- Middle Section: Chart & Informasi Gudang -->
<div class="row mt-2">
    <!-- Grafik Aktivitas Gudang -->
    <div class="col-md-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-success text-white fw-bold">
                <i class="bi bi-bar-chart-line me-1"></i> Grafik Aktivitas Gudang
            </div>
            <div class="card-body">
                <canvas id="gudangChart" style="max-height: 280px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Informasi Gudang Table -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-success text-white fw-bold">
                Informasi Gudang
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0 text-sm">
                    <tbody>
                        <tr>
                            <td>Pisang Masuk</td>
                            <td class="text-end fw-bold">{{ $totalMasukKg }} Kg</td>
                        </tr>
                        <tr>
                            <td>Distribusi (Keluar)</td>
                            <td class="text-end fw-bold">{{ $totalKeluarKg }} Kg</td>
                        </tr>
                        <tr>
                            <td>Stok Menipis</td>
                            <td class="text-end"><span class="badge bg-warning text-dark">{{ $stokMenipisCount }}</span></td>
                        </tr>
                        <tr>
                            <td>Status Sistem</td>
                            <td class="text-end"><span class="badge bg-success">Aktif</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Section: Tables Ringkasan -->
<div class="row">
    <!-- Pisang Masuk Terbaru -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-success text-white fw-bold">
                🚚 Pisang Masuk Terbaru
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Pisang</th>
                            <th>Supplier</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($masukTerbaru as $masuk)
                            <tr>
                                <td>{{ $masuk->barang->nama_barang ?? 'Barang Terhapus' }}</td>
                                <td>{{ $masuk->supplier->nama_supplier ?? '-' }}</td>
                                <td><span class="badge bg-success">{{ $masuk->jumlah }} Kg</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Belum ada data pisang masuk</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Distribusi Pisang Terbaru -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-danger text-white fw-bold">
                🚚 Distribusi Pisang Terbaru
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Pisang</th>
                            <th>Jumlah</th>
                            <th>Tujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($keluarTerbaru as $keluar)
                            <tr>
                                <td>{{ $keluar->barang->nama_barang ?? 'Barang Terhapus' }}</td>
                                <td><span class="badge bg-danger">{{ $keluar->jumlah }} Kg</span></td>
                                <td>{{ $keluar->tujuan ?? 'Cabang / Customer' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Belum ada data distribusi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Stok Pisang Hampir Habis Warning Box -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-warning text-dark fw-bold">
        ⚠️ Stok Pisang Hampir Habis / Kritis
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama Pisang</th>
                    <th>Stok Tersisa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangKritis as $barang)
                    <tr>
                        <td>{{ $barang->nama_barang ?? '-' }}</td>
                        <td class="fw-bold text-danger">{{ $barang->stok }} Kg</td>
                        <td>
                            @if(($barang->stok ?? 0) <= 0)
                                <span class="badge bg-danger">Habis Total</span>
                            @else
                                <span class="badge bg-warning text-dark">Stok Kritis</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-2">Tidak ada pisang yang stoknya kritis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const canvas = document.getElementById('gudangChart');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jenis Pisang', 'Supplier', 'Masuk (Trx)', 'Keluar (Trx)'],
                    datasets: [{
                        label: 'Jumlah Data',
                        data: [
                            {{ $totalJenis }}, 
                            {{ $totalSupplier }}, 
                            {{ $masukTerbaru->count() }}, 
                            {{ $keluarTerbaru->count() }}
                        ],
                        backgroundColor: '#82c8f6',
                        borderColor: '#60b5f0',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush