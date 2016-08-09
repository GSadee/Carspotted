@admin_dashboard
Feature: Viewing dashboard
    In order to have an overview of my website
    As an Administrator
    I want to be able to view dashboard of my administration panel

    Background:
        And I am logged in as an administrator

    @todo
    Scenario: Viewing dashboard
        When I view the dashboard
        Then I should see a text "Dashboard"