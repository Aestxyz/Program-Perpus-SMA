<x-auth.layout>
    <x-slot name="title">Laporan Buku Perpustakaan</x-slot>
    @include('layouts.report')

    <div class="card">
        <div class="card-body table-responsive">
            <table id="example" class="display table nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>judul</th>
                        <th>kategori buku</th>
                        <th>isbn</th>
                        <th>Penulis</th>
                        <th>tahun terbit</th>
                        <th>penerbit</th>
                        <th>jumlah buku</th>
                        <th>Sumber</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $no => $book)
                        <tr>
                            <td>{{ ++$no }}.</td>
                            <td>{{ $book->title }}</td>
                            <td><span class="badge bg-primary">{{ $book->category->name }}</span></td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->year_published }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->book_count }}</td>
                            <td>{{ $book->source }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-auth.layout>
