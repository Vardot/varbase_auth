<?php

namespace Drupal\varbase_auth\Hook;

use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Object-oriented hook implementations for Varbase Social Single Sign-On.
 *
 * Drupal 11 replaces procedural hooks with methods that carry the #[Hook]
 * attribute (https://www.drupal.org/node/3442349). The real logic lives here
 * and uses dependency injection; the procedural functions in
 * varbase_auth.module and includes/helpers.inc are kept only as #[LegacyHook]
 * (and plain) shims that delegate to this service, for backwards compatibility.
 */
class VarbaseAuthHooks {

  /**
   * The template variable key populated for the page templates.
   */
  protected const TEMPLATE_KEY = 'varbase';

  /**
   * Constructs a VarbaseAuthHooks object.
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $routeMatch
   *   The current route match.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $moduleHandler
   *   The module handler.
   */
  public function __construct(
    protected RouteMatchInterface $routeMatch,
    protected ModuleHandlerInterface $moduleHandler,
  ) {}

  /**
   * Implements hook_preprocess_page().
   */
  #[Hook('preprocess_page')]
  public function preprocessPage(array &$variables): void {
    $current_route = (string) $this->routeMatch->getRouteName();

    if ($current_route === 'user.register' || $current_route === 'user.login') {
      // Get the list of enabled modules.
      $modules_list = $this->moduleHandler->getModuleList();

      // Check if at least one social auth module is enabled.
      $we_do_have_enabled_social_auth_modules = FALSE;
      foreach ($modules_list as $module_index => $module_value) {
        $module_index = (string) $module_index;
        if (substr_count($module_index, 'social_auth_') > 0) {
          $we_do_have_enabled_social_auth_modules = TRUE;
          break;
        }
      }

      // Add the variable to the template.
      $this->addTemplateVariable($variables, [
        'we_do_have_enabled_social_auth_modules' => [
          'type' => 'bool',
          'value' => $we_do_have_enabled_social_auth_modules,
        ],
      ]);
    }
  }

  /**
   * Populates TWIG variables with Varbase related data.
   *
   * E.g. $variables['varbase']['test'] becomes {{ VARBASE_AUTH.test }} in the
   * templates.
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
  public function addTemplateVariable(array &$variables, ?array $data = NULL): array|bool|null {
    if (!isset($variables[self::TEMPLATE_KEY])) {
      $variables[self::TEMPLATE_KEY] = $data;
    }
    else {
      $variables[self::TEMPLATE_KEY][] = $data;
    }
    return $data;
  }

}
