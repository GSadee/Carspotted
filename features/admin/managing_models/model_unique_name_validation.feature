@managing_models
Feature: Model unique code validation
    In order to uniquely identify models
    As an Administrator
    I want to be prevented from adding two models with the same name

    Background:
        Given there is a model "Aventador" made by "Lamborghini"
        And I am logged in as an administrator

    @todo
    Scenario: Trying to add a model with a taken name
        When I want to add a new model
        And I specify the name as "Aventador"
        And I choose "Lamborghini" as a make
        And I try to add it
        Then I should be notified that model with this name and make already exists
        And there should still be only one model with name "Aventador"
