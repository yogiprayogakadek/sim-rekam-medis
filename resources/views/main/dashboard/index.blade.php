@extends('template.master')

@section('page-title', 'Halaman utama')
@section('sub-title', 'Home')
@push('page-link')
    <a href="{{ route('dashboard.index') }}">Halaman utama</a>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dist/morris.css') }}">
@endpush
{{-- col-sm-offset-3 --}}
@section('content')
    <div class="row">
        <div class="col-sm-4 ">
            <div class="panel panel-default card-view  pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body  pa-0">
                        <div class="profile-box">
                            <div class="profile-cover-pic">
                                <div class="profile-image-overlay"></div>
                            </div>
                            <div class="profile-info text-center">
                                <div class="profile-img-wrap">
                                    <img class="inline-block mb-10" src="{{ asset('assets/image/user1.png') }}"
                                        alt="user">
                                </div>
                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger">
                                    {{ auth()->user()->nama }}</h5>
                                <h6 class="block capitalize-font pb-20">{{ auth()->user()->level }}</h6>
                            </div>
                            <div class="social-info">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <span class="counts block head-font"><span>Selamat
                                                Datang</span></span>
                                        <span class="counts-text block">Sistem Informasi Rekam Medis Inaktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pb-0">
                        <div class="tab-struct custom-tab-1">
                            <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                                <li class="active" role="presentation"><a data-toggle="tab" id="profile_tab_8"
                                        role="tab" href="#daily_chart" aria-expanded="false"><span>Total</span></a>
                                </li>
                                <li role="presentation" class="next"><a aria-expanded="true" data-toggle="tab"
                                        role="tab" id="follo_tab_8" href="#filter_chart"><span>Filter</span></a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent_8">
                                <div id="daily_chart" class="tab-pane fade active in" role="tabpanel">
                                    <div class="col-md-12">
                                        <div class="panel panel-default card-view">
                                            <div class="panel-heading">
                                                <div class="pull-left">
                                                    <h6 class="panel-title txt-dark">Chart Harian Scan Data</h6>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div id="chart_harian" class="morris-chart donut-chart"></div>
                                                </div>
                                                <div class="panel-footer">
                                                    {{--  --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="filter_chart" class="tab-pane fade" role="tabpanel">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="panel panel-default card-view">
                                                <div class="panel-heading">
                                                    <div class="pull-left">
                                                        <h6 class="panel-title txt-dark">Filter Total Data</h6>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group" id="tanggal-awal">
                                                                    <label class="control-label mb-10">Tanggal Awal</label>
                                                                    <input type="date" class="form-control tanggal-awal"
                                                                        name="tanggal_awal">
                                                                    <div class="help-block with-errors error-message">
                                                                        <ul class="list-unstyled">
                                                                            <li class="error-tanggal-awal"></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-5">
                                                                <div class="form-group" id="tangal-akhir">
                                                                    <label class="control-label mb-10">Tanggal Akhir</label>
                                                                    <input type="date" class="form-control tanggal-akhir"
                                                                        name="tanggal_akhir">
                                                                    <div class="help-block with-errors error-message">
                                                                        <ul class="list-unstyled">
                                                                            <li class="error-tanggal-akhir"></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->

                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label class="control-label mb-10">Filter</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-outline btn-search"><i
                                                                            class="fa fa-search"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="chart_filter" class="morris-chart donut-chart"></div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        {{--  --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/dist/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/js/dist/morris.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <script>
        $(function() {
            "use strict";


            // Daily Chart
            function dailyChart() {
                moment.locale('id');
                var currentDate = moment().format('D MMMM YYYY');
                $.get("dashboard/daily-chart", function(data) {
                    // Data sudah dalam format JSON, tidak perlu parse lagi
                    Morris.Donut({
                        element: 'chart_harian',
                        data: data.daily,
                        colors: ['rgba(46,205,153,.6)', 'rgba(240,197,65,.6)',
                            'rgba(237,111,86,.6)'
                        ],
                        resize: true
                    });
                    $("div svg text").attr("style", "font-family: Poppins").attr("font-weight", "400");

                    // Footer
                    $('#daily_chart .panel-footer').html(
                        'Total dari keseluruhan data scan pada rekam medis inaktif pada tanggal <strong>' +
                        currentDate + '</strong> adalah sebanyak <strong>' + data.total +
                        '</strong> data');
                });
            }

            // Validasi
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

                let $button = $('.btn-search');
                $button.prop('disabled', !tanggalAwal || !tanggalAkhir);

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

            function filterChart() {
                let tanggalAwal = $('.tanggal-awal').val();
                let tanggalAkhir = $('.tanggal-akhir').val();

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    type: "POST",
                    url: "dashboard/filter-chart",
                    data: {
                        tanggal_awal: tanggalAwal,
                        tanggal_akhir: tanggalAkhir,
                    },
                    success: function(data) {
                        Morris.Donut({
                            element: 'chart_filter',
                            data: data.filter,
                            colors: ['rgba(46,205,153,.6)', 'rgba(240,197,65,.6)',
                                'rgba(237,111,86,.6)'
                            ],
                            // resize: true
                        });
                        // $("div svg text").attr("style", "font-family: Poppins").attr("font-weight",
                        //     "400");

                        // Footer
                        $('#filter_chart .panel-footer').html(
                            'Total dari keseluruhan data scan pada rekam medis inaktif dari tanggal <strong>' +
                            moment(tanggalAwal).format('DD MMMM YYYY') +
                            '</strong> sampai dengan tanggal <strong>' +
                            moment(tanggalAkhir).format('DD MMMM YYYY') +
                            '</strong> adalah sebanyak <strong>' + data.total +
                            '</strong> data');
                    },
                    error: function(error) {
                        console.log("Error", error);
                    },
                });
            }

            dailyChart();

            $('.btn-search').on('click', function() {
                $('#chart_filter').empty()
                filterChart();
            })
        })
    </script>
@endpush
