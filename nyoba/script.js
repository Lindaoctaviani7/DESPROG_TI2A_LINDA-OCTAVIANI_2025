$(document).ready(function() {
    $("#formBuku").on("submit", function(e) {
        let valid = true;
        $(".error").text("");

        // Validasi judul
        if ($("#judul").val().trim() === "") {
            $("#errJudul").text("Judul buku wajib diisi");
            valid = false;
        }

        // Validasi nama
        if ($("#peminjam").val().trim() === "") {
            $("#errPeminjam").text("Nama peminjam wajib diisi");
            valid = false;
        }

        // Validasi email
        let email = $("#email").val();
        let regexEmail = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!regexEmail.test(email)) {
            $("#errEmail").text("Format email tidak valid");
            valid = false;
        }

        // Validasi tanggal
        if ($("#tgl_pinjam").val() === "") {
            $("#errTgl").text("Tanggal pinjam wajib diisi");
            valid = false;
        }

        // Validasi komentar
        let komentar = $("#komentar").val().trim();
        if (komentar.length < 10) {
            $("#errKomentar").text("Komentar minimal 10 karakter");
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            $("form").fadeOut(100).fadeIn(200);
        }
    });

    // Efek hover tombol
    $("#btnKirim").hover(
        function() {
            $(this).css("background", "linear-gradient(90deg, #6a11cb, #2575fc)");
        },
        function() {
            $(this).css("background", "linear-gradient(90deg, #2575fc, #6a11cb)");
        }
    );
});
