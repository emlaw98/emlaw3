$(document).ready(function () {
    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            let menuPosition = window.JSON.stringify(list.nestable('serialize'));
            // output.val(menuPosition);//, null, 2));
            shop.ajax_popup('training_industry/updatePosition', 'POST', {
                menu: menuPosition
            }, res => {
                if (res.data > 0) {
                    swal("Thành công!", "Ngành đào tạo đã được sắp xếp", "success");
                }
            })
        } else {
            output.val('JSON browser support required for this demo.');
            return null;
        }
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1,
        maxDepth: 5
    }).on('change', updateOutput);

    // output initial serialised data
    $('.dd').nestable('serialize');
    // updateOutput($('#nestable').data('output', $('#nestable-output')));

    $('#nestable-menu').on('click', function (e) {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });

    $('#keyword_ti_filter').on('keyup', function () {
        let keyword = $(this).val();
        $("#dd-tree li").filter(function () {
            let txt = to_slug($(this).text());
            $(this).toggle(txt.indexOf(to_slug(keyword)) > -1);
        });
    });
});
