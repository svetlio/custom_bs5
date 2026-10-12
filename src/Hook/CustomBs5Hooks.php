<?php

namespace Drupal\custom_bs5\Hook;

use Drupal\comment\CommentInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\StringTranslation\StringTranslationTrait;

class CustomBs5Hooks {

  use StringTranslationTrait;

  #[Hook('comment_links_alter')]
  public function commentLinksAlter(array &$links, CommentInterface $comment) {
    //$links['edit']['title'] = $this->t('EDIT');
  }

  #[Hook('link_alter')]
  public function linkAlter(array &$variables) {
    //dpm($variables);
  }
}
