<?php
namespace Application\View\Helper;


use Zend\View\Helper\AbstractHelper;

class Sidebar extends AbstractHelper
{
// Menu items array.
    protected $items = [];

    // Active item's ID.
    protected $activeItemId = '';

    // Constructor.
    public function __construct($items=[])
    {

        $this->items = $items;
    }

    // Sets menu items.
    public function setItems($items)
    {
        $this->items = $items;
    }

    // Sets ID of the active items.
    public function setActiveItemId($activeItemId)
    {
        $this->activeItemId = $activeItemId;
    }

    public function render()
    {
        if (count($this->items)==0)
            return ''; // Do nothing if there are no items.


        $result = '<div class="col-md-3 left_col">';
$result .= '<div class="left_col scroll-view">';
$result .= '<div class="navbar nav_title" style="border: 0;">';
$result .= '<a href="/" class="site_title"><i class="fa fa-paw"></i> <span>Search Jobs</span></a>';
$result .= '</div>';
$result .= '<div class="clearfix"></div>';
$result .= '<br>';

//sidebar menu

        $result .= '<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">';
        $result .= '<div class="menu_section">';
        $result .= '<ul class="nav side-menu">';
        // Render items
        foreach ($this->items as $item) {
            $result .= $this->renderItem($item);
        }
        $result .= '</ul>';
        $result .= '</div></div></div></div>';


        return $result;
    }

    // Renders an item.
    protected function renderItem($item)
    {
        $id = isset($item['id']) ? $item['id'] : '';
        $isActive = ($id==$this->activeItemId);
        $label = isset($item['label']) ? $item['label'] : '';

        $result = '';

        if(isset($item['dropdown'])) {

            $dropdownItems = $item['dropdown'];

            $result .= '<li class="dropdown ' . ($isActive?'active':'') . '">';
            $result .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
            $result .= $label . ' <b class="caret"></b>';
            $result .= '</a>';

            $result .= '<ul class="dropdown-menu">';

            foreach ($dropdownItems as $item) {
                $link = isset($item['link']) ? $item['link'] : '#';
                $label = isset($item['label']) ? $item['label'] : '';

                $result .= '<li>';
                $result .= '<a href="'.$link.'">'.$label.'</a>';
                $result .= '</li>';
            }

            $result .= '</ul>';
            $result .= '</a>';
            $result .= '</li>';

        } else {
            $link = isset($item['link']) ? $item['link'] : '#';

            $result .= $isActive?'<li class="active">':'<li>';
            $result .= '<a href="'.$link.'">'.$label.'</a>';
            $result .= '</li>';
        }

        return $result;
    }
}