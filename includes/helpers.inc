<?php

/**
 * @file
 * Contains List of all varbase_auth helpers.
 *
 * Add custom needed helper functions.
 */

use Drupal\varbase_auth\Hook\VarbaseAuthHooks;

/**
 * Populates TWIG variables with varbase related data.
 *
 * Legacy procedural wrapper kept for backwards compatibility. The logic lives
 * in \Drupal\varbase_auth\Hook\VarbaseAuthHooks::addTemplateVariable().
 *
 * @param array &$variables
 *   The core $variables passed by reference.
 * @param array|null $data
 *   New data in array format, which will be passed to the template.
 *
 * @return array|bool|null
 *   The new data.
 *
 * @internal
 */
function varbase_auth__add_template_variable(array &$variables, ?array $data = NULL) {
  return \Drupal::service(VarbaseAuthHooks::class)->addTemplateVariable($variables, $data);
}
