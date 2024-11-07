<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Jenis Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .text-center {
            text-align: center;
        }
        .font-11 {
            font-size: 11px;
        }
        .font-13 {
            font-size: 13px;
        }
        .font-10 {
            font-size: 10px;
        }
        .font-bold {
            font-weight: bold;
        }
        .border-all {
            border: 1px solid #000;
            border-collapse: collapse;
            width: 100%;
        }
        .border-all th, .border-all td {
            border: 1px solid #000;
            padding: 5px;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td width="15%">
                <img src="{{ asset('logo.png') }}" alt="Logo" width="100">
            </td>
            <td width="85%">
                <span class="text-center d-block font-11 font-bold mb-1">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
                <span class="text-center d-block font-13 font-bold mb-1">POLITEKNIK NEGERI MALANG</span>
                <span class="text-center d-block font-10">Jl. Soekarno-Hatta No. 9 Malang 65141</span>
                <span class="text-center d-block font-10">Telepon (0341) 404424 Pes. 101-105, 0341-404420, Fax. (0341) 404420</span>
                <span class="text-center d-block font-10">Laman: www.polinema.ac.id</span>
            </td>
        </tr>
    </table>
    <h3 class="text-center">LAPORAN DATA JENIS PENGGUNA</h3>
    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode Jenis Pengguna</th>
                <th>Nama Jenis Pengguna</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenis_pengguna as $jp)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $jp->jenis_kode }}</td>
                    <td>{{ $jp->nama_jenis_pengguna }}</td>
                    <td>{{ $jp->bobot }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>