Feature: Galleries list
  As a regular web user
  In order to view photos
  I need to enter galleries list page

  Background:
    Given bundle is configured to display 4 photos in gallery preview
    And bundle is configured to display 2 galleries per page

  Scenario: Display galleries list page
    Given there are following galleries
      | Name          | Description        | Photos count | Visible |
      | Summer photos | Photos from summer | 6            | true    |
      | Holidays      | Lorem ipsum        | 3            | false   |
      | Great album   | work in progress   | 10           | false   |
    When I open "Galleries" page
    Then I should see following galleries
      | Name          | Photos count in preview | Description        |
      | Summer photos | 4                       | Photos from summer |
    And each gallery thumbnail should have 200 px width and 200 px height

  Scenario: Display pagination at galleries list page
    Given there are 5 visible galleries
    When I open "Galleries" page
    Then I should see first 2 visible galleries at page
    And I should see pagination with following buttons
      | Button   | Disabled | Active |
      | first    | true     | false  |
      | previous | true     | false  |
      | 1        | false    | true   |
      | 2        | false    | false  |
      | 3        | false    | false  |
      | next     | false    | false  |
      | last     | false    | false  |