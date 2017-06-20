<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use Delight\Auth\Auth as Authentication;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext
{

    private $pdo;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
      $dbconfig = include(__DIR__.'/../../config/database.php');
      $this->pdo = new PDO('mysql:host='.$dbconfig['host'].';dbname='.$dbconfig['database'].';charset=utf8', $dbconfig['username'], $dbconfig['password']);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @Given there are :number_posts posts
     */
    public function thereArePosts($number_posts)
    {
      $stmt = $this->pdo->prepare('DELETE FROM posts');
      $stmt->execute();

      for ($i=0; $i < $number_posts; $i++) {
        $stmt = $this->pdo->prepare("INSERT INTO posts (titulo, corpo, path) VALUES(:titulo, :corpo, :path)");
        $stmt->execute([
          ':titulo' => 'Post Teste #'.$i,
          ':corpo' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
          ':path' => 'posts/post-teste-'.$i
        ]);
      }
    }

    /**
     * @Then I should see :arg1 posts
     */
    public function iShouldSeePosts($arg1)
    {
      throw new PendingException();
    }

    /**
     * @Given I am logged in
     */
    public function iAmLoggedIn()
    {
      
    }
}
