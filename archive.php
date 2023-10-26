<?php

$query = new WP_Query([
 'post_type'      => 'post',
 'posts_per_page' => 5,
]);

if ($query->have_posts()) {
 while ($query->have_posts()): $query->the_post();
  $context['posts'] = [
   'title'     => get_the_title(),
   'link'      => get_the_permalink(),
   'thumbnail' => get_the_post_thumbnail_url(),
   'content'   => get_the_excerpt(),
   'date'      => get_the_date('j F Y'),
  ];
 endwhile;
}

echo $twig->render('archive.twig', $context);
