@varbase_auth @admin
Feature: Varbase Auth - Social Auth integrations
  As a site administrator
  I want the Social API user authentication page to list the configured social
  sign-on providers

  Background:
    Given I am a logged in user with the "Webmaster" user

  Scenario: The user authentication integrations page lists the providers
    When I am on "/admin/config/social-api/social-auth"
    Then I should see "User authentication"
    And I should see "Google"
    And I should see "Facebook"
    And I should see "LinkedIn"
    And I should not see "Page not found"
    And I should not see "The website encountered an unexpected error"
