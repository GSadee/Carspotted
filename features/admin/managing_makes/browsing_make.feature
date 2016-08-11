@managing_makes
Feature: Browsing makes
    In order to see all makes in the website
    As an Administrator
    I want to be able to browse makes

    Background:
        Given there is a make "Audi"
        And there is also a make "Honda"
        And there is also a make "Opel"
        And I am logged in as an administrator

    @todo
    Scenario: Browsing makes
        When I want to browse makes
        Then I should see 3 makes in the list
        And I should see the make named "Opel" in the list
