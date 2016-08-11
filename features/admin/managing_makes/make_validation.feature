@managing_makes
Feature: Make validation
    In order to avoid making mistakes when managing a make
    As an Administrator
    I want to be prevented from adding or editing it without specifying required fields

    Background:
        Given there is a make "Opel"
        And I am logged in as an administrator

    @todo
    Scenario: Trying to add a new make without specifying its name
        When I want to add a new make
        And I do not specify the name
        And I try to add it
        Then I should be notified that name is required

    @todo
    Scenario: Trying to remove name from an existing make
        When I want to modify this make
        And I remove its name
        And I try to save my changes
        Then I should be notified that name is required
        And this make should still be named "Opel"
