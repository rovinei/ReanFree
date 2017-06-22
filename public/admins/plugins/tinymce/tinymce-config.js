jQuery(function($){
    tinymce.init({
        selector: "textarea",theme: "modern", width: "99.5%",height: 300,
        external_filemanager_path:"/admins/filemanager/",
        filemanager_title:"Responsive Filemanager" ,
        external_plugins: { "filemanager" : "/admins/filemanager/plugin.min.js"},
        plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker jbimages"
        ],

        toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
        file_browser_callback : function(field_name, url, type, win) {
            var w = window,
            d = document,
            e = d.documentElement,
            g = d.getElementsByTagName('body')[0],
            x = w.innerWidth || e.clientWidth || g.clientWidth,
            y = w.innerHeight|| e.clientHeight|| g.clientHeight;

            var cmsURL = $('meta[name="domain"]').attr('content')+"/admins/filemanager/show?&field_name="+field_name+"&lang="+tinymce.settings.language;

            if(type == "image") {
                cmsURL = cmsURL + "&type=images";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : "Filemanager",
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });

        },
        menubar: false,
        toolbar_items_size: "small",

        // Image Path Convert URL
        relative_urls: false,
        remove_script_host: false,

        document_base_url: $('meta[name="domain"]').attr('content'),
        font_formats: "Hanuman='Hanuman', serif;"+
            "Siem Reap (KH)='Siemreap', cursive;"+
            "Fast Hand (KH)='Fasthand', serif;"+
            "Taprom (KH)='Taprom', cursive;"+
            "Metal (KH)='Metal', cursive;"+
            "Free Hand (KH)='Freehand', cursive;"+
            "Open sans='Open Sans', sans-serif;"+
            "Open Sans Condensed='Open Sans Condensed', sans-serif;"+
            "Arial=arial,helvetica,sans-serif;"+
            "Arial Black=arial black,avant garde;"+
            "Book Antiqua=book antiqua,palatino;"+
            "Comic Sans MS=comic sans ms,sans-serif;"+
            "Courier New=courier new,courier;"+
            "Georgia=georgia,palatino;"+
            "Helvetica=helvetica;"+
            "Impact=impact,chicago;"+
            "Symbol=symbol;"+
            "Tahoma=tahoma,arial,helvetica,sans-serif;"+
            "Terminal=terminal,monaco;"+
            "Times New Roman=times new roman,times;"+
            "Trebuchet MS=trebuchet ms,geneva;"+
            "Verdana=verdana,geneva;"+
            "Webdings=webdings;"+
            "Wingdings=wingdings,zapf dingbats"
    });
});
