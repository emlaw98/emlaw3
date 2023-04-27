function loadMoreComment(commentId, ele) {
  $.post('/comments/load-more', {
    id: commentId
  }).then(res => {
    let elementDisplay = $(ele).closest('.media-body').find('.d-flex');
        elementDisplay.nextAll().remove();
        elementDisplay.after(res.data);
  }).then(res => {
    $(ele).remove();
  })
}

function deleteComment(ele, endpoint) {
  let comment = $(ele).siblings('.comment-item-hidden').val();
      comment = JSON.parse(comment);
  let confirmText = 'Xóa bình luận này?';
  if (comment.childrens_count > 0) {
    confirmText = 'Xóa bình luận này đồng nghĩa các bình luận con cũng sẽ không hiển thị!';
  }

  Swal.fire({
    title: $.i18n('confirm_title'),
    text: confirmText,
    icon: 'warning',
    showCancelButton: true,
  }).then(result => confirmDelete(result, endpoint))
    .then(res => handleDeleteResult(ele, res));
}


function confirmAction(ele, endpoint, approveConfirmText='') {
  let comment = $(ele).siblings('.comment-item-hidden').val();
      comment = JSON.parse(comment);
    Swal.fire({
      title: $.i18n('confirm_title'),
      text: approveConfirmText,
      icon: 'warning',
      showCancelButton: true,
    }).then(result => executeConfirmAction(result, endpoint, comment))
      .then(res => handleConfirmActionResult(ele, res, comment));
}

function executeConfirmAction(result, endpoint, comment) {
  if (result.isConfirmed) {
    return $.post(endpoint, {
      id: comment.id,
      approved: comment.approved == 0 ? 1 : 0
    });
  }
}

function handleConfirmActionResult(ele, res, comment) {
  return Swal.fire({
    title: $.i18n('success'),
    text: res.message,
    icon: 'success',
    showCloseButton: true,
  }).then( () => {
    location.reload();
  });
}

$(document).ready(function () {
  // customSelect2('#customer_id', '/customers/filter', ['fullname', 'email', 'phone'], '#filterCommentModal', {id: 'id', text: 'email'});

  let checkHasCustomerId = hasQueryStr('customer_id');
  if (checkHasCustomerId) {
    $('#customer_id').append(`<option value="${checkHasCustomerId}" selected="selected">${$('#customer-handleName').val()}</option>`);
    $('#customer_id').trigger('change');
  }
});

