@registering
Feature: Account registration validation
    In order to avoid making mistakes when registering an account
    As a Visitor
    I want to be prevented from creating an account without required fields

    @ui
    Scenario: Trying to register a new account with email that has been already used
        Given there is a user "user" with an email "user@example.com" and a password "resu"
        And I want to register a new account
        When I specify the username as "Harvey"
        And I specify the email as "user@example.com"
        And I specify the password as "password"
        And I confirm this password
        And I try to register this account
        Then I should be notified that the email is already used
        And I should not be logged in

    @ui
    Scenario: Trying to register a new account without specifying username
        Given I want to register a new account
        When I do not specify the username
        And I specify the email as "specter@example.com"
        And I specify the password as "password"
        And I confirm this password
        And I try to register this account
        Then I should be notified that the username is required
        And I should not be logged in

    @ui
    Scenario: Trying to register a new account without specifying email
        Given I want to register a new account
        When I specify the username as "Harvey"
        And I do not specify the email
        And I specify the password as "password"
        And I confirm this password
        And I try to register this account
        Then I should be notified that the email is required
        And I should not be logged in

    @ui
    Scenario: Trying to register a new account without specifying password
        Given I want to register a new account
        When I specify the username as "Harvey"
        And I specify the email as "specter@example.com"
        And I do not specify the password
        And I try to register this account
        Then I should be notified that the password is required
        And I should not be logged in

    @ui
    Scenario: Trying to register a new account without confirming password
        Given I want to register a new account
        When I specify the username as "Harvey"
        And I specify the email as "specter@example.com"
        And I specify the password as "password"
        And I do not confirm the password
        And I try to register this account
        Then I should be notified that the password do not match
        And I should not be logged in
