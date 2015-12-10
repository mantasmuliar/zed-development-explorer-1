<?php

namespace Pyz\Yves\Cms\Controller;

use SprykerEngine\Yves\Application\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CmsController extends AbstractController
{

    /**
     * @param array $meta
     * @param Request $request
     *
     * @return Response
     */
    public function pageAction($meta, Request $request)
    {
        $edit = $request->get('edit') ? (bool) $request->get('edit') : false;

        return $this->renderView($meta['template'], ['placeholders' => $meta['placeholders'], 'edit' => $edit]);
    }

}