@managing_models
Feature: Adding a new model
    In order to have all models in the world
    As an Administrator
    I want to be able to add a new model to the website

    Background:
        Given there is a make "Opel"
        And I am logged in as an administrator

    @todo
    Scenario: Adding a new model
        When I want to add a new model
        And I specify the name as "Insignia"
        And I choose "Opel" as a model
        And I add it
        Then I should be notified that it has been successfully created
        And the model "Insignia" should appear in the registry
