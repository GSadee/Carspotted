@signing_in
Feature: Signing in to my account validation
    In order to avoid making mistakes when signing in to an account
    As a Visitor
    I want to be prevented from signing in with bad credentials

    Background:
        Given there is a user "user" with an email "user@example.com" and a password "resu"

    @ui
    Scenario: Trying to sign in with bad credentials
        When I want to sign in
        And I specify the username as "user"
        And I specify the password as "wrongpassword"
        And I try to sign in
        Then I should be notified about invalid credentials
        And I should not be logged in
