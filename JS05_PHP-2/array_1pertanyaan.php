<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h2>Array terindeks menggunakan loop</h2>
    <?php
        //array yang sama seperti sebelumnya
        $Listdosen=["Elok Nur Hamdana", "Unggul Pamenang", "Bagas Nugraha"];

        //menggunakan loop foreach
        foreach($Listdosen as $dosen){
            echo $dosen . "<br>";
        }
    ?>
</body>
</html>