Feature: Authentication
  In order to gain access to the management area
  As an admin
  I need to be able to login and logout

Scenario: Loggin in
  Given I am on "/admin"
  And I'm not logged in
  And I fill in "Username" with "admin"
  And I fill in "Password" with "senha"
  And I press "Login"
  Then I should see "Logout"

Scenario: Invalid username
  Given I am on "/admin"
  And I'm not logged in
  And I fill in "Username" with "usuario"
  And I fill in "Password" with "senha"
  And I press "Login"
  Then I should see "Erro de autenticação."

Scenario: Invalid password
  Given I am on "/admin"
  And I'm not logged in
  And I fill in "Username" with "admin"
  And I fill in "Password" with "senhaerrada"
  And I press "Login"
  Then I should see "Erro de autenticação."

Scenario: Loggin out
  Given I am on "/admin"
  And I'm logged in
  And I press "Logout"
  Then I should see "Login"
