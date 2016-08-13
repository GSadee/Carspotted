@managing_spots
Feature: Editing a spot
    In order to change spot configuration
    As an Administrator
    I want to be able to edit an existing spot

    Background:
        Given there is a spotter "user" with an email "user@example.com" and a password "resu"
        And there is a model "RS7" made by "Audi"
        And there is also a model "RS6" made by "Audi"
        And this user spotted a model "RS7" made by "Audi"
        And I am logged in as an administrator

    @todo
    Scenario: Changing the spot model
        When I want to modify this spot
        And I change a model to "RS6"
        And I save my changes
        Then I should be notified that it has been successfully edited
        And this spot model should be "RS6"

    @todo
    Scenario: Enabling the spot
        When I want to modify this spot
        And I enable it
        And I save my changes
        Then I should be notified that it has been successfully edited
        And this spot should be enabled
