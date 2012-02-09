# LessElephantBundle ![Travis build status](https://secure.travis-ci.org/matteosister/LessElephantBundle.png)#

A Bundle to use the [LessElephant](https://github.com/matteosister/LessElephant) library in a Symfony2 project.

This bundle scans your [less projects](http://lesscss.org/) on every request, and checks if they needs to be recompiled. It takes care of dependencies, so you can use less with **@import** without problems. So no javascript or manual excution of **lessc** is needed

Installation
------------

**deps file**

Add the bundle and the CompassElephant library to the deps file inside the root of your symfony project

```
[less-elephant]
    git=https://github.com/matteosister/LessElephant.git

[CompassElephantBundle]
    git=https://github.com/matteosister/LessElephantBundle.git
    target=/bundles/Cypress/LessElephantBundle
```

Autoload

*app/autoload.php*

``` php
<?php
$loader->registerNamespaces(array(
    // ... other namespaces ...
    'Cypress'          => __DIR__.'/../vendor/bundles',
    'LessElephant'     => __DIR__.'/../vendor/less-elephant/src'
));
```

Register the bundle in the **AppKernel.php** file inside the dev section

*app/AppKernel.php*

``` php
<?php
if (in_array($this->getEnvironment(), array('dev', 'test'))) {
    // ...other bundles ...
    $bundles[] = new Cypress\LesssElephantBundle\CypressLessElephantBundle();
}
```

Configuration
-------------

**Add the configuration in your config file (for the dev environment)**

*app/config_dev.yml*

```
cypress_less_elephant:
    less_binary_path: "/usr/local/bin/lessc"
    less_projects:
        my-first-project:
            source_folder: %kernel.root_dir%/../src/Cypress/DemoBundle/Resources/public/bootstrap/less
            source_file: bootstrap.less
            destination_css: %kernel.root_dir%/../src/Cypress/DemoBundle/Resources/public/bootstrap/css/bootstrap.css
        another-project:
            .....
```

**less_binary_path** (optional) is the path to your lessc binary. LessElephant try to find it with "which lessc". So, if you are on windows, you need this

**less_projects** (at least 1) define an entry for each of your less projects. All three parameters are mandatory

- *source_folder* the folder where all your less files resides

- *source_file* the main less file. Usually this is a file that contains many *@import* directive

- *destination_css* the destination css. **This file needs to be writable by web server user** (for example on linux *www-data*)


**Add the stylesheets to your templates**

*assetic*

```
{% stylesheets filter="yui_css"
    "@CypressDemoBundle/Resources/public/bootstrap/css/bootstrap.css" %}
    <link href="{{ asset_url }}" type="text/css" rel="stylesheet" />
{% endstylesheets %}
```

*without assetic*

```
<link href="{{ asset('bundles/cypressdemo/bootstrap/css/bootstrap.css') }}" type="text/css" rel="stylesheet" />
```

Enjoy!

How it works
------------

This bundle register an event listener that, on every request, check if the projects defined in the config_dev.yml files are in "clean" state or needs recompile.

If the project do not need to be recompiled, it adds a really small overhead to symfony, just the time to check a bunch of files.

Read the [LessElephant readme](https://github.com/matteosister/LessElephant) for other useful informations
