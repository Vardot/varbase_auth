@varbase_auth @admin
Feature: Varbase Auth - Social Auth settings
  As a site administrator
  I want the Social Auth settings page to be reachable so I can configure the
  social sign-on providers

  Background:
    Given I am a logged in user with the "Webmaster" user

  Scenario: The Social Auth settings page is reachable
    When I am on "/admin/config/social-api/social-auth"
    Then I should see "Social Auth"
    And I should not see "Page not found"
    And I should not see "The website encountered an unexpected error"
