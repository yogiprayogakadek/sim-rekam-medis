@extends('template.master')

@section('page-title', 'Rekam Medis')
@section('sub-title', 'List')


@section('content')
    <div class="row printableArea">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-heading mb-30">
                        <div class="pull-left">
                            <img src="{{ asset('assets/image/logo.png') }}" class="inline-block" width="150px">
                        </div>
                        <div class="pull-right">
                            <h3>Data Rekam Medis</h3>
                            <span>Tanggal dicetak: {{ date('d-m-Y H:i:s') }}</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Tanggal Dokumen</th>
                                            <th>Nama Pasien</th>
                                            <th>NIK</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal</th>
                                            <th>Petugas</th>
                                            <th>Total Perubahan</th>
                                        </tr>
                                    </thead>
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
                                                <td>{{ date_format(date_create($rm->tanggal_dokumen), 'd-m-Y') }}</td>
                                                <td>{{ $rm->nama_pasien }}</td>
                                                <td>{{ $rm->nik }}</td>
                                                <td>{{ $rm->jenis_kelamin == true ? 'Laki-laki' : 'Perempuan' }}</td>
                                                {{-- <td>{{ date_format(date_create($log[count($log) - 1]['time']), 'd-m-Y') }} --}}
                                                </td>
                                                <td>{{ $rm->user->nama }}</td>
                                                <td>
                                                    {!! count($log) == 1 ? '-' : '<strong>' . count($log) - 1 . 'x</strong>' . ' perubahan' !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" class="text-right">
                                                <strong>Total Data</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $rekamMedis->count() }} Data</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
