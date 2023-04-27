'use strict'

function executeDelete(result, itemId, endpoint='') {
  if (result.isConfirmed) {
    let url = `/galleries-labels/${itemId}`;
    if (endpoint.length > 0) {
      url = endpoint;
    }

    return $.post(url, {
      _method: "DELETE"
    });
  }
}

function handleDeleteResult(element, res) {
  if (res && res.success) {
    return Swal.fire({
      title: $.i18n('success'),
      text: res.message,
      icon: 'success',
      showCloseButton: true,
    }).then( () => {
      $(element).closest('[data-id]').remove();
    });
  }
}

function deleteGalleryLabel(element, hiddenInput, endpoint) {
  let galleryStr = $(element).parent().find(hiddenInput).val();
  let gallery = JSON.parse(galleryStr);

  Swal.fire({
    title: $.i18n('confirm_title'),
    text: $.i18n('delete', gallery.title),
    icon: 'warning',
    showCancelButton: true,
  }).then(result => executeDelete(result, gallery.id, endpoint))
    .then(res => handleDeleteResult(element, res))
}
