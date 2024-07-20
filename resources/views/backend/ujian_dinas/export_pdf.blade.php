<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Times New Roman', 'Times', 'serif';
        }

        /* .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        } */
    </style>
</head>

<body>
    @if (@$instansi)
        <table class="table table-bordered" style="width: 100%;">
            <tr>
                <td class="p-0 text-center" style="vertical-align: middle; width: 20%;">
                    <img width="80%"
                        @if ($instansi->logo) src="{{ url('logo') }}/{{ $instansi->logo }}"
                    @else @endif
                        alt="">
                </td>
                <td class="p-0 text-center" style="width: 80%;">
                    <h4>{{ strtoupper($instansi->nama_instansi) }}</h4>
                    <h4>{{ strtoupper($instansi->nama_lembaga) }}</h4>
                    <h4>
                        @php
                            echo strtoupper(@$instansi->provinsi);
                        @endphp
                    </h4>
                    <p>{{ $instansi->alamat }}</p>
                </td>
            </tr>
        </table>
        <hr style="border: 2px solid black;">
    @endif
    <br>
    <h4 class="text-center mt-2"><u>DAFTAR PESERTA UJIAN DINAS</u></h4>
    <br>
    <table class="table table-striped table-bordered" style="width: 100%;">
        <thead class="bg-info">
            <tr>
                <td>No</td>
                <td>Nama Pegawai</td>
                <td>NIP</td>
                <td>Pangkat Golongan</td>
                <td>Jabatan</td>
                <td>Unit Kerja</td>
                <td>Instansi</td>
                <td>Jenis Ujian</td>
                <td>Foto</td>
                <td>Keterangan</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $k => $item)
                <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->pangkat_golongan }}</td>
                    <td>{{ $item->jabatan }}</td>
                    <td>{{ $item->unit_kerja }}</td>
                    <td>{{ $item->instansi }}</td>
                    <td>{{ $item->jenis_ujian }}</td>
                    <td>
                        @if ($item->foto)
                            <img width="50px" src="{{ asset('foto') }}/{{ $item->foto }}" alt="">
                        @endif
                    </td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div class="footer">
        <table class="table table-borderless" style="width: 100%;">
            <tr>
                <td colspan="5" class="text-center">
                    KEPALA BADAN <br> KEPEGAWAIAN DAN PENGEMBANGAN <br> SUMBER DAYA MANUSIA
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p>
                        ( {{ $instansi->nama_kepala_badan }} ) <br>
                        {{ $instansi->pangkat_kepala_badan }} <br>
                        NIP: {{ $instansi->nip_kepala_badan }}
                    </p>
                </td>
                <td colspan="5" class="text-center">
                    KEPALA BIDANG  <br> PENGEMBANGAN KARIR DAN DIKLAT
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p>
                        ( {{ $instansi->nama_kepala_bidang }} ) <br>
                        {{ $instansi->pangkat_kepala_bidang }} <br>
                        NIP: {{ $instansi->nip_kepala_bidang }}
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
