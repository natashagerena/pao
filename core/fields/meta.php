<?php

use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Location;

add_action('acf/init', function() {
    register_extended_field_group([
        'title'  => 'Meta tags',
        'fields' => [
            Text::make('Título', 'meta_title')->characterLimit(60),
            Textarea::make('Descrição', 'meta_description')->characterLimit(160)->rows(5),
            Image::make('Imagem compartilhamento', 'meta_image')->returnFormat('url')->previewSize('thumbnail'),

        ],
        'location' => [
            Location::if('post_type', 'page'),
            Location::if('post_type', 'post'),
        ],
        'style'      => 'default',
        'position'   => 'side',
        'menu_order' => 20,
    ]);
});
