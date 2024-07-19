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
                                <label>Kabupaten</label>
                                <input name="kabupaten" id="kabupaten" type="text" placeholder="Kabupaten"
                                    class="form-control form-control-sm" value="{{ @$data->kabupaten }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Provinsi</label>
                                <input name="provinsi" id="provinsi" type="text" placeholder="provinsi"
                                    class="form-control form-control-sm" value="{{ @$data->provinsi }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Alamat <sup class="text-danger">*</sup></label>
                                <textarea name="alamat" id="alamat" cols="30" rows="5" placeholder="Alamat"
                                    class="form-control form-control-sm">{{ @$data->alamat }}</textarea>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Logo Instansi</label>
                                <div
                                    style="
                                    width: 100px;
                                    height: 100px;
                                    border-radius: 10px;
                                    background-size: cover;
                                    background: grey;
                                    background-position: center;
                                    background-image: url('{{ asset('logo') }}/{{ @$data->logo }}')">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <hr>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Nama Kepala Badan</label>
                                <input name="nama_kepala_badan" id="nama_kepala_badan" type="text"
                                    placeholder="Nama Kepala Badan" class="form-control form-control-sm"
                                    value="{{ @$data->nama_kepala_badan }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>NIP Kepala Badan</label>
                                <input name="nip_kepala_badan" id="nip_kepala_badan" type="text"
                                    placeholder="NIP Kepala Badan" class="form-control form-control-sm"
                                    value="{{ @$data->nip_kepala_badan }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Pangkat Golongan</label>
                                <select name="pangkat_kepala_badan" id="pangkat_kepala_badan"
                                    class="form-control form-control-sm">
                                    <option value="">PILIH PANGKAT GOLONGAN</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Juru Muda (I/a)' ? 'selected' : '' }}>Juru
                                        Muda (I/a)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Juru Muda Tingkat I (I/b)' ? 'selected' : '' }}>
                                        Juru Muda Tingkat I (I/b)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Juru (I/c)' ? 'selected' : '' }}>Juru (I/c)
                                    </option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Juru Tingkat I (I/d)' ? 'selected' : '' }}>
                                        Juru Tingkat I (I/d)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Pengatur Muda (II/a)' ? 'selected' : '' }}>
                                        Pengatur Muda (II/a)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Pengatur Muda Tingkat I (II/b)' ? 'selected' : '' }}>
                                        Pengatur Muda Tingkat I (II/b)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Pengatur (II/c)' ? 'selected' : '' }}>
                                        Pengatur (II/c)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Pengatur Tingkat I (II/d)' ? 'selected' : '' }}>
                                        Pengatur Tingkat I (II/d)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Penata Muda (III/a)' ? 'selected' : '' }}>
                                        Penata Muda (III/a)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Penata Muda Tingkat I (III/b)' ? 'selected' : '' }}>
                                        Penata Muda Tingkat I (III/b)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Penata (III/c)' ? 'selected' : '' }}>Penata
                                        (III/c)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Penata Tingkat I (III/d)' ? 'selected' : '' }}>
                                        Penata Tingkat I (III/d)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Pembina (IV/a)' ? 'selected' : '' }}>
                                        Pembina (IV/a)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Pembina Tingkat I (IV/b)' ? 'selected' : '' }}>
                                        Pembina Tingkat I (IV/b)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Pembina Utama Muda (IV/c)' ? 'selected' : '' }}>
                                        Pembina Utama Muda (IV/c)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Pembina Utama Madya (IV/d)' ? 'selected' : '' }}>
                                        Pembina Utama Madya (IV/d)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Pembina Utama (IV/e)' ? 'selected' : '' }}>
                                        Pembina Utama (IV/e)</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <hr>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Nama Kepala Bidang</label>
                                <input name="nama_kepala_bidang" id="nama_kepala_bidang" type="text"
                                    placeholder="Nama Kepala Bidang" class="form-control form-control-sm"
                                    value="{{ @$data->nama_kepala_bidang }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>NIP Kepala Bidang</label>
                                <input name="nip_kepala_bidang" id="nip_kepala_bidang" type="text"
                                    placeholder="NIP Kepala Bidang" class="form-control form-control-sm"
                                    value="{{ @$data->nip_kepala_bidang }}">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label>Pangkat Golongan</label>
                                <select name="pangkat_kepala_bidang" id="pangkat_kepala_bidang"
                                    class="form-control form-control-sm">
                                    <option value="">PILIH PANGKAT GOLONGAN</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Juru Muda (I/a)' ? 'selected' : '' }}>Juru
                                        Muda (I/a)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Juru Muda Tingkat I (I/b)' ? 'selected' : '' }}>
                                        Juru Muda Tingkat I (I/b)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Juru (I/c)' ? 'selected' : '' }}>Juru (I/c)
                                    </option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Juru Tingkat I (I/d)' ? 'selected' : '' }}>
                                        Juru Tingkat I (I/d)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Pengatur Muda (II/a)' ? 'selected' : '' }}>
                                        Pengatur Muda (II/a)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Pengatur Muda Tingkat I (II/b)' ? 'selected' : '' }}>
                                        Pengatur Muda Tingkat I (II/b)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Pengatur (II/c)' ? 'selected' : '' }}>
                                        Pengatur (II/c)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Pengatur Tingkat I (II/d)' ? 'selected' : '' }}>
                                        Pengatur Tingkat I (II/d)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Penata Muda (III/a)' ? 'selected' : '' }}>
                                        Penata Muda (III/a)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Penata Muda Tingkat I (III/b)' ? 'selected' : '' }}>
                                        Penata Muda Tingkat I (III/b)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Penata (III/c)' ? 'selected' : '' }}>Penata
                                        (III/c)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Penata Tingkat I (III/d)' ? 'selected' : '' }}>
                                        Penata Tingkat I (III/d)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Pembina (IV/a)' ? 'selected' : '' }}>
                                        Pembina (IV/a)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Pembina Tingkat I (IV/b)' ? 'selected' : '' }}>
                                        Pembina Tingkat I (IV/b)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Pembina Utama Muda (IV/c)' ? 'selected' : '' }}>
                                        Pembina Utama Muda (IV/c)</option>
                                    <option
                                        {{ @$data->pangkat_kepala_badan == 'Pembina Utama Madya (IV/d)' ? 'selected' : '' }}>
                                        Pembina Utama Madya (IV/d)</option>
                                    <option {{ @$data->pangkat_kepala_badan == 'Pembina Utama (IV/e)' ? 'selected' : '' }}>
                                        Pembina Utama (IV/e)</option>
                                </select>
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
                    url: '{{ url('store-instansi') }}',
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
