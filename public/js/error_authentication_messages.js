document.addEventListener("DOMContentLoaded", function () {
   const urlParams = new URLSearchParams(window.location.search);
   const msg = urlParams.get('msg');
   if (msg !== null) {
       exibirToastErro(msg);
   }
});