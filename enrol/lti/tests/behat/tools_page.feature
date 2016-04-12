@enrol @enrol_lti
Feature: Check that the page listing the shared external tools is functioning as expected
  In order to view
  As an admin
  I need to ensure the site-wide settings are used

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | teacher1 | Teacher | 1 | teacher1@example.com |
    And the following "courses" exist:
      | fullname | shortname | format |
      | Course 1 | C1 | topics |
    And the following "course enrolments" exist:
      | user | course | role |
      | teacher1 | C1 | editingteacher |
    And I log in as "admin"
    And I navigate to "Manage enrol plugins" node in "Site administration > Plugins > Enrolments"
    And I click on "Enable" "link" in the "Shared external tool" "table_row"
    And I log out

  @javascript
  Scenario: I want to share an activity as an external tool
    Given I log in as "teacher1"
    And I follow "Course 1"
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name | Test assignment name |
      | Description | Submit your online text |
    And I navigate to "Enrolment methods" node in "Course administration > Users"
    And I select "Shared external tool" from the "Add method" singleselect
    And I set the following fields to these values:
      | Custom instance name | Assignment - LTI |
      | Tool to be provided | Test assignment name |
    And I press "Add method"
    And I navigate to "Shared external tools" node in "Course administration"
    And I wait "60" seconds
