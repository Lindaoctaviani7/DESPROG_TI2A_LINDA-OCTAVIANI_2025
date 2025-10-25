// script.js
$(function(){
  // pilih warna
  let selected = [];
  $('#colorPool .swatch, .swatch').on('click', function(){
    const color = $(this).data('color');
    const hidden = $('#colors');
    // toggle select
    if ($(this).hasClass('selected')) {
      $(this).removeClass('selected').css('outline','none');
      selected = selected.filter(c=>c!==color);
    } else {
      if (selected.length >= 3) {
        alert('Maksimum 3 warna');
        return;
      }
      $(this).addClass('selected').css('outline','3px solid rgba(0,0,0,0.15)');
      selected.push(color);
    }
    hidden.val(selected.join(','));
    // apply to SVG preview if present
    $('#layer1').attr('fill', selected[0] || '#fff2f5');
    $('#layer2').attr('fill', selected[1] || '#fff7f2');
    $('#topper').attr('fill', selected[2] || '#ffdede');
  });

  // client validation: index.php form (there are 2 forms in different versions)
  $('#orderForm').on('submit', function(e){
    // validate client-side: name, email valid, komentar >=10, colors<=3
    $('.err').text('');
    let valid = true;
    const nama = $('#nama').val().trim();
    const email = $('#email').val().trim();
    const komentar = $('#komentar').val().trim();
    const colors = $('#colors').val() ? $('#colors').val().split(',').filter(Boolean) : [];
    if (!nama) { $('#errNama').text('Nama wajib diisi'); valid=false; }
    if (!email || !/^[^ ]+@[^ ]+\.[a-z]{2,}$/i.test(email)) { $('#errEmail').text('Email tidak valid'); valid=false; }
    if (komentar.length < 10) { $('#errKomentar').text('Komentar minimal 10 karakter'); valid=false; }
    if (colors.length > 3) { $('#errColors').text('Pilih maksimal 3 warna'); valid=false; }
    if (!valid) e.preventDefault();
  });

  // handle advance/cancel via AJAX
  $(document).on('click', '.advance', function(){
    const id = $(this).data('id');
    const $badge = $(this).closest('.orderCard').find('.badge');
    $.post('update_status.php',{ action:'advance', id: id }, function(resp){
      if (resp.ok) {
        $badge.text(resp.status).attr('class','badge status-'+resp.status);
      } else alert(resp.msg || 'Gagal');
    }, 'json');
  });

  $(document).on('click', '.cancel', function(){
    const id = $(this).data('id');
    const $badge = $(this).closest('.orderCard').find('.badge');
    $.post('update_status.php',{ action:'cancel', id: id }, function(resp){
      if (resp.ok) {
        $badge.text(resp.status).attr('class','badge status-'+resp.status);
      } else alert(resp.msg || 'Gagal');
    }, 'json');
  });

  // small UI: make swatches in index.php (not index.html version)
  // if colorPool exists in that page
  $('#colorPool .swatch').click(function(){ /* code above handles also */});
});
