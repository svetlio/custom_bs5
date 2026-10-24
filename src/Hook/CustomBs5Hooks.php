<?php

namespace Drupal\custom_bs5\Hook;

use Drupal\comment\CommentInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\StringTranslation\StringTranslationTrait;

class CustomBs5Hooks {

  use StringTranslationTrait;

  #[Hook('theme_alter')]
  public function themeAlter(array &$variables) {
    //
  }

  #[Hook('theme_suggestions_alter')]
  public function themeSuggestionsAlter(array &$suggestions, array &$variables, $hook) {
    //
  }

  #[Hook('preprocess_comment')]
  public function preprocessComment(array &$variables) {
    //
  }

  #[Hook('preprocess_links')]
  public function preprocessLinks(array &$variables) {
    // Make comment links small buttons.
    if ($variables['theme_hook_original'] == 'links__comment') {
      foreach ($variables['links'] as $k => $link) {
        $variables['links'][$k]['link']['#url']->setOption('attributes', ['class' => ['btn', 'btn-sm', 'btn-outline-secondary']]);
      }
    }
  }

  #[Hook('comment_links_alter')]
  public function commentLinksAlter(array &$links, CommentInterface $comment) {
    //
  }

  #[Hook('link_alter')]
  public function linkAlter(array &$variables) {
    //
  }
}
