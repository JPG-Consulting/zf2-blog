# ZF2 Blog Module


Blog module written using Zend Framework 2 and Doctrine.

## Introduction

I know other blog systems exist and I have been using Wordpress for some time. The main reasons to start this project are:

- Zend Framework integration.
- Multilingual capability.
- External blogging system have too many options.

### Zend Framework integration
Integrating an external blogging system into a ZF-2 project usually requires creating a theme for the ZF-2 project and another template for the blogging system. Why duplicate the work?

Another way would be creating a frontend for the blogging system in the ZF-2 project and ignoring the blogging system's frontend. This is usually crazy as it is almost as writting a new blogging system. Why waste the time?

### Multilingual capability
The ZF-2 blog modules I came upon don't have in mind multilingual capabilities and some existing module systems just don't do it as I would like it.

Take for example Wordpress with WPML plugin installed.If I wanted to have a category with the same slug for several languages (For example: `zend-framework`) I can't as Wordpress considers them as different categories and each category needs a unique slug. The same thing happens if the post title is not translatable. Maybe it's just me but i don't like the number at the end of the url if it's not necesary.

Some plugins even slow down the system as they try to work without interfering the base tables which mean extra SQL queries must be executed.

### Too many options
Some of the blogging systems have grown into more than just a blog. For example Wordpress is being used as a CMS. Why would I want all this CMS features if I'm developping the primary site using Zend Framework? I just want a simple blog!

## Dependencies

- [Zend Framework 2](https://github.com/zendframework/zf2)
- [Doctrine ORM Module](https://github.com/doctrine/DoctrineORMModule)
- [ZfcUser](https://github.com/ZF-Commons/ZfcUser)
- [ZfcUserDoctrineORM](https://github.com/ZF-Commons/ZfcUserDoctrineORM) (Optional)


## Installation

The suggested installation method is via [composer](http://getcomposer.org):

```sh
php composer.phar require jpg-consulting/zf2-blog
```

### Post installation
#### 1 - Enable it in your `application.config.php`

```php
    <?php
    return array(
        'modules' => array(
            'DoctrineModule',
            'DoctrineORMModule',
            'ZfcBase',
            'ZfcUser',
            // ...
            'Blog',
        ),
        // ...
    );
``` 

#### 2 - Import the SQL

The SQL data is located in the `data/database` folder.

Keep in mind this dumps do NOT include user tables. For user tables follow the installation steps of `ZfcUser` or any of its adapters. We recomend using `ZfcUserDoctrineORM`.

#### 3 - Install the skin (Recommended)

Although this step i not necesary it is strongly suggested as the module looks quite ugly when unthemed.

The default theme is inside the `data/skin`. Just copy the contents of the `public` directory into your public directory in order for css, image and Javascript files to be accesible.

Finally add the style sheet `css/blog.css` to your public layout.


## TODO

- Fix bug when editing a post (Language not set)
- Add pagination for post in the front end
- Crete the settings page to make them available
- Create a setting page for languages (Probably tabs on top)
- Create a locale plugin so the frontend starts working multi-lingual (Right now only default language)
- Add Categories
- Add Tags?
- Add canonical url
- Markup or WYSIWYG editor switcher (Enable per user settings)
- User management (Route should be configurable in case it integrates with other modules, ie ZfcAdmin)
