Feature: Authentication
  In order to gain access to the management area
  As an admin
  I need to be able to login and logout

Scenario: Loggin in
  Given I am on "login"
  And I fill in "Username" with "admin"
  And I fill in "Password" with "senhateste"
  And I press "Login"
  Then I should see "Bem Vindo"

Scenario: Empty fields
  Given I am on "login"
  And I fill in "Username" with ""
  And I press "Login"
  And I should see "O nome de Usuário é obrigatório."

Scenario: Invalid username
  Given I am on "/login"
  And I fill in "Username" with "usuario"
  And I fill in "Password" with "senha"
  And I press "Login"
  Then I should see "Usuário não encontrado"

Scenario: Invalid password
  Given I am on "/login"
  And I fill in "Username" with "admin"
  And I fill in "Password" with "senhaerrada"
  And I press "Login"
  Then I should see "Senha incorreta"
