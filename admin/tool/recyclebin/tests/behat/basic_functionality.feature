@tool @tool_recyclebin
Feature: Basic recycle bin functionality
  As a teacher
  I want be able to recover deleted content
  So that I can fix a mistake or an accidental deletion

  Background: Course with teacher exists.
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | teacher1 | Teacher | 1 | teacher@asd.com |
      | student1 | Student | 1 | student@asd.com |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1 |
    And the following "course enrolments" exist:
      | user | course | role |
      | teacher1 | C1 | editingteacher |

  Scenario: Restore and delete an assingnment.
    Given I log in as "teacher1"
    And I follow "Course 1"
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name                | Test page |
      | Description         | Test   |
      | Page content        | Test   |
    And I delete "Test page" activity
    When I follow "Recycle bin"
    Then I should see "Test page"
    And I follow "Restore"
    And I should see "Test page has been restored"
    And I wait to be redirected
    And I am on homepage
    And I follow "Course 1"
    And I should see "Test page" in the "Topic 1" "section"
    And I delete "Test page" activity
    And I follow "Recycle bin"
    And I should see "Test page"
    And I follow "Delete"
    And I should see "Test page has been deleted"
    And I wait to be redirected
    And I am on homepage
    And I follow "Course 1"
    And I should not see "Test page" in the "Topic 1" "section"
