Feature: List and read Posts
  In order to access all the posts
  As a user
  I need to be able to list/show posts

Scenario: No Posts available
  Given there are 0 posts
  And I am on "/"
  Then I should see "Nenhum post cadastrado até o momento."

Scenario: List available Posts
  Given there are 5 posts
  And I am on "/"
  Then I should see 5 posts

Scenario: Show a Post
  Given there are 1 posts
  And I am on "/"
  When I follow "post-teste-0"
  Then I should see "Lorem ipsum"

Scenario: Post not found
  Given I am on "/url-nao-existente"
  Then I should see "404 - Page not found"
