<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .margin-top {
            margin-top: 20px;
        }

        .total {
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
            padding-right: 20px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
        }

        h2,
        h4 {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <h2>Analisis Beban Kerja: {{ $beban_kerja[0]->user->name }}</h2>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <h4>Tahun: {{ $beban_kerja[0]->tahun }}</h4>
                </td>
            </tr>
        </table>
    </div>

    <div class="margin-top">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Tugas Rutin</th>
                    <th>Output/KPI</th>
                    <th>Volume</th>
                    <th>Time Allocated</th>
                    <th>Daily Volume</th>
                    <th>Daily Time</th>
                    <th>Daily Used</th>
                    <th>FTE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($beban_kerja as $bk)
                    <tr>
                        <td>{{ $bk->tugasRutin->name }}</td>
                        <td>{{ $bk->tugasRutin->tugas_rutin }}</td>
                        <td>{{ $bk->output }}</td>
                        <td>{{ $bk->volume }} x /tahun</td>
                        <td>{{ $bk->time_allocated }}</td>
                        <td>{{ $bk->daily_volume }}</td>
                        <td>{{ $bk->daily_time }}</td>
                        <td>{{ $bk->daily_used }}</td>
                        <td>{{ $bk->fte }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        Total: $129.00 USD
    </div>

    <div class="footer">
        <div>Thank you</div>
        <div>&copy; Laravel Daily</div>
    </div>
</body>

</html>
