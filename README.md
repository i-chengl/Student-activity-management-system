Yii 2 Basic Project Template
============================

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-basic/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-basic/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-basic)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the archive file downloaded from [yiiframework.com](http://www.yiiframework.com/download/) to
a directory named `basic` that is directly under the Web root.

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:~1.0.0"
php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.

Also check and edit the other files in the `config/` directory to customize your application.


# Yii2 Bootstrap Markdown Editor

Yii2 Markdown Editor based on [Bootstrap Markdown](http://www.codingdrama.com/bootstrap-markdown/).

This component use folowing libraries:
* [Marked](https://github.com/chjj/marked) -- a full-featured markdown parser and compiler, written in JavaScript.
* [To markdown](https://github.com/domchristie/to-markdown) -- an HTML to Markdown converter written in javascript.
* [Bootstrap Markdown](http://www.codingdrama.com/bootstrap-markdown/) -- JSimple Markdown editing tools that works!


## Installation

### Composer

The preferred way to install this extension is through [Composer](http://getcomposer.org/).

Either run

```
php composer.phar require uran1980/yii2-bootstrap-markdown-editor "dev-master"
```

or add

```
"uran1980/yii2-bootstrap-markdown-editor": "dev-master"
```

to the require section of your ```composer.json```


## Usage

### Active widget

In view in active form:

```php
<?php

use yii\widgets\ActiveForm;
use uran1980\yii\widgets\markdown\MarkdownEditor;
?>

<div class="active-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'content')->widget(MarkdownEditor::className(), [
        'clientOptions' => ['language' => Yii::$app->language],
        'options'       => ['data-provider' => 'markdown'],
    ]); ?>
    <?php ActiveForm::end(); ?>
</div>
```


### Simple widget

In view:

```php
<?php
use uran1980\yii\widgets\markdown\MarkdownEditor;

echo MarkdownEditor::widget([
    'name'          => 'md-editor',
    'value'         => '# test message',
    'clientOptions' => ['language' => Yii::$app->language],
    'options'       => ['data-provider' => 'markdown'],
]);
```


## See also

* [Markdown reminder](http://sites.ateliers-pierrot.fr/markdown-extended/markdown_reminders.html)
* [Markdown cheatsheet](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet#wiki-hr)
* [GFM (Github Flawored Markdown)](http://github.github.com/github-flavored-markdown/)


## Author
[Ivan Yakovlev](https://github.com/uran1980/), e-mail: [uran1980@gmail.com](mailto:uran1980@gmail.com)
