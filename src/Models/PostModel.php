<?php declare(strict_types = 1);

namespace CMS\Models;

use PDO;

class PostModel
{

  protected $tabela = 'posts';
  private $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function all()
  {
    $query = $this->pdo->query("SELECT * FROM {$this->tabela} ORDER BY titulo");
    return $query->fetchAll();
  }

  public function find($id)
  {
    $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE id = :id LIMIT 1');
    $stmt->execute([
      ':id' => $id
    ]);

    return $stmt->fetch();
  }

  public function findBySlug($slug)
  {
    $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE path = :path LIMIT 1');
    $stmt->execute([
      ':path' => $slug
    ]);

    return $stmt->fetch();
  }

  public function save($data)
  {
    $stmt = $this->pdo->prepare("INSERT INTO {$this->tabela} (titulo, corpo, path) VALUES(:titulo, :corpo, :path)");
    return $stmt->execute([
      ':titulo' => $data['titulo'],
      ':corpo'  => $data['corpo'],
      ':path'   => $data['path']
    ]);
  }

  public function update($id, $data)
  {
    $stmt = $this->pdo->prepare("UPDATE posts SET titulo = :titulo, corpo = :corpo, path = :path WHERE id = :id");
    return $stmt->execute([
      ':id'     => $id,
      ':titulo' => $data['titulo'],
      ':corpo'  => $data['corpo'],
      ':path'   => $data['path']
    ]);
  }

  public function destroy($id)
  {
    $stmt = $this->pdo->prepare('DELETE FROM posts WHERE id = :id');
    return $stmt->execute([
      ':id' => $id
    ]);
  }

}
