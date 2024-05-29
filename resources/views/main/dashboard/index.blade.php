@extends('template.master')

@section('page-title', 'Dashboard')
@section('sub-title', 'Home')
@push('page-link')
    <a href="{{ route('dashboard.index') }}">Dashboard</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-4 col-sm-offset-3">
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
                                        <span class="counts block head-font"><span class="counter-anim">Selamat
                                                Datang</span></span>
                                        <span class="counts-text block">Sistem Informasi Rekam Medis</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
