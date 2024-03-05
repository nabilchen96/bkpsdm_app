@extends('backend.app')
@push('style')
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
    </style>
@endpush
@section('content')
    <div class="row" style="margin-top: -200px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-8 mb-xl-0">
                    <h3 class="font-weight-bold">Data Penilaian AMI</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    <table class="mb-1 table table-striped">
                        <tr>
                            <td width="25%">Judul Audit</td>
                            <td>:</td>
                            <td width="25%">{{ $jadwal->judul }}</td>
                            <td width="25%">Periode Audit</td>
                            <td>:</td>
                            <td width="25%">{{ $jadwal->tgl_awal_upload }} s/d
                                {{ $jadwal->tgl_akhir_upload }}
                            </td>
                        </tr>
                        <tr>
                            <td>Kurikulum</td>
                            <td>:</td>
                            <td>
                                {{ $jadwal->nama_kurikulum }}
                            </td>
                            <td>Auditee</td>
                            <td>:</td>
                            <td>{{ $jadwal->prodi }}</td>
                        </tr>
                    </table>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped" style="width: 100%;">
                            <thead class="bg-primary text-white">
                                <tr>
                                    {{-- <th width="5%"></th> --}}
                                    {{-- <th>Grup</th> --}}
                                    <th></th>
                                    <th></th>
                                    <th>Pertanyaan</th>
                                    <th>Nilai</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $namagrup = '';
                                    $namagrupprev = '';
                                    $totalRows = count($data);
                                @endphp

                                @foreach ($data as $k => $item)
                                    @php
                                        $namagrup = $item->nama_grup_instrumen;
                                    @endphp
                                    @if ($namagrup != $namagrupprev)
                                        <tr style="background: green !important;">
                                            <td colspan="5"><b>{{ $item->nama_grup_instrumen }}</b></td>
                                        </tr>
                                    @endif
                                    @if ($item->nama_grup_instrumen != $namagrupprev)
                                        @php
                                            $groupRowCount = 0;
                                            foreach ($data as $row) {
                                                if ($row->nama_grup_instrumen == $item->nama_grup_instrumen) {
                                                    $groupRowCount++;
                                                }
                                            }
                                        @endphp
                                        <tr>
                                            <td rowspan="{{ $groupRowCount }}"><b>{{ $item->nama_grup_instrumen }}</b></td>
                                            <td>{{ $item->kode_instrumen }}</td>
                                            <td>{{ $item->nama_instrumen }}</td>
                                            <form action="{{ url('store-penilaian_ami') }}" method="POST">
                                                @csrf
                                                <td>
                                                    <input type="hidden" name="butir_instrumen_id"
                                                        value="{{ $item->butir_instrumen_id }}">
                                                    <input type="hidden" name="grup_instrumen_id"
                                                        value="{{ $item->grup_instrumen_id }}">
                                                    <input type="hidden" name="kurikulum_instrumen_id"
                                                        value="{{ $item->kurikulum_instrumen_id }}">
                                                    <input type="hidden" name="jadwal_ami_id"
                                                        value="{{ $item->jadwal_ami_id }}">
                                                    <input name="skor" type="number" max="4" maxlength="4"
                                                        value="{{ $item->skor }}" class="form-control">
                                                </td>
                                                <td>
                                                    <button style="border-radius: 10px !important;"
                                                        class="btn btn-sm btn-primary">Submit</button>
                                                </td>
                                            </form>
                                        </tr>
                                        @php
                                            $namagrupprev = $item->nama_grup_instrumen;
                                        @endphp
                                    @else
                                        <tr>
                                            <td>{{ $item->kode_instrumen }}</td>
                                            <td>{{ $item->nama_instrumen }}</td>
                                            <form action="{{ url('store-penilaian_ami') }}" method="POST">
                                                @csrf
                                                <td>
                                                    <input type="hidden" name="butir_instrumen_id"
                                                        value="{{ $item->butir_instrumen_id }}">
                                                    <input type="hidden" name="grup_instrumen_id"
                                                        value="{{ $item->grup_instrumen_id }}">
                                                    <input type="hidden" name="kurikulum_instrumen_id"
                                                        value="{{ $item->kurikulum_instrumen_id }}">
                                                    <input type="hidden" name="jadwal_ami_id"
                                                        value="{{ $item->jadwal_ami_id }}">
                                                    <input name="skor" type="number" max="4" maxlength="4"
                                                        value="{{ $item->skor }}" class="form-control">
                                                </td>
                                                <td>
                                                    <button style="border-radius: 10px !important;"
                                                        class="btn btn-sm btn-primary">Submit</button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endif

                                    @if ($k == $totalRows - 1)
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <span style="
    width: 200px !important;
    white-space: normal;
    display: inline-block !important;
    "></span> --}}
@endsection
@push('script')
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            getData()
        })

        function getData() {
            // Mengambil URL saat ini
            var url = window.location.href;

            // Membagi URL menjadi array menggunakan '/' sebagai pemisah
            var urlParts = url.split('/');

            // Mengambil elemen terakhir dari array yang merupakan angka
            var angka = urlParts[urlParts.length - 1];

            $("#myTable").DataTable({
                "ordering": false,
                // ajax: '/data-penilaian_ami/'+angka,
                // processing: true,
                // scrollX: true,
                // scrollCollapse: true,
                // 'language': {
                //     'loadingRecords': '&nbsp;',
                //     'processing': 'Loading...'
                // },
                // columns: [{
                //         render: function(data, type, row, meta) {
                //             return meta.row + meta.settings._iDisplayStart + 1;
                //         }
                //     },
                //     {
                //         data: "nama_grup_instrumen"
                //     },
                //     {
                //         data: "kode_instrumen"
                //     },
                //     {
                //         // data: "keterangan"
                //         render: function(data, type, row, meta){
                //             return `
            //                 INSTRUMEN: ${row.nama_instrumen} <br>

            //             `
                //         }
                //     },
                //     {
                //         render: function(data, type, row, meta) {
                //             return `
            //                 <input type="number" class="form-control" placeholder="Nilai">
            //             `
                //         }
                //     },
                // ]
            })
        }

        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            // document.getElementById("tombol_kirim").disabled = true;

            // console.log(formData);

            // axios({
            //         method: 'post',
            //         url: '/store-user'
            //         data: formData,
            //     })
            //     .then(function(res) {
            //         //handle success         
            //         if (res.data.responCode == 1) {

            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'Sukses',
            //                 text: res.data.respon,
            //                 timer: 3000,
            //                 showConfirmButton: false
            //             })

            //             $("#modal").modal("hide");
            //             $('#myTable').DataTable().clear().destroy();
            //             getData()

            //         } else {

            //             console.log('terjadi error');
            //         }

            //         document.getElementById("tombol_kirim").disabled = false;
            //     })
            //     .catch(function(res) {
            //         document.getElementById("tombol_kirim").disabled = false;
            //         //handle error
            //         console.log(res);
            //     });
        }
    </script>
@endpush
