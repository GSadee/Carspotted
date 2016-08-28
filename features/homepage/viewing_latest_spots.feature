@homepage
Feature: Viewing the latest spots on the homepage
    In order to see the newest spots in the website
    As a Visitor
    I want to be able to view several newest spots on the homepage

    Background:
        Given there is a model "RS6" made by "Audi"
        And there is also a model "RS7" made by "Audi"
        And there is also a model "NSX" made by "Honda"
        And there is a spotter "user" with an email "user@example.com"
        And this spotter spotted a model "RS6" made by "Audi"
        And this spotter spotted also a model "RS7" made by "Audi"
        And this spotter spotted also a model "NSX" made by "Honda"
        And there is a spotter "spotter" with an email "spotter@example.com"
        And this spotter spotted a model "RS7" made by "Audi"

    @todo
    Scenario: Viewing the newest spots on the homepage
        When I view the homepage
        Then I should see only the 3 newest spots in the list
        And I should not see "Audi RS6" spotted by "user" in the list
