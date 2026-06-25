@varbase_auth @login
Feature: Varbase Auth - login and registration pages
  As a visitor
  I want the login and registration pages to keep working with Varbase Social
  Single Sign-On enabled

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
