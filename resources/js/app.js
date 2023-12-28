import './bootstrap';

// WYSIWYG tinymce
import 'tinymce/tinymce';
import 'tinymce/skins/ui/oxide/skin.min.css';
import 'tinymce/skins/content/default/content.min.css';
import 'tinymce/skins/content/default/content.css';
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';

// .. After imports init TinyMCE ..
window.addEventListener('DOMContentLoaded', () => {
    tinymce.init({
        selector: 'textarea.wysiwyg',

        /* TinyMCE configuration options */
        skin: false,
        content_css: false,
        plugins: 'image',
        toolbar: 'image',
        images_file_types: 'jpg,jpeg,svg,webp'
    });
});
