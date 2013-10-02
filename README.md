# ZF2 Blog Module


Blog module written using Zend Framework 2 and Doctrine.

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
1. Enable it in your `application.config.php`

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

2. Import the SQL
