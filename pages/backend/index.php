<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel - International Kennel Union</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/style/jquery-ui.css" rel="stylesheet" type="text/css">               
        <link href="/style/bootstrap.css" rel="stylesheet" type="text/css">               
        <link href="/style/bootstrap-theme.css" rel="stylesheet" type="text/css">               
        <link href="/style/admin.css" rel="stylesheet" type="text/css">             
        <link href="/style/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css">
        <link href="/style/jquery-ui.css" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="/script/jquery-1.7.1.js"></script>        
        <script type="text/javascript" src="/script/jquery-ui.js"></script>        

        <script src="/script/tinymce/tinymce.js"></script>
        <script type="text/javascript" src="/script/jquery.lightbox-0.5.js"></script>
        <script type="text/javascript" src="/script/bootstrap.js"></script>
        <script type="text/javascript" src="/script/admin.js">
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

    });</script>
    </head>
    <body>
        <?php include 'top_menu.php'; ?>
        <div class="container">
            <?php include $parametrs["page"]; ?>
        </div>
    </body>
</html>
