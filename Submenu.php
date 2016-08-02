<?php
namespace Trendwerk\Submenu;

use Timber\Menu;

final class Submenu
{
    private $current;
    private $location;

    public function __construct($location)
    {
        $this->location = $location;
    }

    public function __get($name)
    {
        return $this->get()->{$name};
    }

    public function __isset($name)
    {
        return (isset($this->get()->{$name}) || method_exists($this->get(), $name));
    }

    private function get()
    {
        if (! $this->current) {
            $menu = new Menu($this->location);

            $currentItems = array_filter($menu->items, [$this, 'isCurrent']);
            $this->current = array_shift($currentItems);
        }

        return $this->current;
    }

    private function isCurrent($item)
    {
        return ($item->current || $item->current_item_parent || $item->current_item_ancestor || $this->hasCurrentClasses($item->classes));
    }

    private function hasCurrentClasses($classes)
    {
        $currentClasses = ['current-menu-item', 'current-menu-parent', 'current-menu-ancestor'];

        return !! count(array_intersect($currentClasses, $classes));
    }
}
