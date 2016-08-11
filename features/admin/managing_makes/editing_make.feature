@managing_makes
Feature: Editing a make
    In order to change make configuration
    As an Administrator
    I want to be able to edit an existing make

    Background:
        Given there is a make "Opel"
        And I am logged in as an administrator

    @todo
    Scenario: Renaming the make
        When I want to modify a make "Opel"
        And I rename it to "Audi"
        And I save my changes
        Then I should be notified that it has been successfully edited
        And this make name should be "Audi"
