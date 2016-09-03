@spot
Feature: Adding a new spot
    In order to share new photos of exotic cars to other users
    As a Spotter
    I want to be able to add a new spot to the website

    Background:
        Given there is a user "user" with an email "user@example.com"
        And there is a model "RS7" made by "Audi"
        And I am logged in as "user"

    @ui @javascript
    Scenario: Adding a new spot with a single photo
        When I want to add a new spot
        And I choose "Audi" as a make
        And I choose "RS7" as a model
        And I specify the latitude as 51.757134
        And I specify the longitude as 19.536391
        And I specify the country as "Poland"
        And I specify the city as "Lodz"
        And I attach the photo "audi_rs7.jpg"
        And I add it
        Then I should be notified that it has been successfully added
        And the spot "Audi RS7" should appear in the list of my spots
        And the spot "Audi" "RS7" should have a photo
