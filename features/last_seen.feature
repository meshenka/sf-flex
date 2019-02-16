# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html
# @see https://blog.rafalmuszynski.pl/how-to-configure-behat-with-symfony-4/


Feature:
  Microservice allow to verify if a user is onlune

  Scenario: Check for a known user
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/api/users/10@fixture.loc"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON nodes should contain:
      | userId | 10@fixture.loc |
    And the JSON node "online" should exist
    And the JSON node "lastSeen" should exist
    And the JSON node "knowned" should be true

  Scenario: Check for an unknown user
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/api/users/phpspec"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON nodes should contain:
      | userId | phpspec |
    And the JSON node "online" should be false
    And the JSON node "lastSeen" should be null
    And the JSON node "knowned" should be false
    