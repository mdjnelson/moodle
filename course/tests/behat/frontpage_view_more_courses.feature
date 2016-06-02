@core @core_course
Feature: As an admin, I should be able to enable/disable 'view more' courses link in the front page.
  In order to hide the link
  As an admin
  I need to ensure the site-wide setting can be used to show/hide the 'view more' courses link

  Background:
    Given the following "courses" exist:
      | fullname | shortname | format |
      | Course 1 | C1 | topics |
      | Course 2 | C2 | topics |
      | Course 3 | C3 | topics |
      | Course 4 | C4 | topics |
    And the following "course enrolments" exist:
      | user | course | role |
      | admin | C1 | editingteacher |
      | admin | C2 | editingteacher |
      | admin | C3 | editingteacher |
      | admin | C4 | editingteacher |
    And I log in as "admin"
    And I expand "Site administration" node
    And I expand "Front page" node
    And I follow "Front page settings"
    And I set the field "s__frontpagecourselimit" to "2"
    And I press "Save changes"

  Scenario: Checking the "Enable 'view more' courses link" should show the 'view more' courses link on the front page.
    Given I am on homepage
    And I expand "Site administration" node
    And I expand "Front page" node
    And I follow "Front page settings"
    And the field "s__frontpageenableviewmorecourses" matches value "1"
    When I follow "Site home"
    Then I should see "All courses"

  @javascript
  Scenario: Un-checking the "Enable 'view more' courses link" should hide the 'view more' courses link on the front page.
    Given I am on homepage
    And I expand "Site administration" node
    And I expand "Front page" node
    And I follow "Front page settings"
    And I set the field "Enable frontpage 'view more' courses link" to "0"
    And I press "Save changes"
    And I am on homepage
    When I follow "Site home"
    Then I should not see "All courses"