@tool @tool_recyclebin
Feature: Test that the protected activities setting works as expected
  As a teacher
  I should not be able to delete protected activities
  So as an admin I can be sure that protected activities will remain on the server

  Background: Course with activities exists.
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | teacher1 | Teacher | 1 | teacher@asd.com |
      | student1 | Student | 1 | student@asd.com |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1 |
      | Course 2 | C2 |
    And the following "course enrolments" exist:
      | user | course | role |
      | teacher1 | C1 | editingteacher |
    And I log in as "admin"
    And I am on site homepage
    And I follow "Course 1"
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name | Test assign |
      | Description | Test assign |
    And I add a "Book" to section "1" and I fill the form with:
      | Name | Test book |
      | Description | Test book |
    And I navigate to "Recycle bin" node in "Site administration > Plugins > Admin tools"
    And I set the field "Protected activities" to "assign"
    And I press "Save changes"
    And I am on site homepage
    And I follow "Course 1"
    And I delete "Test assign" activity
    And I delete "Test book" activity

  @javascript
  Scenario: Ensure a teacher can not delete a protected item.
    Given I log out
    And I log in as "teacher1"
    And I follow "Course 1"
    And I follow "Recycle bin"
    And I should see "Test assign"
    And I should see "Test book"
    And I click on "Delete all" "link"
    And I press "Yes"
    And I wait to be redirected
    And I should see "Test assign"
    And I should not see "Test book"

  @javascript
  Scenario: Ensure an admin can delete a protected item.
    And I follow "Recycle bin"
    And I should see "Test assign"
    And I should see "Test book"
    And I click on "Delete all" "link"
    And I press "Yes"
    And I wait to be redirected
    And I should not see "Test assign"
    And I should not see "Test book"