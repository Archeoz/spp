<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        /* CSS untuk menggaya tabel */
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto; /* Menengahkan tabel horizontalmente */
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #3eb4ef;
            color: white;
        }

        /* CSS untuk menggaya header */
        h1 {
            text-align: center;
        }

        /* CSS untuk menggaya container */
        .container {
            text-align: center; /* Menengahkan konten dalam container horizontalmente */
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row">
            <h1 style="text-align: center;">Laporan Pembayaran Spp Tanggal : {{ date('d F Y') }}</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Petugas</th>
                    <th>Siswa</th>
                    <th>Kelas / Kompetensi Keahlian</th>
                    <th>Spp Bulan,Tahun</th>
                    <th>Nominal</th>
                    <th>Total</th>
                    <th>Tanggal Bayar</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ( $generate as $generate )
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $generate->nama_petugas }}</td>
                    <td>{{ $generate->nama_siswa }}</td>
                    <td>{{ $generate->nama_kelas }} {{ $generate->kompetensi_keahlian }}</td>
                    <td>{{ $generate->bulan }} {{ $generate->tahun }}</td>
                    <td>{{ $generate->nominal }}</td>
                    <td>{{ $generate->jumlah_bayar }}</td>
                    <td>{{ $generate->tgl_bayar }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
