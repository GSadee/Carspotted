@dashboard
Feature: Viewing dashboard
    In order to have an overview of my website
    As an Administrator
    I want to be able to view dashboard of my administration panel

    Background:
        And I am logged in as an administrator

    @ui
    Scenario: Viewing dashboard
        When I view the admin dashboard
        Then I should see a text "Dashboard"
