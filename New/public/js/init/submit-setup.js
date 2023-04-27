$(document).ready(function () {
    $('button[type="submit"]').on('click', function () {
        let thisBtn = $(this);
        let hasValidate = thisBtn.closest('form').attr('novalidate');
        // console.log(hasValidate);

        if (typeof hasValidate !== typeof undefined && hasValidate !== false) {
            admin.showLoader();
            let message = '';

            thisBtn.closest('form').find('input:required,select:required').each(function () {
                if ($(this).val() === '') {
                    if ($(this).attr('placeholder') !== '') {
                        message += 'Vui lòng nhập ' + $(this).attr('placeholder').toLowerCase() + '<br>';
                    }
                }
            });

            if (message !== '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Cảnh báo',
                    html: message,
                });

                admin.hideLoader();
                event.preventDefault();
                return false;
            }
        }
    });

    $('form').on('submit', function () {
        admin.showLoader();
        let btnSubmit = $(this).find('[type="submit"]');
        btnSubmit.attr('disabled', true)
            .html('<i class="fa fa-spinner fa-pulse fa-fw"></i> ' + btnSubmit.text());
    });
});
