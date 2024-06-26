<table id="table" class="table table-hover display  pb-30">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor RM</th>
            <th>Tanggal Dokumen</th>
            <th>Nama Pasien</th>
            {{-- <th>NIK</th> --}}
            <th>Jenis Kelamin</th>
            {{-- <th>Tanggal</th> --}}
            <th>Petugas</th>
            <th>Dokumen</th>
            <th>Aksi</th>
        </tr>
    </thead>
    {{-- <tfoot>
        <tr>
            <th>#</th>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Petugas</th>
            <th>Dokumen</th>
            <th>Aksi</th>
        </tr>
    </tfoot> --}}
    <tbody>
        @foreach ($rekamMedis as $rm)
            @php
                $log = json_decode($rm->log, true);
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a href="javascript:void(0)" class="history-check" data-id="{{ $rm->id }}"
                        data-kode="{{ $rm->kode }}" data-toggle="tooltip" title="Klik dua kali untuk melihat riwayat">
                        {{ $rm->kode }}
                    </a>
                </td>
                <td>{{ date_format(date_create($rm->tanggal_dokumen), 'd-m-Y') }}</td>
                <td>{{ $rm->nama_pasien }}</td>
                {{-- <td>{{ $rm->nik }}</td> --}}
                <td>{{ $rm->jenis_kelamin == true ? 'Laki-laki' : 'Perempuan' }}</td>
                {{-- <td>{{ date_format(date_create($log[count($log) - 1]['time']), 'd-m-Y') }}</td> --}}
                <td>{{ $rm->user->nama }}</td>
                <td>
                    <a href="{{ $log[count($log) - 1]['content']['dokumen'] }}" target="_blank">
                        <button class="btn btn-primary btn-outline btn-anim btn-sm"><i
                                class="icon-cloud-download"></i><span class="btn-text">Dokumen</span></button>
                    </a>
                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-default btn-icon-anim btn-square btn-sm btn-edit"
                            data-id="{{ $rm->id }}"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btn-icon-anim btn-square btn-sm btn-delete"
                            data-id="{{ $rm->id }}"><i class="icon-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<script>
    $('#table').DataTable({
        responsive: true,
        language: {
            paginate: {
                previous: "Sebelumnya",
                next: "Selanjutnya"
            },
            info: "Menampilkan _START_ to _END_ from _TOTAL_ data",
            infoEmpty: "Menampilkan 0 to 0 from 0 data",
            lengthMenu: "Menampilkan _MENU_ data",
            search: "Cari:",
            emptyTable: "Datanya tidak ada",
            zeroRecords: "Data tidak cocok",
            loadingRecords: "Memuat..",
            processing: "Pengolahan...",
            infoFiltered: "(disaring dari _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "Semua"]
        ],
    });
</script>
