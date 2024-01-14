<div class="table-responsive">
    <table id="example" class="display table nowrap text-center" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>nama lengkap</th>
                <th>status</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $no => $item)
                <tr>
                    <td>{{ ++$no }}.</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->return_date <= now() && $item->status == 'Berjalan' ? 'Terlambat' : $item->status }}
                    </td>
                    <td>{{ Carbon\carbon::parse($item->borrow_date)->format('d M Y') ?? '-' }}</td>
                    <td>{{ Carbon\carbon::parse($item->return_date)->format('d M Y') ?? '-' }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            @if (
                                $item->return_date <= now() &&
                                    $item->status != 'Tolak' &&
                                    $item->status != 'Menunggu' &&
                                    $item->status != 'Selesai')
                                {{-- bayar denda --}}
                                <a class="btn btn-danger btn-sm" href="{{ route('penalties.show', $item->id) }}">Bayar</a>
                            @elseif ($item->status == 'Berjalan')
                                {{-- peminjaman selesai --}}
                                <form action="{{ route('transactions.finished', $item->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                </form>

                                {{-- perpanjang peminjaman --}}
                                <form action="{{ route('transactions.extratime', $item->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm">Perpanjang</button>
                                </form>
                            @elseif ($item->status == 'Menunggu')
                                {{-- menerima pinjam buku --}}
                                <form action="{{ route('transactions.confirmation', $item->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Berjalan">
                                    <input type="hidden" name="borrow_date" value="{{ $borrow_date }}">
                                    <input type="hidden" name="return_date" value="{{ $return_date }}">
                                    <button type="submit" class="btn btn-success btn-sm">Konfirmasi</button>
                                </form>
                                {{-- menolak pinjam buku --}}
                                <form action="{{ Route('transactions.reject', $item->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                            @endif




                            {{-- lihat detail --}}
                            <a class="btn btn-primary btn-sm" href="{{ route('transactions.show', $item->id) }}"
                                role="button">Lihat</a>


                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
