@account
Feature: Account registration
    In order to add new photos
    As a Visitor
    I want to be able to create an account

    @ui
    Scenario: Registering a new account
        Given I want to register a new account
        When I specify the username as "Harvey"
        And I specify the email as "specter@example.com"
        And I specify the password as "password"
        And I confirm this password
        And I register this account
        Then I should be on the register confirmation page
        And I should be notified that new account has been successfully created
        And I should be logged in
