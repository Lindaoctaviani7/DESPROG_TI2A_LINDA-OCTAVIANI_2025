/* script.js */
/* Gaya penulisan: sederhana seperti mahasiswa */
$(function(){
  // helper email regex
  function isValidEmail(e){
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(e).toLowerCase());
  }

  // submit form with client validation
  $('#mainForm').on('submit', function(evt){
    // reset errors
    $('.error').text('');
    let ok = true;

    const name = $('#name').val().trim();
    const email = $('#email').val().trim();
    const comment = $('#comment').val().trim();

    if(name === ''){
      $('#err-name').text('Nama tidak boleh kosong.');
      ok = false;
    }
    if(email === ''){
      $('#err-email').text('Email tidak boleh kosong.');
      ok = false;
    } else if(!isValidEmail(email)){
      $('#err-email').text('Format email tidak valid.');
      ok = false;
    }
    if(comment.length <= 10){
      $('#err-comment').text('Komentar harus lebih dari 10 karakter.');
      ok = false;
    }

    if(!ok){
      evt.preventDefault();
      // efek getar / flash
      $('#formCard').animate({left:-6},60).animate({left:6},60).animate({left:0},60);
      return false;
    }

    // jika valid -> beri animasi slideUp lalu submit (biar user lihat animasi)
    evt.preventDefault();
    $('.btn.primary').prop('disabled', true).text('Mengirim...');
    $('#formCard').slideUp(400, function(){
      // setelah animasi selesai, submit form ke server
      evt.currentTarget.submit();
    });
  });

  // tombol bersihkan
  $('#clearBtn').on('click', function(){
    $('#name,#email,#comment').val('');
    $('.error').text('');
    // sedikit animasi
    $('#formCard').fadeOut(100).fadeIn(200);
  });

  // efek hover tombol
  $('.btn.primary').hover(
    function(){ $(this).css('box-shadow','0 6px 18px rgba(15,23,42,0.12)'); },
    function(){ $(this).css('box-shadow','none'); }
  );

  // jika ada hasil preview (dari server) - server bisa set flash via session redirect
  // kita mencoba mengambil preview minimal dari server lewat AJAX endpoint (optional)
  // tapi sesuai permintaan: tidak pakai localStorage, jadi tampilan utama menunggu redirect.
});
