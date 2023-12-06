<?php

/**
 * @file
 * Contains List of all varbase_auth helpers.
 *
 * Add custom needed helper functions.
 */

/**
 * Populates TWIG variables with varbase related data.
 *
 * E.g.: $variables['varbase']['test'] becomes
 * {{ VARBASE_AUTH.test }} in the templates.
 *
 * @param array &$variables
 *   The core $variables passed by reference.
 * @param array $data
 *   New data in array format, which will be passed to the template.
 *
 * @return bool|array
 *   The new data.
 *
 * @internal
 */
function varbase_auth__add_template_variable(array &$variables, array $data = NULL) {
  static $key = 'varbase';

  if (!isset($variables[$key])) {
    $variables[$key] = $data;
  }
  else {
    $variables[$key][] = $data;
  }
  return $data;
}
