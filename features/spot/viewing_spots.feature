@spot
Feature: Viewing list of spots
    In order to see all spots in the website
    As a Visitor
    I want to be able to browse spots

    Background:
        Given there is a spotter "user" with an email "user@example.com"
        And there is a model "RS7" made by "Audi"
        And there is also a model "NSX" made by "Honda"
        And this spotter spotted a model "RS7" made by "Audi" which is enabled
        And this spotter spotted also a model "NSX" made by "Honda" which is enabled

    @ui
    Scenario: Viewing list of spots
        When I want to browse spots
        Then I should see 2 spots in the list
        And I should see "Audi RS7" spotted by "user" in the list
        And I should see "Honda NSX" spotted by "user" in the list
