<?php

use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Location;

add_action('acf/init', function() {
    register_extended_field_group([
        'title'  => 'Imagem destacada',
        'fields' => [
            Image::make('', 'imagem_destacada'),
        ],
        'location' => [
            Location::if('post_type', 'post'),
        ],
        'style'      => 'default',
        'menu_order' => 10,
        'position'   => 'side',
    ]);
});
