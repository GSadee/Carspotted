@homepage
Feature: Viewing homepage
    In order to see homepage of the website
    As an Visitor
    I want to be able to view homepage

    @ui
    Scenario: Viewing homepage
        When I view the homepage
        Then I should see a text "Carspotted"
