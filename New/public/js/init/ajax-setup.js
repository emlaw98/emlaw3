$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      'Access-Control-Allow-Origin': '*',
      'X-Frame-Options': 'SAMEORIGIN',
    },
  });
})

$(document).ajaxStart(function () {
  NProgress.start()
}).ajaxStop(function () {
  NProgress.done()
});
