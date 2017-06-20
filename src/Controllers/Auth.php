<?php declare(strict_types = 1);

namespace CMS\Controllers;

use Http\Request;
use Http\Response;
use CMS\Template\Renderer;
use Plasticbrain\FlashMessages\FlashMessages as Flash;
use Delight\Auth\Auth as Authentication;

class Auth
{

  private $request;
  private $response;
  private $renderer;
  private $authentication;
  private $flash;

  public function __construct(
    Request $request,
    Response $response,
    Renderer $renderer,
    Authentication $authentication)
  {
    $this->flash = new Flash;
    $this->request = $request;
    $this->response = $response;
    $this->renderer = $renderer;
    $this->authentication = $authentication;
  }

  /*
  | Método para mostrar o Formulário de Login
  */
  public function login()
  {
    $html = $this->renderer->render('Login', [
      'flash' => $this->flash
    ]);
    $this->response->setContent($html);
  }

  /*
  | Método para processar a requisição de Login
  */
  public function postLogin()
  {
    /*
    | Vamos validar as credenciais enviadas
    | Se forem válidas, logar o usuário e redirecionar para /admin
    | Caso contrário, redirecionar de volta com mensagem de erro
    */

    $data = [
      'username' => $this->request->getParameter('Username'),
      'password' => $this->request->getParameter('Password')
    ];

    if(empty($data['username']))
      return $this->flash->error('O nome de Usuário é obrigatório.', 'login', true);

    if(empty($data['password']))
      return $this->flash->error('A senha é obrigatória.', 'login', true);

    try {
      $this->authentication->loginWithUsername($data['username'], $data['password'], true);
      // Usuário logou com sucesso, redirecionar para a Home do Admin
      return $this->response->redirect('admin');
    }
    catch (\Delight\Auth\UnknownUsernameException $e) {
      // Usuário não encontrado, redirecionar de volta para a tela de login
      return $this->flash->error('Usuário não encontrado', 'login', true);
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
      // Senha incorreta, redirecionar de volta para a tela de login
      return $this->flash->error('Senha incorreta', 'login', true);
    }
    catch (\Exception $e){
      // Erro ao logar, redirecionar de volta para a tela de login
      return $this->flash->error('Erro ao logar', 'login', true);
    }
  }

  /*
  | Método para efetuar o logout
  */
  public function logout()
  {
    $this->authentication->logout();
    $this->response->redirect('login');
  }

}
