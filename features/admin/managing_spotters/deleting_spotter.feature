@managing_spotters
Feature: Deleting a spotter
    In order to remove test, obsolete or incorrect spotters
    As an Administrator
    I want to be able to delete a spotter

    Background:
        Given there is a spotter "user" with an email "user@example.com" and a password "resu"
        And I am logged in as an administrator

    @todo
    Scenario: Deleting the spotter
        When I delete the spotter "user"
        Then I should be notified that it has been successfully deleted
        And the spotter "user" should no longer exist in the registry
