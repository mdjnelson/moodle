@core @core_admin2
Feature: As an admin, I should be able to enable/disable 'view more' courses link in front page.
  Background:
    Given I log in as "admin"
    And the following "courses" exist:
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
    When I expand "Site administration" node
    And I expand "Front page" node
    And I follow "Front page settings"
    Then I set the field "s__frontpagecourselimit" to "2"
    And I press "Save changes"

  @javascript
  Scenario: Default (base case). The 'view more' courses link should be shown.
    Given I am on homepage
    When I follow "Site home"
    And "//*[contains(@id, 'frontpage-course-list')]//*[contains(., 'All courses')]" "xpath_element" should be visible

  @javascript
  Scenario: Default (base case). The "Enable 'view more' courses link" should be checked in front page settings.
    Given I am on homepage
    And I expand "Site administration" node
    And I expand "Front page" node
    When I follow "Front page settings"
    Then the field "s__frontpageenableviewmorecourses" matches value "1"

  @javascript
  Scenario: Un-checking the "Enable 'view more' courses link" should hide the 'view more' courses link in front page.
    Given I am on homepage
    And I expand "Site administration" node
    And I expand "Front page" node
    When I follow "Front page settings"
    And I set the field "s__frontpageenableviewmorecourses" to "0"
    And I press "Save changes"
    Then I am on homepage
    And I follow "Site home"
    And "//*[contains(@id, 'frontpage-course-list')]//*[contains(., 'All courses')]" "xpath_element" should not be visible