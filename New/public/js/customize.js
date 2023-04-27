function confirmDelete(result, endpoint) {
  if (result.isConfirmed) {
    return $.post(endpoint, {
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

// function customSelect2(ele, endpoint='', paramsKey=[], dropdownParentForModal='#filterCommentModal', keyResult=[]) {
//   $(ele).select2({
//     minimumInputLength: 4,
//     dropdownParent: $(dropdownParentForModal),
//     ajax: {
//       url: endpoint,
//       dataType: 'json',
//       type: "GET",
//       data: function (query) {
//         let term = query.term;
//         let q = '';
//         paramsKey.forEach( (item, index) => {
//           if (index == paramsKey.length - 1) {
//             q += `${item}:${term}`;
//           }else {
//             q += `${item}:${term};`;
//           }
//         });

//         return {
//           search: q
//         }
//       },
//       processResults: function (data) {
//         return {
//           results: $.map(data.data, function (item) {
//             return {
//               id: item[keyResult.id],
//               text: item[keyResult.text]
//             }
//           })
//         };
//       }
//     },
//     allowClear: true,
//     placeholder: 'Nhập thông tin tìm kiếm'
//   });
// }
