<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Dosen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        .styled-table {
            border-collapse: collapse;
            margin: 25px auto;
            font-size: 0.9em;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            border-radius: 5px 5px 0 0;
            overflow: hidden;
        }
        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        .styled-table th,
        .styled-table td {
            padding:12px 15px;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }
        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }
        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        .styled-table td:first-chid {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
<?php
    // data dosen
    $Dosen = [
        'nama' => 'Elok nur hamdan',
        'domisili' => 'Malang',
        'jenis_kelamin' => 'Perempuan'
    ];
?>

<table class="styled-table">
    <thead>
        <tr>
            <th colspan="2">Profil Dosen</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php
            // loop untuk mengisi baris tabel dari data array
            foreach ($Dosen as $key => $values) {
                echo "<tr>
                        <td>" . ucwords($key) . "</td>
                        <td>" . $values . "</td>
                    </tr>";
            }
        ?>
    </tbody>
</table>
</body>
</html