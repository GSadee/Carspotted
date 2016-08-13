@managing_models
Feature: Model validation
    In order to avoid making mistakes when managing a model
    As an Administrator
    I want to be prevented from adding or editing it without specifying required fields

    Background:
        Given there is a model "Insignia" made by "Opel"
        And there is a make "Audi"
        And I am logged in as an administrator

    @todo
    Scenario: Trying to add a new model without specifying its name
        When I want to add a new model
        And I do not specify the name
        And I choose "Audi" as a model
        And I try to add it
        Then I should be notified that name is required

    @todo
    Scenario: Trying to add a new model without choosing its make
        When I want to add a new model
        And I specify the name as "S8"
        And I do not choose a make
        And I try to add it
        Then I should be notified that make is required

    @todo
    Scenario: Trying to remove name from an existing model
        When I want to modify the model "Insignia"
        And I remove its name
        And I try to save my changes
        Then I should be notified that name is required
        And this model should still be named "Insignia"
