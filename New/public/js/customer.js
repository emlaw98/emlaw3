'use strict';

function addQueryParams(param, value) {
  if (!value) {
    value = '0';
  }
  var url = new URL(window.location.href);
  url.searchParams.set(param, value);
  location.replace(url);
}

function deleteCustomer(element) {
  let customer = $(element).parent().find('.customer-hidden').val();
  let customerObject = JSON.parse(customer);
  Swal.fire({
    title: `Hành động này sẽ không thể hoàn tác`,
    text: `Xoá khách hàng: ${customerObject.email}?`,
    icon: 'warning',
    showCancelButton: true,
  }).then(result => {
    if (result.isConfirmed) {
      $.post(`customers/${customerObject.id}`, {
        _method: 'DELETE'
      }).then(res => {
        if (res.success) {
          Swal.fire({
            title: $.i18n('success'),
            text: res.message,
            icon: 'success',
            showCloseButton: true,
          }).then( () => {
            $(element).closest('tr').remove()
          });
        }
      });
    }
  });
}




