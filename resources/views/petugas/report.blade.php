<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Bulanan</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    
    <div class="container">
        <h1 style="text-align: center">Laporan Rekam Penggunaan</h1>
        <div class="table-responsive">
            <table id="table-report"
                class="table table-striped table-hover table-borderless table-primary align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Id Pel/Meter</th>
                        <th>Nama Pel</th>
                        <th>Telp</th>
                        <th>Dusun</th>
                        <th>Jenis Penggunaan</th>
                        <th>Jlh Penggunaan M<sup>3</sup></th>
                        <th>Perekam</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data as $item)
                        <tr class="table-primary">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->meter }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->dusun }}</td>
                            <td>{{ $item->tariff }}</td>
                            <td>{{ $item->usage }}</td>
                            <td>{{ $item->petugas }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
</body>

</html>
