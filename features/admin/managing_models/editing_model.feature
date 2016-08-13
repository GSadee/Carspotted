@managing_models
Feature: Editing a model
    In order to change model configuration
    As an Administrator
    I want to be able to edit an existing model

    Background:
        Given there is a model "Insignia" made by "Opel"
        And there is a make "Vauxhall"
        And I am logged in as an administrator

    @todo
    Scenario: Renaming the model
        When I want to modify the model "Insignia"
        And I rename it to "Astra"
        And I save my changes
        Then I should be notified that it has been successfully edited
        And this model name should be "Astra"

    @todo
    Scenario: Changing the model make
        When I want to modify the model "Insignia"
        And I change a make to "Vauxhall"
        And I save my changes
        Then I should be notified that it has been successfully edited
        And this model make should be "Vauxhall"
