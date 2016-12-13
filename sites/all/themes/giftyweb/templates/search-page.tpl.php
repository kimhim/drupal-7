<article>
  <?php if ($teaser) : // for nodes we can use the teaser as search result ?>
    <?php print drupal_render($teaser); ?>
  <?php else : // for other results we use the default from core search module ?>
    <?php print render($title_prefix); ?>
    <h3><a href="<?php print $url; ?>"><?php print $title; ?></a></h3>
    <?php print render($title_suffix); ?>
    <?php if ($snippet) : ?>
      <p><?php print $snippet; ?></p>
    <?php endif; ?>
  <?php endif; ?>
  <?php //if ($info): ?>
    <footer><?php //print $info; ?></footer>
  <?php //endif; ?>
</article>