<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use Delight\Auth\Auth as Authentication;

require_once __DIR__.'/../../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

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
      $dbconfig = include(__DIR__.'/../../config/db.php');
      $this->pdo = new PDO('mysql:host='.$dbconfig['host'].';dbname='.$dbconfig['database'].';charset=utf8', $dbconfig['username'], $dbconfig['password']);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @Given there are :number_posts posts
     */
    public function thereArePosts($number_of_posts)
    {
      $stmt = $this->pdo->prepare('DELETE FROM posts');
      $stmt->execute();

      for ($i=0; $i < $number_of_posts; $i++) {
        $stmt = $this->pdo->prepare("INSERT INTO posts (titulo, corpo, path) VALUES(:titulo, :corpo, :path)");
        $stmt->execute([
          ':titulo' => 'Post Teste #'.$i,
          ':corpo' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
          ':path' => 'post-teste-'.$i
        ]);
      }
    }

    /**
     * @Then I should see :numer_of_posts posts
     */
    public function iShouldSeePosts($number_of_posts)
    {
      $nodes = $this->getSession()->getPage()->findAll("css", '.menu-list li');

      if(count($nodes) != $number_of_posts)
        throw new \Exception(sprintf("The page '%s' does not contain enough links", $this->getSession()->getCurrentUrl()));
    }

    /**
     * @Then I should see :number_of_posts posts rows
     */
    public function iShouldSeePostsRows($number_of_posts)
    {
      $nodes = $this->getSession()->getPage()->findAll("css", '.post-row');

      if(count($nodes) != $number_of_posts)
        throw new \Exception(sprintf("The page '%s' does not contain enough links", $this->getSession()->getCurrentUrl()));
    }

    /**
     * @Given I am logged in
     */
    public function iAmLoggedIn()
    {
      $session = $this->getSession();

      $session->visit('http://cmsjust/login');

      $page = $session->getPage();

      $login_field = $page->find('css', 'input#inputusername');
      $login_field->setValue('admin');

      $pass_field = $page->find('css', 'input#inputpassword');
      $pass_field->setValue('senhateste');

      $submit = $page->find('css', 'input#inputsubmit');
      $submit->press();
    }
}
