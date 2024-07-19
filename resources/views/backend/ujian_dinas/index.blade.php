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

        th,
        td {
            white-space: nowrap !important;
            vertical-align: middle !important;
        }
    </style>
@endpush
@section('content')
    <div class="row" style="margin-top: -200px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-8 mb-xl-0">
                    <h3 class="font-weight-bold">Data Ujian Dinas</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#modal">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>
                    <button type="button" class="text-white btn btn-danger btn-sm mb-4" data-toggle="modal"
                        data-target="#modal2">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Export
                    </button>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped" style="width: 100%;">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="5%">Edit</th>
                                    <th width="5%">Hapus</th>
                                    <th width="5%">File</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Pangkat Golongan</th>
                                    <th>Jabatan</th>
                                    <th>Unit Kerja</th>
                                    <th>Instansi</th>
                                    <th>Ujian Dinas</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Input</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form">
                    <div class="modal-header p-3">
                        <h5 class="modal-title m-2">Ujian Dinas Form</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Pegawai <sup class="text-danger">*</sup></label>
                            <select name="id_pegawai" id="id_pegawai" class="form-control form-control-sm" required>
                                @php
                                    $data = DB::table('pegawais')->get();
                                @endphp
                                <option value="">PILIH PEGAWAI</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}[NIP: {{ $item->nip }}]
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pangkat Golongan</label>
                            <select name="pangkat_golongan" id="pangkat_golongan" class="form-control form-control-sm"
                                required>
                                <option value="">PILIH PANGKAT GOLONGAN</option>
                                <option>Juru Muda (I/a)</option>
                                <option>Juru Muda Tingkat I (I/b)</option>
                                <option>Juru (I/c)</option>
                                <option>Juru Tingkat I (I/d)</option>
                                <option>Pengatur Muda (II/a)</option>
                                <option>Pengatur Muda Tingkat I (II/b)</option>
                                <option>Pengatur (II/c)</option>
                                <option>Pengatur Tingkat I (II/d)</option>
                                <option>Penata Muda (III/a)</option>
                                <option>Penata Muda Tingkat I (III/b)</option>
                                <option>Penata (III/c)</option>
                                <option>Penata Tingkat I (III/d)</option>
                                <option>Pembina (IV/a)</option>
                                <option>Pembina Tingkat I (IV/b)</option>
                                <option>Pembina Utama Muda (IV/c)</option>
                                <option>Pembina Utama Madya (IV/d)</option>
                                <option>Pembina Utama (IV/e)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Jabatan" name="jabatan"
                                id="jabatan" required>
                        </div>
                        <div class="form-group">
                            <label>Unit Kerja</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Unit Kerja"
                                name="unit_kerja" id="unit_kerja" required>
                        </div>
                        <div class="form-group">
                            <label>Instansi</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Instansi"
                                name="instansi" id="instansi" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Ujian</label>
                            <select name="jenis_ujian" id="jenis_ujian" class="form-control form-control-sm" required>
                                <option value="">PILIH JENIS UJIAN</option>
                                <option>Penyesuaian Ijazah</option>
                                <option>Pindah Ruang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input name="file" id="file" type="file" placeholder="File"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input name="foto" id="foto" type="file" placeholder="Foto"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control form-control-sm"
                                placeholder="Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer p-3">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        <button id="tombol_kirim" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form2" method="post" action="{{ url('export-ujian-dinas') }}">
                    @csrf
                    <div class="modal-header p-3">
                        <h5 class="modal-title m-2">Export Laporan Form</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Cari Tanggal Awal <sup class="text-danger">*</sup></label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label>Cari Tanggal Akhir <sup class="text-danger">*</sup></label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Ujian <sup class="text-danger">*</sup></label>
                            <select name="jenis_ujian" id="jenis_ujian" class="form-control form-control-sm" required>
                                <option value="">PILIH JENIS UJIAN</option>
                                <option>Semua</option>
                                <option>Penyesuaian Ijazah</option>
                                <option>Pindah Ruang</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer p-3">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        <button id="tombol_kirim" class="btn btn-primary btn-sm">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            getData()
        })

        function getData() {

            $("#myTable").DataTable({
                "ordering": false,
                ajax: '{{ url("data-ujian-dinas") }}',
                processing: true,
                scrollX: true,
                scrollCollapse: true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading...'
                },
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<a data-toggle="modal" data-target="#modal"
                                    data-bs-id=` + (row.id) + ` href="javascript:void(0)">
                                    <i style="font-size: 1.5rem;" class="text-success bi bi-grid"></i>
                                </a>`
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<a href="javascript:void(0)" onclick="hapusData(` + (row
                                .id) + `)">
                                    <i style="font-size: 1.5rem;" class="text-danger bi bi-trash"></i>
                                </a>`
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            if (row.file) {
                                return `<a href="{{ url("file") }}/${row.file}">
                                    <i style="font-size: 1.8rem;" class="text-primary bi bi-cloud-arrow-down"></i>
                                </a>`
                            } else {
                                return null
                            }
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            if (row.foto) {

                                return `<div style="
                                    height: 50px;
                                    width: 50px;
                                    background: grey;
                                    border-radius: 10px;
                                    background-image: url('{{ url("foto") }}/${row.foto}');
                                    background-position: center;
                                    background-size: cover;
                                ">
                                </div>`

                            } else {
                                return null
                            }
                        }
                    },
                    {
                        data: "nama"
                    },
                    {
                        data: "nip"
                    },
                    {
                        data: "pangkat_golongan"
                    },
                    {
                        data: "jabatan"
                    },
                    {
                        data: "unit_kerja"
                    },
                    {
                        data: "instansi"
                    },
                    {
                        data: 'jenis_ujian'
                    },
                    {
                        data: "keterangan"
                    },
                    {
                        data: "created_at"
                    },
                ]
            })
        }

        $('#modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('bs-id') // Extract info from data-* attributes
            var cok = $("#myTable").DataTable().rows().data().toArray()

            let cokData = cok.filter((dt) => {
                return dt.id == recipient;
            })

            document.getElementById("form").reset();
            document.getElementById('id').value = ''
            $('.error').empty();

            if (recipient) {
                var modal = $(this)
                modal.find('#id').val(cokData[0].id)
                modal.find('#email').val(cokData[0].email)
                modal.find('#id_pegawai').val(cokData[0].id_pegawai)
                modal.find('#pangkat_golongan').val(cokData[0].pangkat_golongan)
                modal.find('#jabatan').val(cokData[0].jabatan)
                modal.find('#keterangan').val(cokData[0].keterangan)
                modal.find('#unit_kerja').val(cokData[0].unit_kerja)
                modal.find('#instansi').val(cokData[0].instansi)
                modal.find('#jenis_ujian').val(cokData[0].jenis_ujian)
            }
        })

        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: formData.get('id') == '' ? '{{ url("store-ujian-dinas") }}' : '{{ url("update-ujian-dinas") }}',
                    data: formData,
                })
                .then(function(res) {
                    //handle success         
                    if (res.data.responCode == 1) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: res.data.respon,
                            timer: 3000,
                            showConfirmButton: false
                        })

                        $("#modal").modal("hide");
                        $('#myTable').DataTable().clear().destroy();
                        getData()

                    } else {

                        console.log('terjadi error');
                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function(res) {
                    document.getElementById("tombol_kirim").disabled = false;
                    //handle error
                    console.log(res);
                });
        }

        hapusData = (id) => {
            Swal.fire({
                title: "Yakin hapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"

            }).then((result) => {

                if (result.value) {
                    axios.post('{{ url("delete-ujian-dinas") }}', {
                            id
                        })
                        .then((response) => {
                            if (response.data.responCode == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    timer: 2000,
                                    showConfirmButton: false
                                })

                                $('#myTable').DataTable().clear().destroy();
                                getData();

                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Gagal...',
                                    text: response.data.respon,
                                })
                            }
                        }, (error) => {
                            console.log(error);
                        });
                }

            });
        }
    </script>
@endpush
