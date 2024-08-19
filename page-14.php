<?php

use Timber\Timber;

$data                       = Timber::get_context();
$data['post']               = Timber::get_post();
$data['post']->post_content = wpautop($data['post']->post_content);
$data['home']               = Timber::get_post(2);

Timber::render('page-cafe.twig', $data);
