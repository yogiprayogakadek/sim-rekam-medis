{{-- History Modal --}}
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">Histori Perubahan</h5>
            </div>
            <div class="modal-body">
                <table id="history-table" class="table table-hover display  pb-30" style="width: 100% !important;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Petugas</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
{{-- End --}}

{{-- Filter Modal --}}
<div id="filter-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">Filter Data</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label mb-10" for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Pilih Kategori</option>
                        <option value="Semua">Semua Data</option>
                        <option value="Range Waktu">Range Waktu</option>
                    </select>
                </div>

                <div class="row range-date" hidden>
                    <div class="col-md-6">
                        <div class="form-group" id="tanggal-awal">
                            <label class="control-label mb-10">Tanggal Awal</label>
                            <input type="date" class="form-control tanggal-awal" name="tanggal_awal">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-tanggal-awal"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group" id="tangal-akhir">
                            <label class="control-label mb-10">Tanggal Akhir</label>
                            <input type="date" class="form-control tanggal-akhir" name="tanggal_akhir">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-tanggal-akhir"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-outline btn-search">Filter</button>
            </div>
        </div>
    </div>
</div>
{{-- End --}}

<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-left">
                <button class="btn btn-info btn-rounded btn-lable-wrap left-label btn-filter"> <span
                        class="btn-label"><i class="fa fa-search white-icon"></i> </span><span class="btn-text">Filter
                        Data</span></button>
                <button class="btn btn-default btn-rounded btn-lable-wrap left-label btn-print ml-10"> <span
                        class="btn-label"><i class="fa fa-print white-icon"></i> </span><span class="btn-text">Print
                        Data</span></button>
            </div>
            <div class="pull-right">
                <button class="btn btn-primary btn-rounded btn-lable-wrap left-label btn-tambah"> <span
                        class="btn-label"><i class="fa fa-plus white-icon"></i> </span><span class="btn-text">Tambah
                        Data</span></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap">
                    <div class="table-render">
                        <table id="table" class="table table-hover display  pb-30">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
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
                                            <a href="javascript:void(0)" class="history-check"
                                                data-id="{{ $rm->id }}">
                                                {{ $rm->kode }}
                                            </a>
                                        </td>
                                        <td>{{ date_format(date_create($log[count($log) - 1]['time']), 'd-m-Y') }}</td>
                                        <td>{{ $rm->user->nama }}</td>
                                        <td>
                                            <a href="{{ $log[count($log) - 1]['content']['dokumen'] }}"
                                                target="_blank">
                                                <button class="btn btn-primary btn-outline btn-anim btn-sm"><i
                                                        class="icon-cloud-download"></i><span
                                                        class="btn-text">Dokumen</span></button>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button
                                                    class="btn btn-default btn-icon-anim btn-square btn-sm btn-edit"
                                                    data-id="{{ $rm->id }}"><i
                                                        class="fa fa-pencil"></i></button>
                                                <button
                                                    class="btn btn-danger btn-icon-anim btn-square btn-sm btn-delete"
                                                    data-id="{{ $rm->id }}"><i class="icon-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true
        });

        $('.history-check').on('dblclick', function() {
            $('#responsive-modal').modal('show');

            // Hancurkan DataTable jika sudah ada
            if ($.fn.dataTable.isDataTable('#history-table')) {
                $('#history-table').DataTable().destroy();
            }

            // Inisialisasi DataTable
            let historyTable = $('#history-table').DataTable({
                responsive: true
            });

            // Bersihkan isi tbody
            historyTable.clear().draw();

            let id = $(this).data('id');
            $.get("rekam-medis/history/" + id, function(data) {
                $.each(data, function(index, value) {
                    let tr_list = "<tr>" +
                        "<td>" + (index + 1) + "</td>" +
                        "<td>" + value.title + "</td>" +
                        "<td>" + value.kode + "</td>" +
                        "<td>" + value.tanggal + "</td>" +
                        "<td>" + value.petugas + "</td>" +
                        "<td><a href=" + value.dokumen + " target='_blank'>" +
                        "<button class='btn btn-primary btn-outline btn-anim btn-sm'><i class='icon-cloud-download'></i><span class='btn-text'>Dokumen</span></button>" +
                        "</a></td>" +
                        "</tr>";

                    // Tambahkan baris ke DataTable
                    historyTable.row.add($(tr_list)).draw();
                });
            });
        });

        // filter modal
        $('.btn-filter').on('click', function() {
            $('#filter-modal').modal('show')
            $('.btn-search').prop('disabled', true)
        });

        $('#kategori').on('change', function() {
            let value = $(this).val();

            value == 'Range Waktu' ? $('.range-date').prop('hidden', false) : $('.range-date').prop(
                'hidden',
                true);
            value == 'Semua' ? $('.btn-search').prop('disabled', false) : $('.btn-search').prop(
                'disabled', true);
        });

        function validateField(fieldClass, errorClass, errorMessage) {
            const value = $(fieldClass).val();
            const formGroup = $(fieldClass).closest('.form-group');
            const errorElement = formGroup.find(errorClass);

            if (value === '') {
                formGroup.addClass('has-error has-danger');
                errorElement.text(errorMessage);
            } else {
                formGroup.removeClass('has-error has-danger');
                errorElement.text('');
            }
        }

        function validateDates() {
            const tanggalAwal = $('.tanggal-awal').val();
            const tanggalAkhir = $('.tanggal-akhir').val();

            // Mengaktifkan atau menonaktifkan tombol pencarian
            $('.btn-search').prop('disabled', !tanggalAwal || !tanggalAkhir);

            // Validasi individual tanggal
            validateField('.tanggal-awal', '.error-tanggal-awal', 'Mohon isi tanggal awal');
            validateField('.tanggal-akhir', '.error-tanggal-akhir', 'Mohon isi tanggal akhir');

            // Validasi bahwa tanggal akhir tidak sebelum tanggal awal
            if (tanggalAwal && tanggalAkhir) {
                const dateAwal = new Date(tanggalAwal);
                const dateAkhir = new Date(tanggalAkhir);

                if (dateAkhir < dateAwal) {
                    $('#tangal-akhir').addClass('has-error has-danger');
                    $('.error-tanggal-akhir').text('Tanggal akhir tidak boleh kurang dari tanggal awal');
                    $('.btn-search').prop('disabled', true);
                } else {
                    $('#tangal-akhir').removeClass('has-error has-danger');
                    $('.error-tanggal-akhir').text('');
                }
            }
        }

        $('.tanggal-awal, .tanggal-akhir').on('change', validateDates);

        $('.btn-search').on('click', function() {
            let tanggalAwal = $('.tanggal-awal').val();
            let tanggalAkhir = $('.tanggal-akhir').val();
            let kategori = $('#kategori').val();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                type: "POST",
                url: "rekam-medis/filter",
                data: {
                    tanggal_awal: tanggalAwal,
                    tanggal_akhir: tanggalAkhir,
                    kategori: kategori
                },
                success: function(response) {
                    $(".table-render").html(response.data);
                    $('.tanggal-awal, .tanggal-akhir').val('');
                    $("#kategori").val("").change();
                    $('#filter-modal').modal('hide');
                },
                error: function(error) {
                    console.log("Error", error);
                },
            });
        });
    });
</script>
