<x-guest.layout>
    <x-slot name="title">History Catalog Book</x-slot>
    @include('layouts.table')
    <div class="card mx-5 mt-1 shadow-none" style="background: transparent">
        <div class="card-header">
            <h5 class="mb-0">Riwayat Peminjaman Buku</h5>
            <p class="mb-3">Berikut data riwayat dari peminjaman buku {{ auth()->user()->name }}</p>
        </div>
        <div class="card-body">
            <div class="nav-align-left">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-left-align-waiting">Menunggu</button>
                        @if ($waiting->count() > 0)
                            <span
                                class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">{{ $waiting->count() }}</span>
                        @endif
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-left-align-walking">Berjalan
                            @if ($walking->count() > 0)
                                <span
                                    class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">{{ $walking->count() }}</span>
                            @endif
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-left-align-penalty">penalty
                            @if ($penalty->count() > 0)
                                <span
                                    class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">{{ $penalty->count() }}</span>
                            @endif
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-left-align-finished">Selesai
                            @if ($finished->count() > 0)
                                <span
                                    class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">{{ $finished->count() }}</span>
                            @endif
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-left-align-rejects">Ditolak
                            @if ($rejects->count() > 0)
                                <span
                                    class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">{{ $rejects->count() }}</span>
                            @endif
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-left-align-waiting">
                        <div class="table-responsive">
                            <table id="example" class="display table nowrap text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>status</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Buku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($waiting as $no => $wait)
                                        <tr>
                                            <td>{{ ++$no }}.</td>
                                            <td><span class="badge bg-warning">{{ $wait->status }}</span></td>
                                            <td>{{ $wait->borrow_date ?? '-' }}</td>
                                            <td>{{ $wait->return_date ?? '-' }}</td>
                                            <td>{{ $wait->book->title }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-left-align-walking">
                        <div class="table-responsive">
                            <table id="example" class="display table nowrap text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>status</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Buku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($walking as $no => $walk)
                                        <tr>
                                            <td>{{ ++$no }}.</td>
                                            <td><span class="badge bg-primary">{{ $walk->status }}</span></td>
                                            <td>{{ $walk->borrow_date ?? '-' }}</td>
                                            <td>{{ $walk->return_date ?? '-' }}</td>
                                            <td>{{ $walk->book->title }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-left-align-penalty">
                        <div class="table-responsive">
                            <table id="example" class="display table nowrap text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>status</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Buku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penalty as $no => $penal)
                                        <tr>
                                            <td>{{ ++$no }}.</td>
                                            <td><span class="badge bg-danger">{{ $penal->status }}</span></td>
                                            <td>{{ $penal->borrow_date ?? '-' }}</td>
                                            <td>{{ $penal->return_date ?? '-' }}</td>
                                            <td>{{ $penal->book->title }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-left-align-finished">
                        <table id="example" class="display table nowrap text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>status</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Buku</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finished as $no => $finish)
                                    <tr>
                                        <td>{{ ++$no }}.</td>
                                        <td><span class="badge bg-success">{{ $finish->status }}</span></td>
                                        <td>{{ $finish->borrow_date ?? '-' }}</td>
                                        <td>{{ $finish->return_date ?? '-' }}</td>
                                        <td>{{ $finish->book->title }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="navs-left-align-rejects">
                        <table id="example" class="display table nowrap text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>status</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Buku</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rejects as $no => $finish)
                                    <tr>
                                        <td>{{ ++$no }}.</td>
                                        <td><span class="badge bg-danger">{{ $finish->status }}</span></td>
                                        <td>{{ $finish->borrow_date ?? '-' }}</td>
                                        <td>{{ $finish->return_date ?? '-' }}</td>
                                        <td>{{ $finish->book->title }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest.layout>
