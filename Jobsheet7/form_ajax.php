<!DOCTYPE html>
<html>
<head>
    <title>Contooh Form dengan PHP dan jQuery</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Form Contoh</h2>
    <form id="myForm">
        <label for="buah">Pilih Buah:</label>
        <select name="buah" id="buah">
            <option value="apel">Apel</option>
            <option value="pisang">Pisang</option>
            <option value="mangga">Mangga</option>
            <option value="jeruk">Jeruk</option>
        </select>

        <br>

        <label>Pilih Warna Favorit:</label><br>
        <input type="checkbox" name="warna[]" value="merah"> Merah<br>
        <input type="checkbox" name="warna[]" value="biru"> Biru<br>
        <input type="checkbox" name="warna[]" value="hijau"> Hijau<br>

        <br>

        <label>Pilih Jenis Kelamin:</label><br>
        <input type="radio" name="jenis_kelamin" value="laki-laki"> Laki-laki<br>
        <input type="radio" name="jenis_kelamin" value="perempuan"> Perempuan<br>

        <br>

        <input type="submit" value="Submit">
    </form>

    <div id="hasil">
        <!-- Hasil akan ditampilkan di sini -->
    </div>

    <script>
        $(document).ready(function () {
            $('#myForm').submit(function (e) {
                e.preventDefault(); //mencegah pengiriman form secara default

                //mengumpulkan data form
                var formData = $("#myForm").serialize();

                //kirim data ke server PHP
                $.ajax({
                    url: "form_lanjut.php", //ganti dengan path ke file PHP Anda
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        //tampilkan hasil dari sever di div "hasil"
                        $('#hasil').html(response);
                    },
                });
            });
        });
    </script>
</body>
</html>