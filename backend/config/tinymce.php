<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 24/12/23
 * Time: 15:28
 */
use backend\models\Pages;
return [
    'plugins' => [
        'anchor', 'charmap', 'code', 'help', 'hr',
        'image', 'link', 'lists', 'media', 'paste',
        'searchreplace', 'table',
    ],
    'height' => 500,
    'convert_urls' => false,
    'element_format' => 'html',
    //'image_caption' => true,
    'keep_styles' => false,
    'paste_block_drop' => true,
    'table_default_attributes' => new yii\web\JsExpression('{}'),
    'table_default_styles' => new yii\web\JsExpression('{}'),
    'table_header_type' => 'sectionCells',
    'invalid_elements' => 'acronym,font,center,nobr,strike,noembed,script,noscript',
    'extended_valid_elements' => 'strong/b,i[class], nav[id|class], table[style],table[class]',
    // elFinder file manager https://github.com/alexantr/yii2-elfinder
    'file_picker_callback' => alexantr\elfinder\TinyMCE::getFilePickerCallback(['elfinder/tinymce']),
    //'newline_behavior' => 'linebreak',
    //'forced_root_block' => "",
    'link_list' => Pages::getPagesForList(),
];