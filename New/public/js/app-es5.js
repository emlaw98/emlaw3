'use strict';

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function to_slug() {
  var str = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';

  if (!str) {
    str = '';
  } // Chuyển hết sang chữ thường


  str = str.toLowerCase().trim(); // xóa dấu

  str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
  str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
  str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
  str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
  str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
  str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
  str = str.replace(/(đ)/g, 'd'); // Xóa ký tự đặc biệt

  str = str.replace(/([^0-9a-z-\s])/g, ''); // Xóa khoảng trắng thay bằng ký tự -

  str = str.replace(/(\s+)/g, '-'); // xóa phần dự - ở đầu

  str = str.replace(/^-+/g, ''); // xóa phần dư - ở cuối

  str = str.replace(/-+$/g, ''); // return

  return str;
}

function hasQueryStr(query) {
  var url = new URL(window.location.href);
  return url.searchParams.get(query);
}

shop.ready.add(function () {
  // console.log('admin.js start');
  $('.datepicker').datetimepicker({
    format: 'd/m/Y',
    timepicker: false
  });
  admin.activeLog();
}, true);
var admin = {
  activeLog: function activeLog() {
    setTimeout(function () {
      shop.ajax_popup('/users/active-log', 'GET');
    }, 1000);
  },
  system: {
    ckEditor: function ckEditor(ele, width, height, theme, toolbar, css, id_img_btn) {
      css = css ? css : ENV.BASE_URL + 'css/style_editor.css?v=1';

      if (Array.isArray(ele)) {
        for (var i = 0; i < ele.length; i++) {
          CKEDITOR.replace(ele[i], {
            toolbar: toolbar,
            width: width,
            height: height,
            language: 'vi',
            contentsCss: css,
            allowedContent: true
          });
        }
      } else {
        var instance_ck = CKEDITOR.replace(ele, {
          toolbar: toolbar,
          width: width,
          height: height,
          language: 'vi',
          contentsCss: css,
          allowedContent: true,
          extraPlugins: 'embed'
        });
        instance_ck.addCommand("mySimpleCommand", {
          exec: function exec(edt) {
            var abc = $('#uploadifive-' + id_img_btn + ' input');

            if (typeof abc != 'undefined') {
              $(abc[abc.length - 1]).click();
            }
          }
        });
        instance_ck.ui.addButton('ImgUploadBtn', {
          type: 'button',
          label: "Upload ảnh lên chèn vào nội dung",
          command: 'mySimpleCommand',
          // toolbar: 'insert',
          icon: 'plugins/iconfinder_image_272698.png'
        });
      }
    },
    tinyMCE: function tinyMCE(selector) {
      var plugins = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      var menubar = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
      var toolbar = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : '';
      var height = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : 600;
      var width = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : 'auto';
      tinymce.init({
        selector: selector,
        plugins: !plugins ? 'grid save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons' : plugins,
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: !menubar ? 'file edit view insert format tools table help' : menubar,
        toolbar: !toolbar ? 'grid_insert | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | emoticons | fullscreen  preview save image | insertfile print charmap media template link anchor codesample | ltr rtl' : toolbar,
        grid_preset: 'Bootstrap3',
        fontsize_formats: "8px 9px 10px 11px 12px 14px 18px 24px 30px 36px",
        toolbar_sticky: false,
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,
        content_css: '//www.tiny.cloud/css/codepen.min.css',
        // link_list: [
        //     { title: 'My page 1', value: 'http://www.tinymce.com' },
        //     { title: 'My page 2', value: 'http://www.moxiecode.com' }
        // ],
        // image_list: [
        //     { title: 'My page 1', value: 'http://www.tinymce.com' },
        //     { title: 'My page 2', value: 'http://www.moxiecode.com' }
        // ],
        // image_class_list: [
        //     { title: 'None', value: '' },
        //     { title: 'Some class', value: 'class-name' }
        // ],
        importcss_append: true,
        // file_picker_callback: function (callback, value, meta) {
        //     /* Provide file and text for the link dialog */
        //     if (meta.filetype === 'file') {
        //         callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
        //     }
        //
        //     /* Provide image and alt text for the image dialog */
        //     if (meta.filetype === 'image') {
        //         callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
        //     }
        //
        //     /* Provide alternative source and posted for the media dialog */
        //     if (meta.filetype === 'media') {
        //         callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
        //     }
        // },
        templates: [{
          title: 'New Table',
          description: 'creates a new table',
          content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
        }, {
          title: 'Starting my story',
          description: 'A cure for writers block',
          content: 'Once upon a time...'
        }, {
          title: 'New list with dates',
          description: 'New List with dates',
          content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
        }],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: height,
        width: width,
        image_caption: true,
        relative_urls: false,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: "mceNonEditable",
        toolbar_mode: 'sliding',
        contextmenu: "link image imagetools table",
        file_picker_callback: function file_picker_callback(callback, value, meta) {
          // let field = win.document.getElementById(field_name)
          var windowName = 'Media Window'; // newwindow = window.open(url_call,windowName,'height=630,width=1200');
          // var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
          // var eventer = window[eventMethod];
          // var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

          var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
          var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
          var type = 'image' === meta.filetype ? 'Images' : 'Files',
              url = '/file/laravel-filemanager?editor=tinymce5&type=' + type;
          tinymce.activeEditor.windowManager.openUrl({
            url: url,
            title: windowName,
            width: x * 0.8,
            height: y * 0.8,
            onMessage: function onMessage(api, message) {
              callback(message.content);
            }
          }); // Listen to message from child window
          // eventer(messageEvent,function(e) {
          //     console.log('origin: ', e.origin);
          //     // Check if origin is proper
          //     var origin = ENV.PUBLIC_URL.slice(0, -1);
          //     if( e.origin != origin ){ return }
          //     console.log('parent received message!: ', e.data);
          //     if(typeof e.data == 'string') {
          //         callback(e.data.replace(origin, ''));
          //         // if (meta.filetype === 'image') {
          //         //     callback(e.data.replace(origin, ''), {alt: ''});
          //         // }
          //         // if (meta.filetype === 'media') {
          //         //     callback(e.data.replace(origin, ''));
          //         // }
          //         // if (meta.filetype === 'file') {
          //         //     callback(e.data.replace(origin, ''), {text: 'My text'});
          //         // }
          //     }
          // }, false);
          // if (window.focus) {newwindow.focus()}
          // return false;
          // EventHub.listen('file_selected', (path) => {
          //
          // })
        } // (optional) close the manager when pressing "OK"
        // init_instance_callback(editor) {
        //     editor.on('BeforeSetContent', () => {
        //         if(typeof newwindow != 'undefined') {
        //             newwindow.close();
        //         }
        //     })
        // },

      });
    }
  },
  tags: {
    init_more: function init_more(container) {
      $(container).tagEditor({
        initialTags: $(container).val().split(','),
        sortable: false,
        forceLowercase: false,
        placeholder: '',
        onChange: function onChange(field, editor, tags) {
          $(field).val(tags.length ? tags.join(',') : '');
        }
      });
    },
    init: function init(type, container, id, suggest, no_load_more) {
      if (suggest || no_load_more) {
        $(container).tagEditor({
          initialTags: $(container).val().split(','),
          autocomplete: {
            delay: 0,
            // show suggestions immediately
            position: {
              collision: 'flip'
            },
            // automatic menu position up/down
            source: suggest ? suggest : []
          },
          sortable: false,
          forceLowercase: false,
          placeholder: '',
          onChange: function onChange(field, editor, tags) {
            $(field).val(tags.length ? tags.join(',') : '');
          },
          beforeTagSave: function beforeTagSave(field, editor, tags, tag, val) {
            shop.admin.tags.add(val, type);
          },
          beforeTagDelete: function beforeTagDelete(field, editor, tags, val) {
            var q = confirm('Xóa tag "' + val + '"?');

            if (q) {
              shop.admin.tags.remove(val, type, id);
            }

            return q;
          }
        });
      } else {
        shop.admin.tags.loadSuggest(type, container, id);
      }
    },
    loadSuggest: function loadSuggest(type, container, id) {
      shop.ajax_popup('tag/tag-suggest', 'POST', {
        type: type
      }, function (json) {
        if (json.error == 0) {
          shop.admin.tags.init(type, container, id, json.data, true);
        } else {
          alert(json.msg);
        }
      });
    },
    add: function add(tag, type) {
      shop.ajax_popup('tag/tag-add', 'POST', {
        tag: tag,
        type: type
      }, function (json) {
        if (json.error != 0) {
          alert(json.msg);
        }
      });
    },
    remove: function remove(tag, type, id) {
      shop.ajax_popup('tag/tag-del', 'POST', {
        tag: tag,
        type: type,
        id: id
      }, function (json) {
        if (json.error != 0) {
          alert(json.msg);
        }
      });
    }
  },
  filters: {
    init_more: function init_more(container) {
      $(container).tagEditor({
        initialTags: $(container).val().split(','),
        sortable: false,
        forceLowercase: false,
        placeholder: '',
        onChange: function onChange(field, editor, tags) {
          $(field).val(tags.length ? tags.join(',') : '');
        }
      });
    },
    init: function init(type, container, id, suggest, no_load_more, max_tag) {
      if (suggest || no_load_more) {
        $(container).tagEditor({
          initialTags: $(container).val().split(','),
          autocomplete: {
            delay: 0,
            // show suggestions immediately
            position: {
              collision: 'flip'
            },
            // automatic menu position up/down
            source: suggest ? suggest : []
          },
          sortable: false,
          forceLowercase: false,
          placeholder: '',
          maxTags: max_tag ? max_tag : null,
          // onChange: function (field, editor, tags) {
          //     $(field).val(tags.length ? tags.join(',') : '');
          // },
          beforeTagSave: function beforeTagSave(field, editor, tags, tag, val) {
            shop.admin.filters.add(val, type);
          },
          beforeTagDelete: function beforeTagDelete(field, editor, tags, val) {
            var q = confirm('Xóa tag "' + val + '"?');

            if (q) {
              shop.admin.filters.remove(val, type, id);
            }

            return q;
          }
        });
      } else {
        shop.admin.filters.loadSuggest(type, container, id, max_tag);
      }
    },
    loadSuggest: function loadSuggest(type, container, id, max_tag) {
      shop.ajax_popup('filter/filter-suggest', 'POST', {
        type: type
      }, function (json) {
        if (json.error == 0) {
          shop.admin.filters.init(type, container, id, json.data, true, max_tag);
        } else {
          alert(json.msg);
        }
      });
    },
    add: function add(filter, type) {
      shop.ajax_popup('filter/filter-add', 'POST', {
        filter: filter,
        type: type
      }, function (json) {
        if (json.error != 0) {
          alert(json.msg);
        }
      });
    },
    remove: function remove(filter, type, id) {
      shop.ajax_popup('filter/filter-del', 'POST', {
        filter: filter,
        type: type,
        id: id
      }, function (json) {
        if (json.error != 0) {
          alert(json.msg);
        }
      });
    }
  },
  api: {
    showLog: function showLog(id) {
      shop.ajax_popup('apilog/view', 'POST', {
        id: id
      }, function (json) {
        if (json.error != 0) {
          alert(json.msg);
        } else {
          //update title
          var data = json.data,
              html = shop.join('<div><b>Request URL:</b> ' + data.url + '</div>')('<div class="mt-2"><b>Call time:</b> ' + data.created + '</div>')('<div class="mt-2"><b>Status:</b> ' + (data.error ? '<span class="text-danger">Error</span>' : '<span class="text-success">Success</span>') + '</div>')('<div class="mt-2"><b>Sign server:</b></div>')('<div class="mt-2" style="word-wrap: break-word;">' + data.apisign_server + '</div>')('<div class="mt-2"><b>Sign client:</b></div>')('<div class="mt-2" style="word-wrap: break-word;">' + data.apisign + '</div>')('<div class="mt-2"><b>Params:</b></div>')('<div class="mt-2" style="word-wrap: break-word;">' + data.params + '</div>')('<div class="mt-2"><b>Return:</b></div>')('<div class="mt-2" style="word-wrap: break-word;">' + (data.error ? data.error : data.return) + '</div>')();
          $('#primaryModal .modal-body').html(html);
          $('#primaryModal').modal();
        }
      });
    }
  },
  delete_this: function delete_this(el) {
    Swal.fire({
      title: 'Bạn đã chắc chắn?',
      text: "Không thể hoàn tác sau khi đồng ý!",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Đồng ý!'
    }).then(function (result) {
      //console.log(result);
      if (result.isConfirmed) {
        // admin.showLoader();
        $.ajax({
          url: $(el).attr('data-href'),
          data: {
            _token: ENV.token
          },
          type: 'DELETE',
          success: function success(data) {
            Swal.fire({
              title: 'Thông báo',
              text: 'Xóa thành công',
              confirmButtonText: 'Ok',
              confirmButtonColor: '#7971ea'
            }).then(function () {
              window.location.reload();
            });
          }
        });
      } else {}
    });
  },
  updateStatus: function updateStatus(el, id, status) {
    $.ajax({
      url: $(el).attr('data-href'),
      data: {
        id: id,
        status: status,
        _token: ENV.token
      },
      headers: ENV.headerParams,
      dataType: 'JSON',
      type: 'POST',
      success: function success(data) {
        Swal.fire({
          title: 'Thông báo',
          text: 'Cập nhật thành công',
          confirmButtonText: 'Ok',
          confirmButtonColor: '#7971ea'
        }).then(function () {
          window.location.reload();
        });
      }
    });
  },
  mixMoney: function mixMoney(myfield) {
    var thousands_sep = '.',
        val = parseInt(myfield.value.replace(/[.*+?^${}()|[\]\\]/g, ''));
    myfield.value = shop.numberFormat(val, 0, '', thousands_sep);
  },
  showLoader: function showLoader() {
    // $("#loadMe").modal({
    //     backdrop: "static", //remove ability to close modal with click
    //     keyboard: false, //remove option to close with keyboard
    //     show: true //Display loader!
    // });
    NProgress.set(0.7);
  },
  hideLoader: function hideLoader() {
    NProgress.done(); // $("#loadMe").modal('hide');
  }
};
$.i18n().load({
  en: {
    success: 'Success',
    confirm_title: 'Are you sure?',
    confirm_text: 'This action can\'t be undo!',
    loading_title: 'Loading',
    loading_text: 'The system is processing your request',
    menu_delete: 'Delete menu "$1"?',
    // Define dùng chung để tận dụng các hàm giống nhau
    'delete': 'Do you want delete: $1?'
  },
  vi: {
    success: 'Thành công',
    confirm_title: 'Bạn chắc chứ?',
    confirm_text: 'Hành động không thể hoàn tác!',
    confirm_ok_text: 'Đồng ý',
    confirm_cancel_text: 'Hủy bỏ',
    loading_title: 'Đang tải',
    loading_with_icon: '<i class="fa fa-spinner fa-pulse fa-fw"></i> Đang tải',
    loading_text: 'Hệ thống đang xử lý yêu cầu của bạn',
    menu_delete: 'Xóa menu "$1"?',
    // Define dùng chung để tận dụng các hàm giống nhau
    'delete': 'Bạn muốn xóa: $1?',
    faq_confirm_delete: 'Bạn muốn xóa FAQ: $1?',
    // Comment
    comment_delete: 'Bạn muốn xóa đánh giá này?',
    // Comment Bad Word
    comment_badword_delete: 'Bạn muốn xóa từ cấm: $1?'
  }
});
$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      'Access-Control-Allow-Origin': '*',
      'X-Frame-Options': 'SAMEORIGIN'
    }
  });
});
$(document).ajaxStart(function () {
  NProgress.start();
}).ajaxStop(function () {
  NProgress.done();
});

