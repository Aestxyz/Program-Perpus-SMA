<x-auth.layout>
    <x-slot name="title">Laporan Denda</x-slot>
    @include('layouts.report')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="display table nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Jumlah Denda</th>
                            <th>Keterangan</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penalties as $no => $item)
                            <tr>
                                <td>{{ ++$no }}.</td>
                                <td>{{ $item->user->name }}</td>
                                <td>Rp. {{ $item->penalty }}</td>
                                <td>{{ $item->status->name }}</td>
                                <td>
                                  #
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-auth.layout>
