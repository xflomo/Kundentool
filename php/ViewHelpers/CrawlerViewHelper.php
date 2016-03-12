<?php
namespace Fbreuer\Cms\ViewHelpers;
/*
 * This file belongs to the package "TYPO3 Fluid".
 * See LICENSE.txt that was shipped with this package.
 */
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use Fbreuer\Cms\Crawler;
/**
 * Declares new variables which are aliases of other variables.
 * Takes a "map"-Parameter which is an associative array which defines the shorthand mapping.
 *
 * The variables are only declared inside the <f:alias>...</f:alias>-tag. After the
 * closing tag, all declared variables are removed again.
 *
 * = Examples =
 *
 * <code title="Single alias">
 * <f:alias map="{x: 'foo'}">{x}</f:alias>
 * </code>
 * <output>
 * foo
 * </output>
 *
 * <code title="Multiple mappings">
 * <f:alias map="{x: foo.bar.baz, y: foo.bar.baz.name}">
 *   {x.name} or {y}
 * </f:alias>
 * </code>
 * <output>
 * [name] or [name]
 * depending on {foo.bar.baz}
 * </output>
 *
 * Note: Using this view helper can be a sign of weak architecture. If you end up using it extensively
 * you might want to fine-tune your "view model" (the data you assign to the view).
 *
 * @api
 */
class CrawlerViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @var string
     */
    public $activePage;
    /**
     * @var boolean
     */
    protected $escapeOutput = FALSE;

    /**
     * Renders alias
     *
     * @return array
     * @api
     */
    public function render() {

        // USAGE

        if(isset($_POST['startCrawler'])){
            $startURL = $_POST['searchedUrl'];
            $depth = 2;
            $keywords =null;
            if(isset($_POST['keywords']) and !empty($_POST['keywords'])){
                $keywords = array($_POST['keywords']);
            }
            $values = $_POST['ary'];


            $crawler = new Crawler($startURL, $depth, $keywords, $values);
            $pages = $crawler->run();


            $this->templateVariableContainer->add("crawler", $pages);
            $output = $this->renderChildren();
            $this->templateVariableContainer->remove("navigation");
            return $output;
        }


    }


    public function getActivePage()
    {

        if(!isset($_GET['id'])){
            $_GET['id'] = 0;
        }

        switch ($_GET['id']) {
            case 0:
                $activePage = "Home";
                break;
            case 1:
                $activePage = "Crawler";
                break;
            default:
                $activePage = "Home";
        }

        return $activePage;
    }
}