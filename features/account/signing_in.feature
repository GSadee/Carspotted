@signing_in
Feature: Signing in to my account
    In order to view my photos
    As a Visitor
    I want to be able to log in to my account

    Background:
        Given there is a user "user" with an email "user@example.com" and a password "resu"

    @ui
    Scenario: Signing in with an email and a password
        When I want to sign in
        And I specify the username as "user"
        And I specify the password as "resu"
        And I sign in
        Then I should be logged in
        And I should be on the homepage
