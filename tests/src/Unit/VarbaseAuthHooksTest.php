<?php

namespace Drupal\Tests\varbase_auth\Unit;

use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Tests\UnitTestCase;
use Drupal\varbase_auth\Hook\VarbaseAuthHooks;

/**
 * Unit tests for the Varbase Auth object-oriented hooks.
 *
 * Functional and browser coverage lives in the varbase-e2e suite
 * (tests/features/drupal). These PHP tests only exercise unit-testable logic.
 *
 * @coversDefaultClass \Drupal\varbase_auth\Hook\VarbaseAuthHooks
 * @group varbase_auth
 */
class VarbaseAuthHooksTest extends UnitTestCase {

  /**
   * Builds the hook service with mocked dependencies.
   *
   * @param string $route_name
   *   The route name the mocked route match returns.
   *
   * @return \Drupal\varbase_auth\Hook\VarbaseAuthHooks
   *   The hook service under test.
   */
  protected function buildHooks(string $route_name): VarbaseAuthHooks {
    $route_match = $this->createMock(RouteMatchInterface::class);
    $route_match->method('getRouteName')->willReturn($route_name);
    $module_handler = $this->createMock(ModuleHandlerInterface::class);
    $module_handler->method('getModuleList')->willReturn([]);
    return new VarbaseAuthHooks($route_match, $module_handler);
  }

  /**
   * The first call seeds the template key with the given data.
   *
   * @covers ::addTemplateVariable
   */
  public function testAddTemplateVariableSeedsTheTemplateKey(): void {
    $hooks = $this->buildHooks('user.login');
    $variables = [];
    $hooks->addTemplateVariable($variables, ['flag' => TRUE]);
    $this->assertSame(['flag' => TRUE], $variables['varbase']);
  }

  /**
   * Nothing is added on routes other than user.login / user.register.
   *
   * @covers ::preprocessPage
   */
  public function testPreprocessPageIgnoresOtherRoutes(): void {
    $hooks = $this->buildHooks('entity.node.canonical');
    $variables = [];
    $hooks->preprocessPage($variables);
    $this->assertArrayNotHasKey('varbase', $variables);
  }

  /**
   * The login route adds the social-auth flag (FALSE with no modules).
   *
   * @covers ::preprocessPage
   */
  public function testPreprocessPageAddsFlagOnLoginRoute(): void {
    $hooks = $this->buildHooks('user.login');
    $variables = [];
    $hooks->preprocessPage($variables);
    $this->assertArrayHasKey('varbase', $variables);
    $this->assertFalse($variables['varbase']['we_do_have_enabled_social_auth_modules']['value']);
  }

}
