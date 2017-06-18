Feature: Posts admin panel
  In order to maintain the posts shown on the public access
  As a admin
  I need to be able to list/add/edit/delete posts

Scenario: List available Posts
  Given there are 5 posts
  And I am on "/admin"
  When I click "Posts"
  Then I should see 5 posts

Scenario: Add a new Post
  Given I am on "/admin/posts"
  When I click "Novo Post"
  And I fill in "Título" with "Post Teste"
  And I fill in "Corpo" with "Lorem ipsum"
  And I fill in "Path" with "posts/novo-post"
  And I press "Salvar"
  Then I should see "Post criado com sucesso!"

Scenario: Edit an existing Post
  Given there are 1 post
  And I am on "/admin/posts"
  When I click "Editar"
  And I fill in "Título" with "Novo título"
  And I fill in "Corpo" with "Dolor sit"
  And I press "Salvar"
  Then I should see "Post alterado com sucesso!"

Scenario: Delete an existing Post
  Given there are 1 post
  And I am on "/admin/posts"
  When I click "Excluir"
  Then I should see "Post removido com sucesso!"

Scenario: Add a Post with empty title
  Given I am on "/admin/posts"
  When I click "Novo Post"
  And I press "Salvar"
  Then I should see "O Título é obrigatório!"

Scenario: Add a Post with empty path
  Given I am on "/admin/posts"
  When I click "Novo Post"
  And I fill in "Título" with "Novo título"
  And I press "Salvar"
  Then I should see "O path é obrigatório!"
