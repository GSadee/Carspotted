@managing_models
Feature: Deleting a model
    In order to remove test, obsolete or incorrect models
    As an Administrator
    I want to be able to delete a model

    Background:
        Given there is a model "Insignia" made by "Opel"
        And I am logged in as an administrator

    @todo
    Scenario: Deleting the model
        When I delete the model "Insignia"
        Then I should be notified that it has been successfully deleted
        And the model "Insignia" should no longer exist in the registry
