$(document).ready(function () {
    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            let menuPosition = window.JSON.stringify(list.nestable('serialize'));
           // output.val(menuPosition);//, null, 2));
           console.log(e);
            $.post('/menu/position', {
              menus: menuPosition
            }).then(res => {
              if (res.success) {
                Swal.fire({
                  title: $.i18n('success'),
                  text: res.message,
                  icon: 'success',
                  showCloseButton: true,
                })
              }
            })
        } else {
            output.val('JSON browser support required for this demo.');
            return null;
        }
    };

    // activate Nestable for list 1
    // $('#nestable-0, #nestable-1, #nestable-2, #nestable-3').nestable({
    $('.cf.nestable-lists').nestable({
        group: 1,
        maxDepth: 3
    }).on('change', updateOutput);

    // output initial serialised data
    $('.dd').nestable('serialize');

    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });
});

function removeMenu(element, menuId) {
  let name = $(element).parents('.dd3-content').find('.menu-title').text();
  Swal.fire({
    title: $.i18n('confirm_title'),
    text: $.i18n('menu_delete', name),
    icon: 'warning',
    showCancelButton: true,
  }).then(result => {
    if (result.isConfirmed) {
      $.post(`/menu/${menuId}`, {
        _method: "DELETE"
      }).then(res => {
        if (res.success) {
          Swal.fire({
            title: $.i18n('success'),
            text: res.message,
            icon: 'success',
            showCloseButton: true,
          }).then( () => {
            console.log($(element))
            $(element).closest('.dd-item').remove();
          })
        }
      })
    }
  });
}

function getMenuTreeByType(element, outputElement) {
  let typeId = element.value;
  $.get(`/menu/type/${typeId}`).then(res => {
    if (res.success) {
      Swal.close();
      $(outputElement).html(res.data);
    }
  });
}
