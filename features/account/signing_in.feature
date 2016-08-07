@account
Feature: Sign in to my account
    In order to view my photos
    As a Visitor
    I want to be able to log in to my account

    Background:
        Given there is a user "user@example.com" with password "resu"

    @todo
    Scenario: Sign in with an email and a password
        Given I want to sign in
        When I specify the username as "user@example.com"
        And I specify the password as "resu"
        And I log in
        Then I should be logged in

    @todo
    Scenario: Sign in with bad credentials
        Given I want to log in
        When I specify the username as "user@example.com"
        And I specify the password as "wrongpassword"
        And I log in
        Then I should be notified about bad credentials
        And I should not be logged in
