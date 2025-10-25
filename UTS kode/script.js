// Main JavaScript file with jQuery
$(document).ready(function() {
    console.log('📚 Sistem Peminjaman Siap!');

    initializeForm();
    initializeAnimations();
    initializeValidation();

    if ($('#dataTable').length > 0) {
        initializeResultsPage();
    }
});

function initializeForm() {
    // Counter karakter komentar
    $('#komentar').on('input', function() {
        const length = $(this).val().length;
        $('#char-count').text(length);
        $('#char-count').css('color', length >= 10 ? '#28a745' : '#e74c3c');
    });

    // Tombol reset
    $('#resetBtn').click(function() {
        resetForm();
    });

    // Proses submit
    $('#bookForm').on('submit', function(e) {
        e.preventDefault();

        if (validateForm()) {
            showLoading();

            // Kirim form ke server (proses.php)
            const form = this;
            setTimeout(() => {
                hideLoading(); // sembunyikan loading lebih cepat
                form.submit(); // kirim form secara asli (native)
            }, 800); // delay 0.8 detik agar animasi tetap terlihat
        }
    });
}

function initializeAnimations() {
    // Efek hover & fokus
    $('.form-group input, .form-group select, .form-group textarea')
        .hover(
            function() { $(this).css('transform', 'translateY(-1px)'); },
            function() { if (!$(this).is(':focus')) $(this).css('transform', 'translateY(0)'); }
        )
        .focus(function() {
            $(this).parent().addClass('focused');
            $(this).css('transform', 'translateY(-2px)');
        })
        .blur(function() {
            $(this).parent().removeClass('focused');
            if (!$(this).is(':hover')) $(this).css('transform', 'translateY(0)');
        });

    // Hover tombol
    $('.btn').hover(
        function() { $(this).addClass('btn-hover'); },
        function() { $(this).removeClass('btn-hover'); }
    );
}

function initializeValidation() {
    $('#nama').blur(function() {
        validateField('nama', $(this).val().trim() !== '', 'Nama harus diisi');
    });

    $('#email').blur(function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        validateField('email', emailRegex.test($(this).val().trim()), 'Format email tidak valid');
    });

    $('#judul_buku').blur(function() {
        validateField('judul_buku', $(this).val().trim() !== '', 'Judul buku harus diisi');
    });

    $('#lama_peminjaman').change(function() {
        validateField('lama_peminjaman', $(this).val() !== '', 'Pilih lama peminjaman');
    });

    $('#komentar').blur(function() {
        validateField('komentar', $(this).val().trim().length >= 10, 'Komentar minimal 10 karakter');
    });
}

function validateField(field, valid, msg) {
    const error = $(`#${field}-error`);
    const input = $(`#${field}`);

    if (!valid) {
        error.text(msg).addClass('show');
        input.css('border-color', '#e74c3c');
        return false;
    } else {
        error.removeClass('show');
        input.css('border-color', '#28a745');
        return true;
    }
}

function validateForm() {
    let ok = true;
    $('.error-message').removeClass('show');

    if ($('#nama').val().trim() === '') { 
        validateField('nama', false, 'Nama harus diisi'); ok = false; 
    }
    const email = $('#email').val().trim();
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { 
        validateField('email', false, 'Format email tidak valid'); ok = false; 
    }
    if ($('#judul_buku').val().trim() === '') { 
        validateField('judul_buku', false, 'Judul buku harus diisi'); ok = false; 
    }
    if ($('#lama_peminjaman').val() === '') { 
        validateField('lama_peminjaman', false, 'Pilih lama peminjaman'); ok = false; 
    }
    if ($('#komentar').val().trim().length < 10) { 
        validateField('komentar', false, 'Komentar minimal 10 karakter'); ok = false; 
    }

    if (!ok) {
        $('.form-container').addClass('shake');
        setTimeout(() => $('.form-container').removeClass('shake'), 600);
    }
    return ok;
}

function resetForm() {
    $('.form-container').fadeOut(200, function() {
        $('#bookForm')[0].reset();
        $('.error-message').removeClass('show');
        $('.form-group input, .form-group select, .form-group textarea').css('border-color', '#e1e5e9');
        $('#char-count').text('0').css('color', '#e74c3c');
        $(this).fadeIn(200);
    });
}

function showLoading() {
    $('#loadingOverlay').fadeIn(200);
}

function hideLoading() {
    $('#loadingOverlay').fadeOut(200);
}

// === Fungsi untuk halaman data ===
function initializeResultsPage() {
    console.log('Results page aktif');
    initializeModal();
}

function showFullComment(comment) {
    $('#fullComment').text(comment);
    $('#commentModal').fadeIn(200);
}

function closeModal() {
    $('#commentModal').fadeOut(200);
}

window.showFullComment = showFullComment;
window.closeModal = closeModal;
