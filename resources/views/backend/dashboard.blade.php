@extends('backend.app')
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css">
    <style>
        #myTable_filter input {
            height: 29.67px !important;
        }

        #myTable_length select {
            height: 29.67px !important;
        }

        .btn {
            border-radius: 50px !important;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #9e9e9e21 !important;
        }

        th,
        td {
            white-space: nowrap !important;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .biru {
            background-color: blue;
            color: white;
        }

        .hijau {
            background-color: green;
            color: white;
        }

        .kuning {
            background-color: yellow;
        }

        .oren {
            background-color: orange;
        }

        .merah {
            background-color: red;
            color: white;
        }

        .rotate-text {
            white-space: nowrap;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
    </style>
@endpush
@section('content')
    @php
        @@$data_user = Auth::user();
    @endphp

    <div class="row" style="margin-top: -200px;">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Dashboard</h3>
                    <h6 class="font-weight-normal mb-0">Hi, {{ Auth::user()->name }}.
                        Welcome back to BKPSDM APP</h6>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-3">
                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <img src="https://themewagon.github.io/purple-react/static/media/circle.953c9ca0.svg" class="card-img-absolute" alt="circle">
                            <h4 class="font-weight-normal mb-3">
                                Total Pegawai
                                <i class="bi bi-person-circle float-right"></i>
                            </h4>
                            <h2>
                                {{ $pegawai ?? 0}}
                            </h2>
                            <span>Orang</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card bg-gradient-primary card-img-holder text-white">
                        <div class="card-body">
                            <img src="https://themewagon.github.io/purple-react/static/media/circle.953c9ca0.svg" class="card-img-absolute" alt="circle">
                            <h4 class="font-weight-normal mb-3">
                                Penyesuaian Ijazah
                                <i class="bi bi-person-circle float-right"></i>
                            </h4>
                            <h2>
                                {{ $pi ?? 0}}
                            </h2>
                            <span>Orang</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">
                            <img src="https://themewagon.github.io/purple-react/static/media/circle.953c9ca0.svg" class="card-img-absolute" alt="circle">
                            <h4 class="font-weight-normal mb-3">
                                Total Pindah Ruang
                                <i class="bi bi-person-circle float-right"></i>
                            </h4>
                            <h2>
                                {{ $pr ?? 0}}
                            </h2>
                            <span>Orang</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="https://themewagon.github.io/purple-react/static/media/circle.953c9ca0.svg" class="card-img-absolute" alt="circle">
                            <h4 class="font-weight-normal mb-3">
                                Total Prajabatan
                                <i class="bi bi-person-circle float-right"></i>
                            </h4>
                            <h2>
                                {{ $prajab ?? 0 }}
                            </h2>
                            <span>Orang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            getData()
        })

        function getData() {
            @$("#myTable").DataTable({
                "ordering": false,
            })
        }
    </script>
@endpush
