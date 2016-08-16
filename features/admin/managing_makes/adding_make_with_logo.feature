@managing_makes
Feature: Adding a new make with a logo
    In order to have all makes in the world
    As an Administrator
    I want to be able to add a new make with its logo to the website

    Background:
        Given I am logged in as an administrator

    @ui
    Scenario: Adding a new make with a logo
        When I want to add a new make
        And I specify the name as "Lamborghini"
        And I attach the logo "lamborghini.png"
        And I add it
        Then I should be notified that it has been successfully created
        And the make "Lamborghini" should appear in the registry
        And this make should have a logo