function filterMenuSidebar() {
  var value = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
  $('.c-sidebar-nav li.c-sidebar-nav-item').filter(function () {
    if ($(this).hasClass('c-sidebar-nav-dropdown')) {
      if (!$(this).hasClass('c-show')) {
        $(this).addClass('c-show');
      }
    }

    var item = to_slug($(this).text());
    localStorage.setItem('filterMenuValue', value);
    $(this).toggle(item.indexOf(to_slug(value)) > -1);
  });
}

$(document).ready(function () {
  var currentLanguageApplication = $('html').attr('lang');

  if ($('.select2').length) {
    $('.select2').select2({// placeholder: '---Chọn---',
      // allowClear: true
    });
  }

  if ($('.datetimepicker').length) {
    $.datetimepicker.setLocale(currentLanguageApplication);
    $('.datetimepicker').datetimepicker({
      format: 'd/m/Y',
      timepicker: false
    });
  }

  if ($('#date_timepicker_start').length) {
    $('#date_timepicker_start').datetimepicker({
      format: 'd/m/Y',
      onShow: function onShow(ct) {
        this.setOptions({
          maxDate: jQuery('#date_timepicker_end').val() ? jQuery('#date_timepicker_end').val() : false
        });
      },
      timepicker: false
    });
    $('#date_timepicker_end').datetimepicker({
      format: 'd/m/Y',
      onShow: function onShow(ct) {
        this.setOptions({
          minDate: jQuery('#date_timepicker_start').val() ? jQuery('#date_timepicker_start').val() : false
        });
      },
      timepicker: false
    });
  }

  if ($('#date_timepicker_start_discount').length) {
    $('#date_timepicker_start_discount').datetimepicker({
      format: 'd/m/Y H:i',
      onShow: function onShow(ct) {
        this.setOptions({
          maxDate: jQuery('#date_timepicker_end_discount').val() ? jQuery('#date_timepicker_end_discount').val() : false
        });
      },
      timepicker: true
    });
    $('#date_timepicker_end_discount').datetimepicker({
      format: 'd/m/Y H:i',
      onShow: function onShow(ct) {
        this.setOptions({
          minDate: jQuery('#date_timepicker_start_discount').val() ? jQuery('#date_timepicker_start_discount').val() : false
        });
      },
      timepicker: true
    });
  }

  var swalConfig = {};
});
$(document).ready(function () {
  $('form').on('submit', function () {
    admin.showLoader();
    var btnSubmit = $(this).find('[type="submit"]');
    btnSubmit.attr('disabled', true).html('<i class="fa fa-spinner fa-pulse fa-fw"></i> ' + btnSubmit.text());
  });
});
Vue.component('my-notification', {
  template: '#notificationAreaTemplate',
  components: {},
  data: function data() {
    return {
      myNotifications: {
        data: {
          read: [],
          unread: [],
          total_unread: 0
        }
      },
      is_show: false
    };
  },
  mounted: function mounted() {
    this.getMyNotificationData();
  },
  created: function created() {
    window.addEventListener('click', this.hiddenNotificationCounter);
  },
  methods: {
    getMyNotificationData: function getMyNotificationData() {
      var _this = this;

      return _asyncToGenerator(function* () {
        var vm = _this;
        var myNotifications = yield $.get('/notifications/me');
        vm.$nextTick(function () {
          vm.myNotifications = myNotifications;
          vm.is_show = true;
        });
        myNotifications.data.unread.forEach(function (notification) {
          notification.is_show_action = 0;
        });
        myNotifications.data.read.forEach(function (notification) {
          notification.is_show_action = 0;
        });
      })();
    },
    markAllNotificationsAsRead: function markAllNotificationsAsRead() {
      this.myNotifications.data.unread.forEach(function (notificationItem) {
        notificationItem.read_at = Date.now();
      });
      $.post('/notifications/mark-read-all').then(function (response) {
        console.log(response);
      });
    },
    stopCloseDropdown: function stopCloseDropdown() {},
    hiddenNotificationCounter: function hiddenNotificationCounter(e) {
      this.is_show = false;
    },
    markNotificationAsRead: function markNotificationAsRead(notification) {
      console.log(notification);
    },
    showAction: function showAction(notification) {
      notification.is_show_action = true;
    },
    closeOtherAction: function closeOtherAction(notification) {
      this.myNotifications.data.unread.forEach(function (notificationItem) {
        if (notification.id != notificationItem.id) {
          notificationItem.is_show_action = false;
        }
      });
      this.myNotifications.data.read.forEach(function (notificationItem) {
        if (notification.id != notificationItem.id) {
          notificationItem.is_show_action = false;
        }
      });
    },
    deleteNotification: function deleteNotification(notification) {
      var notificationPosition = this.myNotifications.data.read.indexOf(notification);

      if (notificationPosition > -1) {
        return this.myNotifications.data.read.splice(notificationPosition, 1);
      } else {
        notificationPosition = this.myNotifications.data.unread.indexOf(notification);
        return this.myNotifications.data.unread.splice(notificationPosition, 1);
      }
    }
  }
});
Vue.component('notification-item', {
  template: '#notificationItemTemplate',
  props: ['notification'],
  methods: {
    markAsRead: function markAsRead(notification) {
      return _asyncToGenerator(function* () {
        var notificationItem = yield $.post('/notifications/mark-read', {
          id: notification.id
        });

        if (notificationItem.success) {
          notification.read_at = Date.now();
        }
      })();
    },
    toggleShowAction: function toggleShowAction(notification) {
      notification.is_show_action = !notification.is_show_action;
      this.$emit('closeOtherAction', notification);
    },
    markAsUnread: function markAsUnread(notification) {
      return _asyncToGenerator(function* () {
        var notificationItem = yield $.post('/notifications/mark-unread', {
          id: notification.id
        });

        if (notificationItem.success) {
          notification.read_at = null;
        }
      })();
    },
    deleteNotification: function deleteNotification(notification) {
      var _this2 = this;

      return _asyncToGenerator(function* () {
        Swal.fire({
          title: "Action can not be undo!",
          text: "Delete this notification?",
          icon: 'warning',
          showCancelButton: true
        }).then(function (choice) {
          return _this2.excecuteDeleteNotification(choice, notification);
        });
      })();
    },
    excecuteDeleteNotification: function excecuteDeleteNotification(choice, notification) {
      var _this3 = this;

      return _asyncToGenerator(function* () {
        if (choice.isConfirmed) {
          var deleteNotificationResult = yield $.post('/notifications/' + notification.id, {
            _method: 'DELETE'
          });

          if (deleteNotificationResult.success) {
            _this3.$emit('deleteNotification', notification);
          }
        }
      })();
    }
  }
});
new Vue({
  el: '#app-notification',
  delimiters: ['[[', ']]']
});
'use strict';

