@varbase_auth @login
Feature: Varbase Auth - login and registration pages
  As a visitor
  I want the login and registration pages to keep working and to expose the
  social single sign-on options with Varbase Social Single Sign-On enabled

  Scenario: The login page loads for an anonymous visitor
    Given I am an anonymous visitor
    When I am on "/user/login"
    Then "#user-login-form" should be visible
    And I should see "Log in"
    And I should not see "Page not found"
    And I should not see "The website encountered an unexpected error"

  Scenario: The registration page loads for an anonymous visitor
    Given I am an anonymous visitor
    When I am on "/user/register"
    Then "#user-register-form" should be visible
    And I should not see "Page not found"
    And I should not see "The website encountered an unexpected error"

  Scenario: The login page shows the social sign-in options
    Given I am an anonymous visitor
    When I am on "/user/login"
    Then I should see "Or sign in with"
    And "a[href$='/user/login/google']" should be visible
    And "a[href$='/user/login/facebook']" should be visible
    And "a[href$='/user/login/linkedin']" should be visible
