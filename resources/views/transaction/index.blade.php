<x-auth.layout>
    <x-slot name="title">Transaction Library</x-slot>
    @include('layouts.table')
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-md">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Informasi Peminjaman dan Pengembalian Buku Perpustakaan</h4>
                        <p>Informasi telah diperbarui pada {{ now() }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 position-relative text-center d-lg-none">
                    <img src="https://demos.themeselection.com/materio-bootstrap-html-admin-template/assets/img/front-pages/landing-page/sitting-girl-with-laptop.png"
                        class="card-img-position bottom-0 w-50" alt="View Profile">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <div class="small mb-1">Menunggu</div>
                            <h5 class="mb-0">{{ $waiting->count() }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <div class="small mb-1">Berjalan</div>
                            <h5 class="mb-0">{{ $walking->count() }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <div class="small mb-1">Terlambat</div>
                            <h5 class="mb-0">{{ $penalty->count() }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <div class="small mb-1">Selesai</div>
                            <h5 class="mb-0">{{ $finished->count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <h5 class="card-header mb-0 pb-0">Tambah Peminjaman Buku</h5>
        @include('transaction.store')
    </div>

    <div class="card">
        <div class="card-body">
            @include('transaction.table.index')
        </div>
    </div>

    {{-- <div class="card">
        <div class="card-header">
            <div class="nav-align-top">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-waiting" aria-controls="navs-justified-waiting"
                            aria-selected="true"><i
                                class="tf-icons mdi mdi-receipt-text-clock-outline mdi-20px me-1"></i> Menunggu
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-walking" aria-controls="navs-justified-walking"
                            aria-selected="false"><i class="tf-icons mdi mdi-timer-sand-complete mdi-20px me-1"></i>
                            Berjalan
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-penalty" aria-controls="navs-justified-penalty"
                            aria-selected="false"><i class="tf-icons mdi mdi-alert-box-outline mdi-20px me-1"></i>
                            Terlambat
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-finished" aria-controls="navs-justified-finished"
                            aria-selected="false"><i class="tf-icons mdi mdi-tag-check mdi-20px me-1"></i>
                            Selesai
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="navs-justified-waiting" role="tabpanel">
                    <div class="card-body">
                        @include('transaction.table.index')
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-walking" role="tabpanel">
                    <div class="card-body">
                        @include('transaction.table.walking')
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-penalty" role="tabpanel">
                    <div class="card-body">
                        @include('transaction.table.penalty')
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-finished" role="tabpanel">
                    <div class="card-body">
                        @include('transaction.table.finished')
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</x-auth.layout>
