@spot
Feature: Viewing details of a spot
    In order to see all information about the spot
    As a Visitor
    I want to be able to see details of a spot

    Background:
        Given there is a spotter "user" with an email "user@example.com"
        And there is a model "RS7" made by "Audi"
        And there is also a model "NSX" made by "Honda"
        And this spotter spotted a model "RS7" made by "Audi" which is enabled

    @ui
    Scenario: Viewing a detailed page of a spot
        When I want to view details of this spot
        Then I should see the car name "Audi RS7"
        And I should also see the spotter "user"
