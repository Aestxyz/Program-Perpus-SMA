<div class="table-responsive">
    <table id="example" class="display table nowrap text-center" style="width:100%">
        <thead>
            <tr>
                <th>nama lengkap</th>
                <th>status</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $item)
                <tr>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->status->name }}
                    </td>
                    <td>
                        {{ $item->borrow_date != null ? Carbon\carbon::parse($item->borrow_date)->format('d M Y') : '-' }}
                    </td>
                    <td>
                        {{ $item->return_date != null ? Carbon\carbon::parse($item->return_date)->format('d M Y') : '-' }}
                    </td>
                    <td>
                        <div class="d-flex gap-2">

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
