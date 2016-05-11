@core @core_user @core_user_course_preference
Feature: As a user, "Course preferences" allows me to set my course preference(s).
  Background:
    Given I log in as "admin"

    And the following "courses" exist:
      | fullname | shortname | format |
      | Course 1 | C1 | topics |
    And the following "course enrolments" exist:
      | user | course | role |
      | admin | C1 | editingteacher |

    And I am on site homepage
    And I click on ".usermenu .toggle-display.textmenu" "css_element"
    And I click on "//*[contains(@data-rel, 'menu-content')]//a[contains(., 'Preferences')]" "xpath_element"

  @javascript
  Scenario: As a user, I should see "Course preferences" in my user "Preferences" page.
    Then "//a[contains(., 'Course preferences')]" "xpath_element" should be visible

  @javascript
  Scenario: As a user, "activity chooser" should be the default.
    # See that the "activity chooser" is enabled by default.
    Given I click on "//a[contains(., 'Course preferences')]" "xpath_element"
    Then "//input[contains(@checked, 'checked')]" "xpath_element" should be visible

    # See that the "activity chooser" is actually shown by default in course page.
    Given I am on homepage
    And I follow "Course 1"
    Then ".section-modchooser" "css_element" should not exist
    Given I turn editing mode on
    Then ".section-modchooser" "css_element" should be visible
    And ".addresourcedropdown" "css_element" should not be visible

  @javascript
  Scenario: As a user, "activity chooser" should be disabled when I uncheck it in "Course preferences"
    Given I click on "//a[contains(., 'Course preferences')]" "xpath_element"
    And I set the field "enableactivitychooser" to "0"
    And I click on "//input[@value='Save changes']" "xpath_element"

    # See that the "resource dropdown" is shown.
    Given I am on homepage
    And I follow "Course 1"
    And ".addresourcedropdown" "css_element" should not exist
    Given I turn editing mode on
    Then ".section-modchooser" "css_element" should not be visible
    And ".addresourcedropdown" "css_element" should be visible