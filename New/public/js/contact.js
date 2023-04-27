'use strict';

var contacts = {
    async delete(ele) {
        let contact = $(ele).siblings('.contact-info').val();
        contact = JSON.parse(contact);

        let confirmText = `
            Xóa khách hàng: ${contact.name} <br>
            <i class="fa fa-envelope-o w-15" aria-hidden="true"></i> ${contact.email} ?
        `;

        shop.confirmActionDelete(confirmText, async () => {
            let deleteContactUrl = `${baseUrl}/lien-he/${contact.id}`;
            let result = await $.post(deleteContactUrl, {
                _method: 'DELETE'
            });

            if (result.success) {
                return Swal.fire({
                    title: 'Thành công!',
                    text: result.message,
                    showCloseButton: true,
                    icon: "success"
                }).then(() => {
                    $(ele).parents('tr').remove();
                });
            }
        });
    }
};