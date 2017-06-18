<?php declare(strict_types = 1);

namespace CMS\Controllers;

use Http\Request;
use Http\Response;
use CMS\Template\Renderer;

class Auth
{

  private $request;
  private $response;
  private $renderer;

  public function __construct(
    Request $request,
    Response $response,
    Renderer $renderer)
  {
    $this->request = $request;
    $this->response = $response;
    $this->renderer = $renderer;
  }

  /*
  | Método para mostrar o Formulário de Login
  */
  public function login()
  {
    $html = $this->renderer->render('Login');
    $this->response->setContent($html);
  }

  /*
  | Método para processar a requisição de Login
  */
  public function postLogin()
  {
    // Validar as credenciais enviadas
    // Se válidas, logar o usuário e redirecionar para /admin
    // Caso contrário, redirecionar de volta com mensagem de erro
  }

  /*
  | Método para efetuar o logout
  */
  public function logout()
  {

  }

}
