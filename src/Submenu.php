<?php
namespace Trendwerk\Submenu;

use Timber\Menu;
use Timber\MenuItem;

final class Submenu
{
    private $current;
    private $menu;

    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    public function __get(string $name)
    {
        return $this->get()->{$name};
    }

    public function __isset(string $name)
    {
        return (isset($this->get()->{$name}) || method_exists($this->get(), $name));
    }

    private function get()
    {
        if (! $this->current) {
            $menu = new Menu($this->menu);

            $currentItems = array_filter($menu->items, [$this, 'isCurrent']);
            $this->current = array_shift($currentItems);
        }

        return $this->current;
    }

    private function isCurrent(MenuItem $item)
    {
        return ($item->current || $item->current_item_parent || $item->current_item_ancestor || $this->hasCurrentClasses($item->classes));
    }

    private function hasCurrentClasses(array $classes)
    {
        $currentClasses = ['current-menu-item', 'current-menu-parent', 'current-menu-ancestor'];

        return !! count(array_intersect($currentClasses, $classes));
    }
}
