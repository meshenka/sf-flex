# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html
# @see https://blog.rafalmuszynski.pl/how-to-configure-behat-with-symfony-4/


Feature:
  Microservice allow update last seen data

  Scenario: Update a known user
    Given I send a "PUT" request to "/api/users/10@fixture.loc" with body:
    """
    {
        "date": "2019-02-12T16:11:46+01:00"
    }
    """
    Then the response status code should be 200

  Scenario: Update a known user
    Given I send a "PUT" request to "/api/users/update" with body:
    """
    {
        "date": "2019-02-12T16:11:46+01:00"
    }
    """
    Then the response status code should be 200
