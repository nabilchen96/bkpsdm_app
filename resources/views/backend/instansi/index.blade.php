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
                    <h3 class="font-weight-bold">Data Instansi</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    <form id="form">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label>Nama Instansi <sup class="text-danger">*</sup></label>
                                <input name="nama_instansi" id="nama_instansi" type="text" placeholder="Nama Instansi"
                                    class="form-control form-control-sm" value="{{ @$data->nama_instansi }}" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Nama Lembaga <sup class="text-danger">*</sup></label>
                                <input name="nama_lembaga" id="nama_lembaga" type="text" placeholder="Nama Lembaga"
                                    class="form-control form-control-sm" value="{{ @$data->nama_lembaga }}" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Status <sup class="text-danger">*</sup></label>
                                <input name="status" id="status" type="text" placeholder="Status"
                                    class="form-control form-control-sm" value="{{ @$data->status }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Nama Kepala <sup class="text-danger">*</sup></label>
                                <input name="nama_kepala" id="nama_kepala" type="text" placeholder="Nama Kepala"
                                    class="form-control form-control-sm" value="{{ @$data->nama_kepala }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>NIP <sup class="text-danger">*</sup></label>
                                <input name="nip" id="nip" type="text" placeholder="NIP"
                                    class="form-control form-control-sm" value="{{ @$data->nip }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Email <sup class="text-danger">*</sup></label>
                                <input name="email" id="email" type="email" placeholder="Email"
                                    class="form-control form-control-sm" value="{{ @$data->email }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>No Telepon <sup class="text-danger">*</sup></label>
                                <input name="no_telepon" id="no_telepon" type="text" placeholder="No Telepon"
                                    class="form-control form-control-sm" value="{{ @$data->no_telepon }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Logo <sup class="text-danger">*</sup></label>
                                <input name="logo" id="logo" type="file" placeholder="No Telepon"
                                    class="form-control form-control-sm">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Alamat <sup class="text-danger">*</sup></label>
                                <textarea name="alamat" id="alamat" cols="30" rows="5" placeholder="Alamat"
                                    class="form-control form-control-sm">{{ @$data->alamat }}</textarea>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Logo Instansi</label>
                                @if (@$data->logo)
                                    <div style="
                                        width: 100px;
                                        height: 100px;
                                        border-radius: 10px;
                                        background-size: cover;
                                        background-image: url('{{ asset('logo') }}/{{ @$data->logo }}')">
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-12 form-group">
                                <button id="tombol_kirim" style="border-radius: 8px !important;" type="submit"
                                    class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: '{{ url("store-instansi") }}',
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

                        location.reload()

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
    </script>
@endpush
