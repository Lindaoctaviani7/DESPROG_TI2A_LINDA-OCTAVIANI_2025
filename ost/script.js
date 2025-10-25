$(document).ready(function() {
    $("#formBuku").on("submit", function(e) {
        let valid = true;
        $(".error").text("");

        if ($("#judul").val().trim() === "") {
            $("#errJudul").text("Judul buku wajib diisi");
            valid = false;
        }

        if ($("#peminjam").val().trim() === "") {
            $("#errPeminjam").text("Nama peminjam wajib diisi");
            valid = false;
        }

        let email = $("#email").val();
        let regexEmail = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!regexEmail.test(email)) {
            $("#errEmail").text("Format email tidak valid");
            valid = false;
        }

        if ($("#tgl_pinjam").val() === "") {
            $("#errTgl").text("Tanggal pinjam wajib diisi");
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            $("form").fadeOut(100).fadeIn(200);
        }
    });
});
