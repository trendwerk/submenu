# Submenu
Submenu for [Timber](https://github.com/timber/timber).

## Installation
```sh
composer require trendwerk/submenu
```

## Usage
1. Add a new instance of Submenu to Timber's context
2. Use it like you would use a `Timber\MenuItem`

### Example

Add a new instance of Submenu to your context:
```php
use Trendwerk\Submenu\Submenu;
...
$context['submenu'] = new Submenu($menu);
```

Use `submenu` as you would use a `Timber\MenuItem`.
```twig
{% if submenu.children %}
  <h3>{{ submenu.title }}</h3>

  <ul>
	  {% for item in submenu.children %}
	  	<li>{{ item.title }}</li>
	  {% endfor %}
  </ul>
{% endif %}
```
