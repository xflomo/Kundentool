<?php
namespace Fbreuer\Cms\ViewHelpers;
/*
 * This file belongs to the package "TYPO3 Fluid".
 * See LICENSE.txt that was shipped with this package.
 */
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use Fbreuer\Cms\Database\Database;
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
class NavigationViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

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
    public function render(){

        $activePage = $this->getActivePage();

        $db             = new Database();
        $pages_response = $db->query("SELECT * FROM kundennavigation");

        while($next_res = $db->get_array($pages_response))
        {
            $pages[] = ["name" => $next_res['name'], "icon" => $next_res['symbol'], "navId" => $next_res['nav_id']];
        }

        $pages['active'] = $activePage;

        $this->templateVariableContainer->add("navigation", $pages);
        $output = $this->renderChildren();
        $this->templateVariableContainer->remove("navigation");
        
        return $output;
    }


    public function getActivePage()
    {

        if(!isset($_GET['id'])){
            $_GET['id'] = 0;
        }

        switch ($_GET['id']) {
            case 0:
				$activePage = "Index";
				break;
			case 1:
				$activePage = "Kundenübersicht";
				break;
			case 4:
				$activePage = "Aufgaben";
				break;
			case 5:
				$activePage = "Rechnungen";
				break;
			default: 
				$activePage = "Index";
				break;
        }
        return $activePage;
    }
}