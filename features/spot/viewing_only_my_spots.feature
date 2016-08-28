@spot
Feature: Viewing list of my spots
    In order to see history of my spots
    As a Spotter
    I want to be able to browse my spots

    Background:
        Given there is a model "RS7" made by "Audi"
        And there is also a model "NSX" made by "Honda"
        And there is a spotter "user" with an email "user@example.com"
        And this spotter spotted a model "RS7" made by "Audi"
        And there is also a spotter "spotter" with an email "spotter@example.com"
        And this spotter spotted a model "NSX" made by "Honda"
        And I am logged in as "user@example.com"

    @todo
    Scenario: Viewing list of my spots
        When I want to browse my spots
        Then I should see a single spot in the list
        And I should see "Audi RS7" in the list
        And I should not see "Honda NSX" in the list
