<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext
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
     * @return \Behat\Mink\Element\DocumentElement
     */
    private function getPage()
    {
        return $this->getSession()->getPage();
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
