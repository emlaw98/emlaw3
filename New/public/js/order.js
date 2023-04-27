function alertChangeOrderState(url, messageContent='', messageTitle='Xác nhận!') {
  Swal.fire({
    title: $.i18n(messageTitle),
    text:  $.i18n(messageContent),
    showCloseButton: true,
    icon: "question"
  }).then( confirm => handleChangeStateOrderResult(confirm, url))
}

function handleChangeStateOrderResult(confirm, url) {
  if (confirm.isConfirmed) {
    $.post(url).then(res => {
      Swal.fire({
        title: $.i18n('Thông báo'),
        text:  $.i18n(res.message),
        showCloseButton: true,
        icon: "question"
      }).then(r => {
        location.reload();
      })
    });
  }
}

$(document).ready(function () {
  let $userHandle = $('#user-handle')
  $userHandle.select2({
    minimumInputLength: 3,
    ajax: {
      url: "/users/filter",
      dataType: 'json',
      type: "GET",
      data: function (query) {
        let term = query.term;
        return {
          search: `name:${term};email:${term};phone:${term}`
        }
      },
      processResults: function (data) {
        return {
            results: $.map(data.data, function (item) {
                return {
                    text: `${item.email} (${item.name})`,
                    id: item.id
                }
            })
        };
      }
    }
  });

  let checkHasUserId = hasQueryStr('user_id');
  if (checkHasUserId) {
    $userHandle.append(`<option value="${checkHasUserId}" selected="selected">${$('#user-hanleName').val()}</option>`);
    $userHandle.trigger('change');
  }
});

