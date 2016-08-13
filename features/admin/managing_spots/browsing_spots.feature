@managing_spots
Feature: Browsing spots
    In order to see all spots in the website
    As an Administrator
    I want to be able to browse spots

    Background:
        Given there is a spotter "user" with an email "user@example.com" and a password "resu"
        And there is a model "RS7" made by "Audi"
        And there is also a model "NSX" made by "Honda"
        And this user spotted a model "RS7" made by "Audi"
        And this user spotted also a model "NSX" made by "Honda"
        And I am logged in as an administrator

    @todo
    Scenario: Browsing spots
        When I want to browse spots
        Then I should see 2 spots in the list
