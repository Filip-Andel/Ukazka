<script src="https://cdn.tiny.cloud/1/ayqu27s0z85wck4is65ekpqjcopw2j6dv97euuaxvrhai9ev/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
     tinymce.init({
      selector: 'textarea',
      plugins: ' lists link autoresize fullscreen insertdatetime advlist image emoticons autolink lists media table ',
      toolbar: ' undo redo | customInsertButton | h1 h2 h3 h4 | bold italic| underline strikethrough | forecolor backcolor | fontselect | fontsizeselect | alignleft aligncenter alignright alignjustify | numlist bullist | fullscreen |',
      toolbar_mode: 'floating',
      menubar: "",
      fontsize_formats: '8pt 10pt 12pt 13pt 14pt 15pt 18pt 24pt 30pt 36pt',
      forced_root_block : 'div',
      spellchecker_language: "off",
      min_height: 300,
      force_br_newlines : true,
      force_p_newlines : false,

      setup: function (editor) {
        editor.ui.registry.addButton('customInsertButton', {
          text: 'L',
          onAction: function (_) {
            tinymce.activeEditor.formatter.apply('customformat');
            tinyMCE.activeEditor.focus();
          }
        });
      },
      formats: {
        customformat: { block: 'h1', styles: { color: 'blue'}, }
      },
    });
</script>

<style>
.tox-statusbar {
    display:none !important;
}
</style>

<?php 

// tinymce.init({
//  selector: 'textarea',
//  plugins: ' lists link autoresize fullscreen insertdatetime advlist image emoticons autolink lists media table ',
//  toolbar: ' undo redo | h1 h2 h3 h4 | bold italic underline | alignleft aligncenter alignright alignjustify | outdent indent | fontselect | fontsizeselect | forecolor backcolor | numlist bullist | fullscreen |',
//  toolbar_mode: 'floating',
//  menubar: "",
//  fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 30pt 36pt',
//  spellchecker_language: "off",
//  forced_root_block : 'div',
// });

?>