@managing_spotters
Feature: Browsing spotters
    In order to see all spotters in the website
    As an Administrator
    I want to be able to browse spotters

    Background:
        Given there is an admin "admin" with an email "admin@carspotted.com" and a password "nimda"
        And there is also a user "user" with an email "user@example.com" and a password "resu"
        And I am logged in as an administrator

    @ui
    Scenario: Browsing spotters
        When I want to browse spotters
        Then I should see 2 spotters in the list
        And I should see the spotter "admin" in the list
