<?php
namespace Fbreuer\Cms\Controller;

use Fbreuer\Cms\User;

class StandardController extends AbstractController
{
    public function indexAction()
    {
        $this->render('Index');
    }

    public function switchPageAction()
    {
        switch ($_GET['id']) {
            case 0:
                $this->render('Index');
				break;
			case 1:
                $this->render('Kundenübersicht');
				break;
			case 4:
                $this->render('Aufgaben');
				break;
			case 5:
                $this->render('Rechnungen');
				break;
			default: 
				$this->render('Index');
				break;
        }
    }

    public function wrongControllerAction ()
    {
        $this->render('Index');
        echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Die Ausgewählte Action wurde nicht gefunden!</strong>
                </div>';
    }

}