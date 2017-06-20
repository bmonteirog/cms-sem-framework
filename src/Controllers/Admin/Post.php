<?php declare(strict_types = 1);

namespace CMS\Controllers\Admin;

use Http\Request;
use Http\Response;
use CMS\Template\Renderer;
use Plasticbrain\FlashMessages\FlashMessages as Flash;
use Delight\Auth\Auth as Authentication;
use PDO;

class Post
{
  private $request;
  private $response;
  private $renderer;
  private $authentication;
  private $flash;
  private $pdo;

  public function __construct(
    Request $request,
    Response $response,
    Renderer $renderer,
    Authentication $authentication,
    PDO $pdo)
  {
    $this->flash = new Flash;

    /*
    | Entregando as dependências à classe. O injetor é responsável por
    | instanciar esses objetos automaticamente.
    */
    $this->request = $request;
    $this->response = $response;
    $this->renderer = $renderer;
    $this->authentication = $authentication;
    $this->pdo = $pdo;

    /*
    | Verificação de Usuário logado
    */
    if(!$this->authentication->isLoggedIn())
      return $this->response->redirect('login');
  }

  /*
  | Método para visualizar a lista de Posts cadastrados
  */
  public function index()
  {
    $query = $this->pdo->query('SELECT * FROM posts ORDER BY titulo');
    $posts = $query->fetchAll();

    $data = [
      'marcar' => 'posts',
      'posts'  => $posts,
      'flash'  => $this->flash
    ];

    $html = $this->renderer->render('Admin/Posts/Index', $data);
    $this->response->setContent($html);
  }

  /*
  | Método para visualizar o form de criação de um Post
  */
  public function create()
  {
    $data = [
      'marcar' => 'posts',
      'flash' => $this->flash
    ];
    $html = $this->renderer->render('Admin/Posts/Create', $data);
    $this->response->setContent($html);
  }

  /*
  | Método para armazenar um Post na base de dados
  */
  public function save()
  {
    $data = [
      'titulo' => $this->request->getParameter('titulo'),
      'corpo' => $this->request->getParameter('corpo'),
      'path' => $this->request->getParameter('path')
    ];

    $validation = $this->validate($data, 'insert');

    if(!$validation['passes'])
      return $this->flash->error($validation['msg'], $validation['url'], true);

    try {

      $stmt = $this->pdo->prepare("INSERT INTO posts (titulo, corpo, path) VALUES(:titulo, :corpo, :path)");
      $stmt->execute([
        ':titulo' => $data['titulo'],
        ':corpo'  => $data['corpo'],
        ':path'   => $data['path']
      ]);

      return $this->flash->success('Post cadastrado com sucesso!', '/admin/posts', true);

    } catch (Exception $e) {
      return $this->flash->error('Erro ao cadastrar post.', '/admin/posts/create', true);
    }

  }

  /*
  | Método para visualizar o form de edição de um Post
  */
  public function edit($post_id)
  {
    $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE id = :id LIMIT 1');
    $stmt->execute([
      ':id' => $post_id['post_id']
    ]);

    $post = $stmt->fetch();

    if(!$post)
      return $this->flash->error('Post não encontrado.', '/admin/posts', true);

    $data = [
      'marcar' => 'posts',
      'flash'  => $this->flash,
      'post'   => $post
    ];
    $html = $this->renderer->render('Admin/Posts/Edit', $data);
    $this->response->setContent($html);
  }

  /*
  | Método para atualizar os valores de um Post
  */
  public function update($post_id)
  {
    $data = [
      'titulo' => $this->request->getParameter('titulo'),
      'corpo'  => $this->request->getParameter('corpo'),
      'path'   => $this->request->getParameter('path')
    ];

    $validation = $this->validate($data, 'update', $post_id['post_id']);

    if(!$validation['passes'])
      return $this->flash->error($validation['msg'], $validation['url'], true);

    try {

      $stmt = $this->pdo->prepare("UPDATE posts SET titulo = :titulo, corpo = :corpo, path = :path WHERE id = :id");
      $stmt->execute([
        ':id'     => $post_id['post_id'],
        ':titulo' => $data['titulo'],
        ':corpo'  => $data['corpo'],
        ':path'   => $data['path']
      ]);

      return $this->flash->success('Post atualizado com sucesso!', '/admin/posts', true);

    } catch (Exception $e) {
      return $this->flash->error('Erro ao cadastrar post.', '/admin/posts/create', true);
    }
  }

  /*
  | Método para remover um Post
  */
  public function destroy($post_id)
  {
    try {
      $stmt = $this->pdo->prepare('DELETE FROM posts WHERE id = :id');
      $stmt->execute([
        ':id' => $post_id['post_id']
      ]);

      return $this->flash->success('Post removido com sucesso!', '/admin/posts', true);

    } catch (\Exception $e) {
      return $this->flash->error('Erro ao remover post.', '/admin/posts', true);
    }

  }

  /*
  | Método para validar os formulários de inserção/alteração dos Posts
  */
  private function validate($data, $acao, $id = null)
  {
    $passes = true;

    if(empty($data['titulo'])){
      // Verifica se o campo de Título está vazio
      $passes = false;
      $msg = 'O Título é obrigatório.';
    }elseif(empty($data['path'])){
      // Verifica se o campo de Path está vazio
      $passes = false;
      $msg = 'O Path é obrigatório.';
    }

    if($acao == 'insert'){

      $url = '/admin/posts/create';

      if($passes){
        // verificar se titulo está em uso
        if($this->checkCampoEmUso('titulo', $data['titulo'])){
          $passes = false;
          $msg = 'Este título já está sendo utilizado.';
        }
        // verificar se path está em uso
        if($this->checkCampoEmUso('path', $data['path'])){
          $passes = false;
          $msg = 'Este path já está sendo utilizado.';
        }
      }


    }elseif($acao == 'update'){

      $url = '/admin/posts/edit/'.$id;

      if($passes){
        // verificar se titulo está em uso por outro id
        if($this->checkCampoEmUso('titulo', $data['titulo'], $id)){
          $passes = false;
          $msg = 'Este título já está sendo utilizado por outro Post.';
        }
        // verificar se path está em uso por outro id
        if($this->checkCampoEmUso('path', $data['path'], $id)){
          $passes = false;
          $msg = 'Este path já está sendo utilizado por outro Post.';
        }
      }

    }

    return [
      'passes' => $passes,
      'msg' => isset($msg) ? $msg : '',
      'url' => isset($url) ? $url : ''
    ];
  }

  /*
  | Método para verificar se o valor informado para o campo está em uso
  */
  private function checkCampoEmUso($campo, $valor, $id = null)
  {
    if(is_null($id))
      $query = "SELECT * FROM posts where {$campo} = '{$valor}'";
    else
      $query = "SELECT * FROM posts where {$campo} = '{$valor}' AND id != '{$id}'";

    $result = $this->pdo->prepare($query);
    $result->execute();

    return $result->fetchColumn() > 0;
  }
}
