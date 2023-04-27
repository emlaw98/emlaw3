'use strict';

var comment_bad_word = {
    delete(badWord, ele) {
        shop.confirmActionDelete($.i18n('comment_badword_delete', badWord), () => {
            $(ele).attr('disabled', true)
                  .html($.i18n('loading_with_icon'));
            return $(ele).parent().submit();
        });
    },

    async generateLanguageFile(element) {
        shop.addLoader(element);
        let generateResult = await $.post('bad-word/generate');
        shop.removeLoader(element, $(element).text());

        if (generateResult.success) {
            Swal.fire({
                title: 'Thông báo',
                text:  $.i18n(generateResult.message),
                showCloseButton: true,
                icon: "info"
            });
        }
    }
} // End class