var chartInstance = null;
var dashboard = {
  chartInstance: null,
  chartLabels: [],
  chartData: [],
  chartConfig: function chartConfig() {
    return {
      type: 'line',
      data: {
        labels: this.chartLabels,
        datasets: [{
          label: 'Số lượng công trình',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: this.chartData
        }]
      },
      options: {
        plugins: {
          legend: {
            display: false
          }
        }
      }
    };
  },
  generateChart: function generateChart() {
    if ($('#myChart').length) {
      this.chartInstance = new Chart(document.getElementById('myChart'), this.chartConfig());
    }
  },
  getConstructionsStatisticByRangeDate: function getConstructionsStatisticByRangeDate(element) {
    var rangeDate = element.value;
    console.log(rangeDate);
  },
  getStatisticByRangeDate: function getStatisticByRangeDate(numberOfDate) {
    var _this4 = this;

    return _asyncToGenerator(function* () {
      var currentDate = new Date();
      var dateStart = currentDate.setDate(currentDate.getDate() - numberOfDate);

      var rangesDates = _this4.getRangesDate(dateStart, new Date());

      if (_this4.chartInstance) {
        _this4.chartInstance.destroy();
      }

      _this4.chartLabels = [];
      _this4.chartData = [];
      var statistic = yield $.post(baseUrl + '/dashboards/statistics', {
        range_date: rangesDates
      });

      if (statistic.success) {
        var statisticData = Object.values(statistic.data);
        statisticData.forEach(function (statisticItem) {
          _this4.chartLabels.push(statisticItem.date);

          _this4.chartData.push(statisticItem.total_construction);
        });

        _this4.generateChart();
      }
    })();
  },
  formatDate: function formatDate(date) {
    var fullDate = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
    return fullDate;
  },
  getRangesDate: function getRangesDate(start, end) {
    for (var ranges = [], dt = new Date(start); dt.getTime() <= end.getTime(); dt.setDate(dt.getDate() + 1)) {
      ranges.push(this.formatDate(new Date(dt)));
    }

    return ranges;
  }
};
$(document).ready(function () {
  if ($('#myChart').length) {
    dashboard.getStatisticByRangeDate($('#range_date').val());
  }
});
'use strict';

