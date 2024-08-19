<?php

use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Location;

add_action('acf/init', function() {
    register_extended_field_group([
        'title'  => 'Conteúdo',
        'fields' => [
            Text::make('Subtítulo', 'subtitulo'),
            Textarea::make('Texto', 'texto'),
        ],
        'location' => [
            Location::if('page', 15)
        ],
        'style'      => 'default',
        'menu_order' => 10,
        'key'        => basename(__FILE__, '.php'),
    ]);
});
