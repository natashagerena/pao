<?php

use Timber\Timber;

$data         = Timber::get_context();
$data['post'] = Timber::get_post();
$data['home'] = Timber::get_post(2);

Timber::render('front-page.twig', $data);