var faq = {
  delete: function _delete(question, ele) {
    shop.confirmActionDelete($.i18n('faq_confirm_delete', question), function () {
      $(ele).attr('disabled', true).html($.i18n('loading_with_icon'));
      return $(ele).parent().submit();
    });
  }
};
'use strict';

var contacts = {
  delete: function _delete(ele) {
    return _asyncToGenerator(function* () {
      var contact = $(ele).siblings('.contact-info').val();
      contact = JSON.parse(contact);
      var confirmText = "\n            X\xF3a kh\xE1ch h\xE0ng: ".concat(contact.name, " <br>\n            <i class=\"fa fa-envelope-o w-15\" aria-hidden=\"true\"></i> ").concat(contact.email, " ?\n        ");
      shop.confirmActionDelete(confirmText, /*#__PURE__*/_asyncToGenerator(function* () {
        var deleteContactUrl = "".concat(baseUrl, "/lien-he/").concat(contact.id);
        var result = yield $.post(deleteContactUrl, {
          _method: 'DELETE'
        });

        if (result.success) {
          return Swal.fire({
            title: 'Thành công!',
            text: result.message,
            showCloseButton: true,
            icon: "success"
          }).then(function () {
            $(ele).parents('tr').remove();
          });
        }
      }));
    })();
  }
};
'use strict';

