@dashboard
Feature: Viewing recent spots on a dashboard
    In order to have an overview of new spots
    As an Administrator
    I want to be able to view recent spots on my administration dashboard

    Background:
        Given there is a spotter "user" with an email "user@example.com" and a password "resu"
        And there is a model "RS7" made by "Audi"
        And there is also a model "NSX" made by "Honda"
        And this spotter spotted a model "RS7" made by "Audi"
        And this spotter spotted also a model "NSX" made by "Honda"
        And I am logged in as an administrator

    @ui
    Scenario: Viewing recent spots on a dashboard
        When I view the admin dashboard
        Then I should see 2 spots in the list
