@managing_makes
Feature: Make unique code validation
    In order to uniquely identify makes
    As an Administrator
    I want to be prevented from adding two makes with the same name

    Background:
        Given there is a make "Lamborghini"
        And I am logged in as an administrator

    @todo
    Scenario: Trying to add a make with a taken name
        When I want to add a new make
        And I specify the name as "Lamborghini"
        And I try to add it
        Then I should be notified that make with this name already exists
        And there should still be only one make with name "Lamborghini"
