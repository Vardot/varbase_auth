<?php

/**
 * @file
 * Contains varbase_auth_update_9###(s) hook updates.
 */

/**
 * Issue #3266209: Remove the left over after installation.
 *
 * Of additional modules for Social Auth and fullback to the
 * Social Auth and its extra modules.
 * To manage the installation and change of configs.
 */
function varbase_auth_update_90001() {
  \Drupal::configFactory()->getEditable('simple.settings')->delete();
}
