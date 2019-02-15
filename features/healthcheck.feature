# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html
# @see https://blog.rafalmuszynski.pl/how-to-configure-behat-with-symfony-4/


Feature:
  Hypervision should be able to test that the microservice is up and running

  Scenario: Probe Healthcheck
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/api/_internal/healthcheck"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON nodes should contain:
      | status | healthy |
