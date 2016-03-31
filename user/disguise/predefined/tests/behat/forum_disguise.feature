@disguise @disguise_predefined @arn
Feature: Enable a pre-defined disguise
  In order to facilitate group discussion
  As a teacher
  I need to be able to disguise user identities

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | teacher1 | Teacher | 1 | teacher1@example.com |
      | student1 | Student | 1 | student1@example.com |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1 | 0 |
    And the following "course enrolments" exist:
      | user | course | role |
      | teacher1 | C1 | editingteacher |
      | student1 | C1 | student |

  Scenario: I cannot see the real identity of users when identity revelation is disabled
    Given I log in as "teacher1"
    And I follow "Course 1"
    And I turn editing mode on
    And I add a "Forum" to section "1" and I fill the form with:
      | Forum name | Test forum name |
      | Forum type | Standard forum for general use |
      | Description | Test forum description |
      | Disguise type | Select from a list of tutor-defined names |
    And  I follow "Test forum name"
    And  I should see "There are no names available. Please create some."
    And I set the following fields to these values:
      | Names to add | Abracadabra |
    And I press "Add names"
    And I follow "Test forum name"
    When I add a new discussion to "Test forum name" forum with:
      | Subject | My first post |
      | Message | This is the body |
    Then I should see "Abracadabra will be notified of new posts in 'My first post'"
    And I should see "Abracadabra" in the "My first post" "table_row"
    And I follow "My first post"
    And I should see "by Abracadabra"
    And I should not see "Teacher 1"
    And I follow "Configure disguise"
    And I set the following fields to these values:
      | Names to add | Alakazam  |
    And I press "Add names"
    And I log out
    And I log in as "student1"
    And I follow "Test forum name"
    And I should see "Alakazam"
    And I should see "Abracadabra" in the "My first post" "table_row"
    And I should not see "Abracadabra"

  Scenario: I can see the real identity of users when identity revelation is set
    Given I log in as "teacher1"
    And I follow "Course 1"
    And I turn editing mode on
    And I add a "Forum" to section "1" and I fill the form with:
      | Forum name | Test forum name |
      | Forum type | Standard forum for general use |
      | Description | Test forum description |
      | Disguise type | Select from a list of tutor-defined names |
      | Show user's real identity alongside their disguise | Identity shown |
    And I follow "Test forum name"
    And I should see "There are no names available. Please create some."
    And I set the following fields to these values:
      | Names to add | Abracadabra |
    And I press "Add names"
    And I follow "Test forum name"
    When I add a new discussion to "Test forum name" forum with:
      | Subject | My first post |
      | Message | This is the body |
    Then I should see "Abracadabra (Teacher 1) will be notified of new posts in 'My first post'"
    And I should see "Abracadabra (Teacher 1)" in the "My first post" "table_row"
    And I follow "My first post"
    And I should see "by Abracadabra (Teacher 1)"
    And I follow "Configure disguise"
    And I set the following fields to these values:
      | Names to add | Alakazam  |
    And I press "Add names"
    And I log out
    And I log in as "student1"
    And I follow "Test forum name"
    And I should see "Alakazam (Student 1)"
    And I should see "Abracadabra (Teacher 1)" in the "My first post" "table_row"
