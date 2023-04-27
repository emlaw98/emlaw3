'use strict'

var comment = {
    async getCustomerByKeyword() {
        if ($('#customer_id').length) {
            await $('#customer_id').select2({
                minimumInputLength: 4,
                ajax: {
                    url: '/customers/filter',
                    dataType: 'json',
                    type: "GET",
        
                    data: function (query) {
                        console.log(query);
                        return {
                            search: query.term
                        }
                    },
        
                    processResults: function (data) {
                        console.log(data);
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.fullname
                                }
                            })
                        };
                    }
                },
                allowClear: true,
                placeholder: 'Nhập thông tin tìm kiếm'
            });
        }
    },

    async getConstructionByKeyword() {
        if ($('#construction_id').length) {
            await $('#construction_id').select2({
                minimumInputLength: 4,
                ajax: {
                    url: '/constructions/filter',
                    dataType: 'json',
                    type: "GET",
        
                    data: function (query) {
                        console.log(query);
                        return {
                            search: query.term
                        }
                    },
        
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        };
                    }
                },
                allowClear: true,
                placeholder: 'Nhập thông tin tìm kiếm'
            });
        }
    },

    delete(ele) {
        shop.confirmActionDelete($.i18n('comment_delete'), () => {
            $(ele).attr('disabled', true)
                  .html($.i18n('loading_with_icon'));
            return $(ele).parent('form').submit();

        });
    },

    showFullContent(element) {
        let commentContent = $(element).siblings('.comment-full-content').val();
        $(element).parent().html(JSON.parse(commentContent));
    }
};

$(document).ready(function () {
    comment.getCustomerByKeyword();
    comment.getConstructionByKeyword();
});