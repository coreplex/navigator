# Navigator

A PHP 5.4+ package to create navigation menus, and handle active and permissions.

## Installation

This package requires PHP 5.4+, and includes a Laravel 5 Service Provider and Facade.

We recommend installing the package through composer. You can either call `composer require coreplex/notifier` in 
your command line, or add the following to your `composer.json` and then run either `composer install` or `composer 
update` to download the package.

```php
"coreplex/navigator": "~0.1"
```

### Laravel 5 Integration

To use the package with Laravel 5 firstly add the carpenter service provider to the list of service providers in 
`app/config/app.php`.

```php
'providers' => array(

  Coreplex\Core\CoreServiceProvider::class,
  Coreplex\Navigator\NavigatorServiceProvider::class,

);
```

Then to run `php artisan vendor:publish` in your command line to publish the config.

## Registering Menus

To register a menu you add it into the `menus` array in the navigator config file. To register a menu you set a key to 
retrieve a the menu by as the key, and the class to build the menu as the value.

```php
'menus' => [
  'foo' => 'Navigators\FooNavigator'
]
```

By default the menu class will user a method called `design`, but if you want to set the method name your self just 
separate the class and method name with an @ symbol.

```php
'menus' => [
  'foo' => 'Navigators\FooNavigator@bar'
]
```

To see how to create menus check the [creating menus](#creating-menus) section below.

## Retrieving Menus

Once you've registered a menu to retrieve it use the `get` method.
 
```php
$menu = $navigator->get('foo');
```

## Creating Menus

To create a menu you need to return a nested array of menu items. Each item is made up of a url, any nested menu items, 
and then any attributes wish the item to have. As an example check the code below.

```php
class Sidebar 
{
  public function design()
  {
    return [
      [
        'url' => '/',
        'title' => 'Home',
      ],
      [
        'url' => 'about',
        'title' => 'about',
        'items' => [
          [
            'url' => 'meet-the-team',
            'title' => 'Meet The Team'
          ]
        ]
      ]
    ];
  }
}
```

This will add two items to then menu; one for the home page and the other is the about page. The about page also has 
nested items so we can display them in a drop down when rendering.

The url isn't required, but is used to check if the item is the active item.

You can add any attributes you wish to the menu items. In the example a title attribute has been set, but we could also
add an icon, class etc. here and then access it on the item when it is rendered.

### Filters

Occasionally you may need to only show a menu item if a condition is met; to do this with use filters.

To register a filter add it to the filters array in the config file by setting a unique key as a the key and a class
to use as the value.

```php
'filters' => [
  'hasAccess' => 'Navigators\Filters\HasAccess'
]
```

The filter classes by default use a method called `filter` but again if you want to specify a method then separate the 
class and method with an @ symbol.

```php
'filters' => [
  'hasAccess' => 'Navigators\Filters\HasAccess@foo'
]
```

To call a filter no a menu item add a filter attribute to the menu item.

```php
[
  'url' => '/admin',
  'title' => 'admin',
  'filter' => 'hasAccess',
  'permission' => 'admin.access',
],
```

The method on the filter class will then be passed the item so you can do any checking you need to.

```php
use Coreplex\Navigator\Contracts\Item;

class HasAccess 
{
  public function filter(Item $item)
  {
    if ($user->canAccess($item->permission) {
      return true;
    }
    
    return false;
  }
}
```

## Rendering Menus

To render a menu you have a couple of options. Either you can set a template to render it to, or you can access the 
menus properties.

### Rendering With a Template

To render with a template simply call the `render` method on the menu. This will either use the default view set in the 
config file, or you can pass the path to the template to use to the render method.

```php
$menu = $navigator->get('foo');

$menu->render();
$menu->render('path/to/template.php');
```

### Rendering From the Menu

To access the items in a menu use the `items` method or just pass the menu through a iterator.

```php
$items = $menu->items();

OR

foreach ($menu as $item) {
  //
}
```

Then once you've got a menu item you can can check if it is the active menu item by calling the `isActive` method.

```php
$item->isActive();
```

Then you can access any properties set on the item by just accessing the key on the item object. For example if you 
have set a url for the item then I could do the following.

```php
$item->url;
```