jQuery(document).ready( function($){
    
    document.getElementById("customCss").style.visibility = "visible";

    var updateCSS = function(){
        $("#motsach_css").val( editor.getSession().getValue() );
    }

    $("#save-custom-css-form").submit( updateCSS );

    var editor = ace.edit('customCss');
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/css");

});

var editor = ace.edit('customCss');
editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/css");