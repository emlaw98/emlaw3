shop.ready.add(function(){
    // console.log('admin.js start');
    $('.datepicker').datetimepicker({ format:'d/m/Y', timepicker:false});

    admin.activeLog();
}, true);

var admin = {
    activeLog: function() {
        setTimeout(function () {
            shop.ajax_popup('/users/active-log', 'GET')
        }, 1000);
    },
    system:{
        ckEditor: function (ele,width,height,theme,toolbar, css,id_img_btn) {
            css = css ? css : (ENV.BASE_URL + 'css/style_editor.css?v=1');
            if(Array.isArray(ele)){
                for(var i = 0; i< ele.length; i++) {
                    CKEDITOR.replace(ele[i],
                        {
                            toolbar: toolbar,
                            width: width,
                            height: height,
                            language: 'vi',
                            contentsCss: css,
                            allowedContent:true
                        });
                }
            }else {
                var instance_ck = CKEDITOR.replace(ele ,
                    {
                        toolbar : toolbar,
                        width: width,
                        height: height,
                        language : 'vi',
                        contentsCss: css,
                        allowedContent:true,
                        extraPlugins:'embed',
                    });
                instance_ck.addCommand("mySimpleCommand", {
                    exec: function(edt) {
                        var abc = $('#uploadifive-'+id_img_btn+' input');
                        if(typeof abc != 'undefined') {
                            $(abc[abc.length - 1]).click();
                        }
                    }
                });
                instance_ck.ui.addButton('ImgUploadBtn', {
                    type: 'button',
                    label: "Upload ảnh lên chèn vào nội dung",
                    command: 'mySimpleCommand',
                    // toolbar: 'insert',
                    icon: 'plugins/iconfinder_image_272698.png',
                });
            }
        },
        tinyMCE: function(selector,plugins = '' ,menubar = '', toolbar = '',height = 600,width = 'auto') {
            tinymce.init({
                selector: selector,
                plugins: !plugins ? 'bootstrap3grid save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons' : plugins,
                imagetools_cors_hosts: ['picsum.photos'],
                menubar: !menubar ? 'file edit view insert format tools table help' : menubar,
                toolbar: !toolbar ? 'bootstrap3grid | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | emoticons | fullscreen  preview save image | insertfile print charmap media template link anchor codesample | ltr rtl' : toolbar,
                grid_preset: 'Bootstrap3',
                fontsize_formats: "8px 9px 10px 11px 12px 14px 18px 24px 30px 36px",
                toolbar_sticky: false,
                autosave_ask_before_unload: true,
                autosave_interval: "30s",
                autosave_prefix: "{path}{query}-{id}-",
                autosave_restore_when_empty: false,
                autosave_retention: "2m",
                image_advtab: true,
                content_css: [
                    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
                    '//www.tiny.cloud/css/codepen.min.css'
                ],
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
                templates: [
                    { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
                ],
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                height: height,
                width: width,
                image_caption: true,
                relative_urls : false,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                noneditable_noneditable_class: "mceNonEditable",
                toolbar_mode: 'sliding',
                contextmenu: "link image imagetools table",
                file_picker_callback: function(callback, value, meta) {
                    // let field = win.document.getElementById(field_name)

                    var windowName = 'Media Window';
                    // newwindow = window.open(url_call,windowName,'height=630,width=1200');

                    // var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
                    // var eventer = window[eventMethod];
                    // var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

                    let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                    let type = 'image' === meta.filetype ? 'Images' : 'Files',
                        url  = '/file/laravel-filemanager?editor=tinymce5&type=' + type;

                    tinymce.activeEditor.windowManager.openUrl({
                        url : url,
                        title : windowName,
                        width : x * 0.8,
                        height : y * 0.8,
                        onMessage: (api, message) => {
                            callback(message.content);
                        }
                    });

                    // Listen to message from child window
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
                },

                // (optional) close the manager when pressing "OK"
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
    tags:{
        init_more:function (container){
            $(container).tagEditor({
                initialTags: $(container).val().split(','),
                sortable: false,
                forceLowercase: false,
                placeholder: '',
                onChange: function (field, editor, tags) {
                    $(field).val(tags.length ? tags.join(',') : '');
                }

            });
        },
        init: function(type, container, id, suggest, no_load_more){
            if(suggest || no_load_more) {
                $(container).tagEditor({
                    initialTags: $(container).val().split(','),
                    autocomplete: {
                        delay: 0, // show suggestions immediately
                        position: {collision: 'flip'}, // automatic menu position up/down
                        source: suggest ? suggest : []
                    },
                    sortable: false,
                    forceLowercase: false,
                    placeholder: '',
                    onChange: function (field, editor, tags) {
                        $(field).val(tags.length ? tags.join(',') : '');
                    },
                    beforeTagSave: function (field, editor, tags, tag, val) {
                        shop.admin.tags.add(val, type);
                    },
                    beforeTagDelete: function (field, editor, tags, val) {
                        var q = confirm('Xóa tag "' + val + '"?');
                        if (q) {
                            shop.admin.tags.remove(val, type, id);
                        }
                        return q;
                    }
                });
            }else{
                shop.admin.tags.loadSuggest(type, container, id);
            }
        },
        loadSuggest: function(type, container, id){
            shop.ajax_popup('tag/tag-suggest', 'POST', {type: type}, function(json){
                if(json.error == 0) {
                    shop.admin.tags.init(type, container, id, json.data, true);
                }else{
                    alert(json.msg);
                }
            });
        },
        add: function(tag, type){
            shop.ajax_popup('tag/tag-add', 'POST', {tag: tag, type: type}, function(json){
                if(json.error != 0) {
                    alert(json.msg);
                }
            });
        },
        remove: function(tag, type, id){
            shop.ajax_popup('tag/tag-del', 'POST', {tag: tag, type: type, id: id}, function(json){
                if(json.error != 0) {
                    alert(json.msg);
                }
            });
        }
    },
    filters:{
        init_more:function (container){
            $(container).tagEditor({
                initialTags: $(container).val().split(','),
                sortable: false,
                forceLowercase: false,
                placeholder: '',
                onChange: function (field, editor, tags) {
                    $(field).val(tags.length ? tags.join(',') : '');
                }

            });
        },
        init: function(type, container, id, suggest, no_load_more,max_tag){
            if(suggest || no_load_more) {
                $(container).tagEditor({
                    initialTags: $(container).val().split(','),
                    autocomplete: {
                        delay: 0, // show suggestions immediately
                        position: {collision: 'flip'}, // automatic menu position up/down
                        source: suggest ? suggest : []
                    },
                    sortable: false,
                    forceLowercase: false,
                    placeholder: '',
                    maxTags: max_tag ? max_tag : null,
                    // onChange: function (field, editor, tags) {
                    //     $(field).val(tags.length ? tags.join(',') : '');
                    // },
                    beforeTagSave: function (field, editor, tags, tag, val) {
                        shop.admin.filters.add(val, type);
                    },
                    beforeTagDelete: function (field, editor, tags, val) {
                        var q = confirm('Xóa tag "' + val + '"?');
                        if (q) {
                            shop.admin.filters.remove(val, type, id);
                        }
                        return q;
                    }
                });
            }else{
                shop.admin.filters.loadSuggest(type, container, id,max_tag);
            }
        },
        loadSuggest: function(type, container, id,max_tag){
            shop.ajax_popup('filter/filter-suggest', 'POST', {type: type}, function(json){
                if(json.error == 0) {
                    shop.admin.filters.init(type, container, id, json.data, true,max_tag);
                }else{
                    alert(json.msg);
                }
            });
        },
        add: function(filter, type){
            shop.ajax_popup('filter/filter-add', 'POST', {filter: filter, type: type}, function(json){
                if(json.error != 0) {
                    alert(json.msg);
                }
            });
        },
        remove: function(filter, type, id){
            shop.ajax_popup('filter/filter-del', 'POST', {filter: filter, type: type, id: id}, function(json){
                if(json.error != 0) {
                    alert(json.msg);
                }
            });
        }
    },
    api:{
        showLog: function(id){
            shop.ajax_popup('apilog/view', 'POST', {id: id}, function(json){
                if(json.error != 0) {
                    alert(json.msg);
                }else{
                    //update title
                    var data = json.data,
                        html = shop.join
                        ('<div><b>Request URL:</b> '+data.url+'</div>')
                        ('<div class="mt-2"><b>Call time:</b> '+data.created+'</div>')
                        ('<div class="mt-2"><b>Status:</b> '+(data.error ? '<span class="text-danger">Error</span>' : '<span class="text-success">Success</span>')+'</div>')
                        ('<div class="mt-2"><b>Sign server:</b></div>')
                        ('<div class="mt-2" style="word-wrap: break-word;">'+data.apisign_server+'</div>')
                        ('<div class="mt-2"><b>Sign client:</b></div>')
                        ('<div class="mt-2" style="word-wrap: break-word;">'+data.apisign+'</div>')
                        ('<div class="mt-2"><b>Params:</b></div>')
                        ('<div class="mt-2" style="word-wrap: break-word;">'+data.params+'</div>')
                        ('<div class="mt-2"><b>Return:</b></div>')
                        ('<div class="mt-2" style="word-wrap: break-word;">'+(data.error ? data.error : data.return)+'</div>')
                        ();
                    $('#primaryModal .modal-body').html(html);
                    $('#primaryModal').modal();
                }
            });
        }
    },
    delete_this: function(el) {
        Swal.fire({
            title: 'Bạn đã chắc chắn?',
            text: "Không thể hoàn tác sau khi đồng ý!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý!'
        }).then((result) => {
            //console.log(result);
            if (result.isConfirmed) {
                // admin.showLoader();
                $.ajax({
                    url: $(el).attr('data-href'),
                    data: {_token:ENV.token},
                    type: 'DELETE',
                    success: function(data){
                        Swal.fire({
                            title: 'Thông báo',
                            text: 'Xóa thành công',
                            confirmButtonText: 'Ok',confirmButtonColor: '#7971ea',
                        }).then(function(){
                            window.location.reload();
                        });
                    }
                });
            }else {

            }
        })

    },
    updateStatus: function(el,id,status) {
        $.ajax({
            url: $(el).attr('data-href'),
            data: { id:id,status: status, _token: ENV.token },
            headers:ENV.headerParams,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Cập nhật thành công',
                    confirmButtonText: 'Ok',confirmButtonColor: '#7971ea',
                }).then(function(){
                    window.location.reload();
                });
            }
        });
    },
    mixMoney: function (myfield) {
        var thousands_sep = '.',
            val = parseInt(myfield.value.replace(/[.*+?^${}()|[\]\\]/g, ''));
        myfield.value = shop.numberFormat(val, 0, '', thousands_sep);
    },
    showLoader: function () {
        // $("#loadMe").modal({
        //     backdrop: "static", //remove ability to close modal with click
        //     keyboard: false, //remove option to close with keyboard
        //     show: true //Display loader!
        // });
        NProgress.set(0.7);
    },
    hideLoader: function () {
        NProgress.done();
        // $("#loadMe").modal('hide');
    }
};