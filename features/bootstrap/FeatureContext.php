<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

require_once __DIR__.'/../../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements MinkContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am on :url
     */
    public function iAmOn($url)
    {
        throw new PendingException();
    }

    /**
     * @Given I'm not logged in
     */
    public function imNotLoggedIn()
    {
        throw new PendingException();
    }

    /**
     * @Given I fill in :arg1 with :arg2
     */
    public function iFillInWith($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given I press :arg1
     */
    public function iPress($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see :arg1
     */
    public function iShouldSee($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I'm logged in
     */
    public function imLoggedIn()
    {
        throw new PendingException();
    }

    /**
     * @Given there are :arg1 posts
     */
    public function thereArePosts($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see :arg1 posts
     */
    public function iShouldSeePosts($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given there are :arg1 post
     */
    public function thereArePost($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I click :arg1
     */
    public function iClick($arg1)
    {
        throw new PendingException();
    }
}
