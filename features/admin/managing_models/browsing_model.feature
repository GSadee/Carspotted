@managing_models
Feature: Browsing models
    In order to see all models in the website
    As an Administrator
    I want to be able to browse models

    Background:
        Given there is a model "Insignia" made by "Opel"
        And there is also a model "Accord" made by "Honda"
        And I am logged in as an administrator

    @ui
    Scenario: Browsing models
        When I want to browse models
        Then I should see 2 models in the list
        And I should see the model named "Insignia" in the list