var log = {
  showLogDetail: function showLogDetail(element) {
    var apiLog = JSON.parse($(element).siblings('.api-log-item').val());
    var apiLogFormatData = JSON.stringify(apiLog, null, '\t');
    $('#modalApiLogDetail').modal('show');
    $('#modalApiLogDetail #modal-body-content').text("".concat(apiLogFormatData));
  }
};
'use strict';

var comment = {
  getCustomerByKeyword: function getCustomerByKeyword() {
    return _asyncToGenerator(function* () {
      if ($('#customer_id').length) {
        yield $('#customer_id').select2({
          minimumInputLength: 4,
          ajax: {
            url: '/customers/filter',
            dataType: 'json',
            type: "GET",
            data: function data(query) {
              console.log(query);
              return {
                search: query.term
              };
            },
            processResults: function processResults(data) {
              console.log(data);
              return {
                results: $.map(data.data, function (item) {
                  return {
                    id: item.id,
                    text: item.fullname
                  };
                })
              };
            }
          },
          allowClear: true,
          placeholder: 'Nhập thông tin tìm kiếm'
        });
      }
    })();
  },
  getConstructionByKeyword: function getConstructionByKeyword() {
    return _asyncToGenerator(function* () {
      if ($('#construction_id').length) {
        yield $('#construction_id').select2({
          minimumInputLength: 4,
          ajax: {
            url: '/constructions/filter',
            dataType: 'json',
            type: "GET",
            data: function data(query) {
              console.log(query);
              return {
                search: query.term
              };
            },
            processResults: function processResults(data) {
              return {
                results: $.map(data.data, function (item) {
                  return {
                    id: item.id,
                    text: item.name
                  };
                })
              };
            }
          },
          allowClear: true,
          placeholder: 'Nhập thông tin tìm kiếm'
        });
      }
    })();
  },
  delete: function _delete(ele) {
    shop.confirmActionDelete($.i18n('comment_delete'), function () {
      $(ele).attr('disabled', true).html($.i18n('loading_with_icon'));
      return $(ele).parent('form').submit();
    });
  },
  showFullContent: function showFullContent(element) {
    var commentContent = $(element).siblings('.comment-full-content').val();
    $(element).parent().html(JSON.parse(commentContent));
  }
};
$(document).ready(function () {
  comment.getCustomerByKeyword();
  comment.getConstructionByKeyword();
});
'use strict';

