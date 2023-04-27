'use strict';

let construction = {
    offset: 0,

    async loadMoreComment(constructionId, offset=10) {
        let url = `${baseUrl}/constructions/${constructionId}/comments`;
        this.offset = this.offset + offset;

        let comments = await $.get(url, {
            offset: this.offset
        });

        if (comments.data.length > 0) {
            return $('#comment-area').append(comments.data);
        }

        return Swal.fire({
            title: 'Thông báo',
            text:  'Đã tải hết toàn bộ đánh giá',
            showCloseButton: true,
            icon: "info"
        }).then( () => {
            $('#load-more-comment-action').hide();
        });
    }
};