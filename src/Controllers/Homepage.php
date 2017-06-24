<?php declare(strict_types = 1);

namespace CMS\Controllers;

use Http\Request;
use Http\Response;
use CMS\Template\Renderer;
use CMS\Models\PostModel;

class Homepage
{

  private $request;
  private $response;
  private $renderer;
  private $postModel;

  public function __construct(
    Request $request,
    Response $response,
    Renderer $renderer,
    PostModel $postModel)
  {
    $this->request = $request;
    $this->response = $response;
    $this->renderer = $renderer;
    $this->postModel = $postModel;
  }

  public function index()
  {
    $posts = $this->postModel->all();

    $data = ['posts'  => $posts];

    $html = $this->renderer->render('Homepage', $data);
    $this->response->setContent($html);
  }

  public function show($slug)
  {
    $posts = $this->postModel->all();


    $detalhe = $this->postModel->findBySlug($slug['slug']);

    $data = [
      'posts'  => $posts,
      'detalhe' => $detalhe
    ];

    $html = $this->renderer->render('Post', $data);
    $this->response->setContent($html);
  }
}
