<?php

namespace Drupal\custom_bs5\Hook;

use Drupal\comment\CommentInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Hooks.
 */
class CustomBs5Hooks {

  use StringTranslationTrait;

  /**
   * Implements hook_theme_alter().)
   */
  #[Hook('theme_alter')]
  public function themeAlter(array &$variables) {
  }

  /**
   * Implements hook_theme_suggestions_alter().)
   */
  #[Hook('theme_suggestions_alter')]
  public function themeSuggestionsAlter(array &$suggestions, array &$variables, $hook) {
  }

  /**
   * Implements hook_preprocess_comment().)
   */
  #[Hook('preprocess_comment')]
  public function preprocessComment(array &$variables) {
  }

  /**
   * Implements hook_preprocess_links().)
   */
  #[Hook('preprocess_links')]
  public function preprocessLinks(array &$variables) {
    // Make comment links small buttons.
    if ($variables['theme_hook_original'] == 'links__comment') {
      foreach ($variables['links'] as $k => $link) {
        $variables['links'][$k]['link']['#url']->setOption('attributes', [
          'class' => ['btn', 'btn-sm', 'btn-outline-secondary'],
        ]);
      }
    }
  }

  /**
   * Implements hook_comment_links_alter().)
   */
  #[Hook('comment_links_alter')]
  public function commentLinksAlter(array &$links, CommentInterface $comment) {
  }

  /**
   * Implements hook_link_alter().)
   */
  #[Hook('link_alter')]
  public function linkAlter(array &$variables) {
  }

}
