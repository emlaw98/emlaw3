'use strict';

function deleteCustomerGroup(element) {
  let customerGroup = $(element).parent().find('.customerGroupHidden').val();
  let customerGroupObj = JSON.parse(customerGroup);
  Swal.fire({
    title: `Hành động này sẽ không thể hoàn tác`,
    text: `Xoá nhóm KH: ${customerGroupObj.title}?`,
    icon: 'warning',
    showCancelButton: true,
  }).then(result => {
    if (result.isConfirmed) {
      $.post(`/customers-groups/${customerGroupObj.id}`, {
        _method: 'DELETE'
      }).then(res => {
        if (res.success) {
          Swal.fire({
            title: $.i18n('success'),
            text: res.message,
            icon: 'success',
            showCloseButton: true,
          }).then( () => {
            $(element).closest('tr').remove();
          })
        }
      })
    }
  });
}

function filterTable(element, selectorFilter) {
  let filterValue = element.value;
  $(selectorFilter).filter( (index, ele) => {
    let item = to_slug(ele.textContent);
    let isToggle = item.indexOf(to_slug(filterValue)) > -1;
    ele.style.display = isToggle ? '' : 'none';
  });
}
