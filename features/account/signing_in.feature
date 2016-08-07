@account
Feature: Sign in to my account
    In order to view my photos
    As a Visitor
    I want to be able to log in to my account

    Background:
        Given there is a user "user" with an email "user@example.com" and a password "resu"

    @ui
    Scenario: Sign in with an email and a password
        Given I want to sign in
        When I specify the username as "user"
        And I specify the password as "resu"
        And I sign in
        Then I should be logged in
        And I should be on the homepage

    @ui
    Scenario: Sign in with bad credentials
        Given I want to sign in
        When I specify the username as "user"
        And I specify the password as "wrongpassword"
        And I sign in
        Then I should be notified about invalid credentials
        And I should not be logged in
