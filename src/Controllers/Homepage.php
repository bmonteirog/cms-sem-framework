<?php declare(strict_types = 1);

namespace CMS\Controllers;

use Http\Request;
use Http\Response;
use CMS\Template\Renderer;
use PDO;

class Homepage
{

  private $request;
  private $response;
  private $renderer;
  private $pdo;

  public function __construct(
    Request $request,
    Response $response,
    Renderer $renderer,
    PDO $pdo)
  {
    $this->request = $request;
    $this->response = $response;
    $this->renderer = $renderer;
    $this->pdo = $pdo;
  }

  public function index()
  {
    $query = $this->pdo->query('SELECT * FROM posts ORDER BY titulo');
    $posts = $query->fetchAll();

    $data = ['posts'  => $posts];

    $html = $this->renderer->render('Homepage', $data);
    $this->response->setContent($html);
  }

  public function show($slug)
  {
    $query = $this->pdo->query('SELECT * FROM posts ORDER BY titulo');
    $posts = $query->fetchAll();

    $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE path = :path LIMIT 1');
    $stmt->execute([
      ':path' => $slug['slug']
    ]);

    $detalhe = $stmt->fetch();

    $data = [
      'posts'  => $posts,
      'detalhe' => $detalhe
    ];

    $html = $this->renderer->render('Post', $data);
    $this->response->setContent($html);
  }
}
