// assets/js/app.js
// Konfirmasi sebelum form dengan atribut data-confirm dikirim (mis. hapus data)
document.addEventListener('submit', function (ev) {
  var pesan = ev.target.getAttribute('data-confirm');
  if (pesan && !window.confirm(pesan)) {
    ev.preventDefault();
  }
});
