'use strict';

let log = {
    showLogDetail(element) {
        let apiLog = JSON.parse($(element).siblings('.api-log-item').val());
        let apiLogFormatData = JSON.stringify(apiLog, null, '\t');
        
        $('#modalApiLogDetail').modal('show');
        $('#modalApiLogDetail #modal-body-content').text(`${apiLogFormatData}`)
    }
}