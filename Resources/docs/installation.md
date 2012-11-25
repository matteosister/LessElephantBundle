Installation
------------

**composer (symfony > 2.1)**

Add the bundle to your *composer.json* file

```json
{
	"require": {
		"cypresslab/less-elephant-bundle": "dev-master"
	}
}
```

and

```bash
$ php composer.phar install
```

composer will take care of intalling the LessElephant library for you.

**deps file (symfony 2.0)**

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
    $bundles[] = new Cypress\LessElephantBundle\CypressLessElephantBundle();
}
```
