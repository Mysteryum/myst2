$(document).ready(function(){
    $("a.lbox").lightBox();
    $( "#tabs" ).tabs();
    $(".date-picer").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:2020'
    });
    tinymce.init({		
		
        language : 'ru',        
        selector: ".check_editor",
        theme: "modern",
		convert_urls: false,
        plugins: [
			"responsivefilemanager",
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],		
        content_css: "/css/style.css",
        theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
        font_size_style_values: "12px,13px,14px,16px,18px,20px",
        toolbar: "responsivefilemanager | sizeselect | bold italic | fontselect |  fontsizeselect | insertfile undo redo | styleselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",                
		
		
		external_filemanager_path:"/script/filemanager/",
		filemanager_title:"Responsive Filemanager" ,
		external_plugins: { "filemanager" : "/script/filemanager/plugin.js"}

    });
})