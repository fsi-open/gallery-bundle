Feature: Display gallery
  As a regular web user
  In order to view photos in some particular gallery
  I need to enter gallery page

  Background:
    Given there are following galleries
    | Name          | Description        | Photos count | Visible |
    | My Photos     | My Private photos  | 8            | true    |

  Scenario: Access gallery page
    Given I am on the "Galleries" page
    When I press "My Photos" header
    Then I should see header "My Photos"

  Scenario: Gallery page
    Given I am on the "Gallery" with name "My Photos" page
    Then I should see header "My Photos"
    And I should see "My Private photos" description
    And I should see 8 thumbnails that links to original photos