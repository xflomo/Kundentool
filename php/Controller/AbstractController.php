<?php
namespace Fbreuer\Cms\Controller;

abstract class AbstractController
{
    protected $db;

    public function __construct($db) {
        $this->db = $db;

        $this->view = new \TYPO3Fluid\Fluid\View\TemplateView();

        $paths = $this->view->getTemplatePaths();
        $paths->setTemplateRootPaths(array(ROOT_PATH . '/Templates/'));
        $paths->setLayoutRootPaths(array(ROOT_PATH . '/Layouts/'));
        $paths->setPartialRootPaths(array(ROOT_PATH . '/Partials/'));

    }

    public function render($template) {
        $this->view->getTemplatePaths()->setTemplatePathAndFilename(ROOT_PATH . '/Templates/' . $template . '.html');
        echo $this->view->render();
    }
}