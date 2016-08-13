@managing_spots
Feature: Deleting a spot
    In order to remove test, obsolete or incorrect spots
    As an Administrator
    I want to be able to delete a spot

    Background:
        Given there is a spotter "user" with an email "user@example.com" and a password "resu"
        And there is a model "RS7" made by "Audi"
        And this user spotted a model "RS7" made by "Audi"
        And I am logged in as an administrator

    @todo
    Scenario: Deleting the spot
        When I delete this spot
        Then I should be notified that it has been successfully deleted
