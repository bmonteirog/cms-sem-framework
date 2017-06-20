<?php declare(strict_types = 1);

namespace CMS\Controllers\Admin;

use Http\Request;
use Http\Response;
use CMS\Template\Renderer;
use Plasticbrain\FlashMessages\FlashMessages as Flash;
use Delight\Auth\Auth as Authentication;

class Homepage
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

    if(!$this->authentication->isLoggedIn())
      return $this->response->redirect('login');
  }

  function show()
  {
    $data = [
      'marcar' => 'home'
    ];
    $html = $this->renderer->render('Admin/AdminHome', $data);
    $this->response->setContent($html);
  }

}
