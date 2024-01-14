<!-- Modal trigger button -->
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modelStore">
    Tambah Denda
</button>

<!--
 Modal Body
 'name' => 'string',
 'amount' => 'required|numeric',
 'lates_day' => 'required|string',
 'payment_date' => 'required|date',
 'description' => 'string',
-->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modelStore" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('penalties.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="lates_day" value="-">
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    aria-describedby="name" placeholder="nama lengkap" required />
                                @error('name')
                                    <small id="name" class="form-text text-muted">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Jumlah Denda</label>
                                <input type="number" class="form-control" name="amount" id="amount"
                                    aria-describedby="amount" placeholder="Jumlah Denda" />
                                @error('amount')
                                    <small id="amount" class="form-text text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="payment_date" class="form-label">Tanggal Bayar</label>
                                <input type="date" class="form-control" name="payment_date" id="payment_date"
                                    aria-describedby="payment_date" placeholder="Tanggal Bayar" />
                                @error('payment_date')
                                    <small id="payment_date" class="form-text text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Keterangan denda</label>
                        <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
