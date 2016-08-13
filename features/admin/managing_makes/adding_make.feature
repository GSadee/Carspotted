@managing_makes
Feature: Adding a new make
    In order to have all makes in the world
    As an Administrator
    I want to be able to add a new make to the website

    Background:
        Given I am logged in as an administrator

    @ui
    Scenario: Adding a new make
        When I want to add a new make
        And I specify the name as "Opel"
        And I add it
        Then I should be notified that it has been successfully created
        And the make "Opel" should appear in the registry