var comment_bad_word = {
  delete: function _delete(badWord, ele) {
    shop.confirmActionDelete($.i18n('comment_badword_delete', badWord), function () {
      $(ele).attr('disabled', true).html($.i18n('loading_with_icon'));
      return $(ele).parent().submit();
    });
  },
  generateLanguageFile: function generateLanguageFile(element) {
    return _asyncToGenerator(function* () {
      shop.addLoader(element);
      var generateResult = yield $.post('bad-word/generate');
      shop.removeLoader(element, $(element).text());

      if (generateResult.success) {
        Swal.fire({
          title: 'Thông báo',
          text: $.i18n(generateResult.message),
          showCloseButton: true,
          icon: "info"
        });
      }
    })();
  }
}; // End class

'use strict';

var construction = {
  offset: 0,
  loadMoreComment: function loadMoreComment(constructionId) {
    var _arguments = arguments,
        _this5 = this;

    return _asyncToGenerator(function* () {
      var offset = _arguments.length > 1 && _arguments[1] !== undefined ? _arguments[1] : 10;
      var url = "".concat(baseUrl, "/constructions/").concat(constructionId, "/comments");
      _this5.offset = _this5.offset + offset;
      var comments = yield $.get(url, {
        offset: _this5.offset
      });

      if (comments.data.length > 0) {
        return $('#comment-area').append(comments.data);
      }

      return Swal.fire({
        title: 'Thông báo',
        text: 'Đã tải hết toàn bộ đánh giá',
        showCloseButton: true,
        icon: "info"
      }).then(function () {
        $('#load-more-comment-action').hide();
      });
    })();
  }
};
