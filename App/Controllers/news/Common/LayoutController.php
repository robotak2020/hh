<?php

namespace App\Controllers\news\Common;

use System\Controller;
use System\View\ViewInterface;

class LayoutController extends Controller
{
     /**
     * Disabled Sections container
     *
     * @var array
     */
    private $disabledSections = [];

    /**
    * Render the layout with the given view Object
    *
    * @param \System\View\ViewInterface $view
    */
    public function render(ViewInterface $view)
    {
        $data['content'] = $view;

        $sections = ['header', 'sidebar', 'footer'];

        foreach ($sections AS $section) {
            $data[$section] = in_array($section, $this->disabledSections) ? '' : $this->load->controller('news/Common/' . ucfirst($section))->index();
        }

        return $this->view->render('news/common/layout', $data);
    }

    /**
    * Determine what will be not displayed in the layout page
    *
    * @oaram string $section
    * @return $this
    */
    public function disable($section)
    {
        $this->disabledSections[] = $section;

        return $this;
    }

     /**
     * Set the title for the news page
     *
     * @param string $title
     * @return void
     */
    public function title($title)
    {
        $this->html->setTitle($title . ' | ' . $this->settings->get('site_name'));
    }
}