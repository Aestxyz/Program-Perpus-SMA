<x-auth.layout>
    <x-slot name="title">{{ $transaction->user->name }}</x-slot>
    <div class="row">
        <!-- Customer-detail Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- Customer-detail Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="customer-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded my-3"
                                src="https://demos.themeselection.com/materio-bootstrap-html-admin-template/assets/img/avatars/2.png"
                                height="110" width="110" alt="User avatar">
                            <div class="customer-info text-center">
                                <h4 class="mb-1">{{ $transaction->user->name }}</h4>
                                <small>NIS/Etc. {{ $transaction->user->identify }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="info-container">
                        <small class="d-block pt-4 border-top fw-normal text-uppercase text-muted my-3">DETAILS</small>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-medium me-2">Nama:</span>
                                <span>{{ $transaction->user->name }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Email:</span>
                                <span>{{ $transaction->user->email }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Role:</span>
                                <span class="badge bg-label-success">{{ $transaction->user->role }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Telp:</span>
                                <span>{{ $transaction->user->telp }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">NIS/Etc.:</span>
                                <span>{{ $transaction->user->identify }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Jenis Kelamin:</span>
                                <span>{{ $transaction->user->gender }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Tgl. Lahir:</span>
                                <span>{{ $transaction->user->birthdate }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Customer Sidebar -->


        <!-- Customer Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
            <div class="d-flex gap-3 mb-3 justify-content-between">
                <button class="btn btn-label-warning" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Edit
                </button>
                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-label-danger">Hapus</button>
                </form>
            </div>

            <div class="collapse mb-3" id="collapseExample">
                <div class="card">
                    @include('transaction.update')
                </div>
            </div>
            <!-- Invoice table -->
            <div class="card mb-4">
                <div class="card-body table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Tgl. Pinjam</th>
                                <th scope="col">Tgl. Kembali</th>
                                <th scope="col">Buku</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $transaction->borrow_date }}</td>
                                <td>{{ $transaction->return_date }}</td>
                                <td>{{ $transaction->book->title }}</td>
                                <td><span class="badge bg-label-secondary">{{ $transaction->status }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /Invoice table -->
        </div>
        <!--/ Customer Content -->
    </div>

</x-auth.layout>
