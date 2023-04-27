'use strict';

$(document).ready(function () {
  $('iframe').on('load', function() {
    let iframeObject = this.contentWindow.document.getElementById('sectionContent');
    if (iframeObject) {
      let iFrameHeight = iframeObject.offsetHeight + 'px';
      $('#iframeLoadData').height(iFrameHeight);
      $('#iframeLoadFE').height(iFrameHeight);
    }
  });
})

function getHeightIframe() {
  let iframehght =  $("#modalIframe").contents().height();
  $('#iframeLoadData').height(iframehght);
}

function loadIframe(element, site) {
  $('#modalIframe').modal('show');
  $('#iframeLoadData').attr('src', site);
}

function closeFrame(iframeData={}, viewRender='', itemEach=null, itemAppend=null) {
  if (typeof iframeData == 'string') {
    iframeData = JSON.parse(iframeData);
  }

  iframeData.viewRender = viewRender;

  let postMessageObject = {
    itemEach: itemEach,
    itemAppend: itemAppend,
    data: {},
    id: iframeData.id || null
  };

  if ( viewRender.length > 0 ) {
    try {
      $.post('/common/render-item', iframeData).then(res => {
        postMessageObject.data = res.data;
        window.parent.postMessage(postMessageObject, '*');
      }).catch(err => {
        console.log(err);
      });

      return false;
    }catch(err){
      console.log(err);
    }
  }else {
    window.parent.postMessage(postMessageObject, '*');
  }
}

$(window).on('message', function (e) {
  if (document.getElementsByName('iframeLoadData').length) {
    document.getElementsByName('iframeLoadData')[0].src = '';
    
    let message = e.originalEvent.data;
    if (message == 'openDialogFullScreen') {
      window.scrollTo(500, 500);
    }else {
      let itemEach = message.itemEach;
      let itemAppend = message.itemAppend;

      if (!itemEach) {
        itemEach = '#tableCustomer tbody tr';
      }

      if (!itemAppend) {
        itemAppend = '#tableCustomer tbody';
      }
      //if (message.actionValue == 'cancel') {
        $('#modalIframe').modal('hide');
        if ( !jQuery.isEmptyObject(message.data) ) {
          let flagReplace = false;

          $(itemEach).each(function (index, item) {
            if ($(item).data('id') == message.id) {
              flagReplace = true;
              $(item).replaceWith(message.data);
            }
          });

          if (!flagReplace) {
            $(itemAppend).prepend(message.data);
          }
        }
      //}
    }
  }
});

function iframeResize(){
  var width = $(window).width();
  var height = $(window).height();
  $('#iframeLoadFE').css({
    height : 'height',
    display: 'block',
    border: 'none',
    'overflow-y': 'auto',
    'overflow-x': 'hidden'
  });
}

$(window).on('resize', iframeResize)
$(document).ready(function () {
  iframeResize();
});
