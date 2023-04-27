'use strict';

var faq = {
    delete(question, ele) {
        shop.confirmActionDelete($.i18n('faq_confirm_delete', question), () => {
            $(ele).attr('disabled', true)
                  .html($.i18n('loading_with_icon'));
            return $(ele).parent().submit();
        });
    }
}