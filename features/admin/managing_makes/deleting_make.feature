@managing_makes
Feature: Deleting a make
    In order to remove test, obsolete or incorrect makes
    As an Administrator
    I want to be able to delete a make

    Background:
        Given there is a make "Opel"
        And I am logged in as an administrator

    @ui
    Scenario: Deleting the make
        When I delete the make "Opel"
        Then I should be notified that it has been successfully deleted
        And the make "Opel" should no longer exist in the registry
