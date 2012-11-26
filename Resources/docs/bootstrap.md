Integrating bootstrap in your project
-------------------------------------

* follow the [installation instructions](https://github.com/matteosister/LessElephantBundle/blob/master/Resources/docs/installation.md)

* download bootstrap. I suggest to install it as a git submodule (if you want to modify something, and keep the upstream updates) or download as a zipball. Put it in your project, let's say **app/bootstrap** folder

* in your config.yml file, add this configuration

```yaml
cypress_less_elephant:
    less_projects:
        bootstrap:
            source_folder: %kernel.root_dir%/bootstrap/less
            source_file: bootstrap.less
            destination_css: %kernel.root_dir%/../src/Cypress/YourBundle/Resources/css/bootstrap/bootstrap.css
	# other folders you may have...
    force_compile: true
```

replace **YourBundle** with a real bundle name
by now we leave **force_compile** on, so we are sure that the project is compiled on the first request

* in your template add the css that gets compiled at runtime (the one you defined in **destination_css**)

```html+jinja
{% stylesheets "@YourBundle/Resources/css/bootstrap/bootstrap.css" %}
    <link href="{{ asset_url }}" type="text/css" rel="stylesheet" />
{% endstylesheets %}
```

* refresh your browser and you have bootstrap! (if at this point you got some permission problems, be sure that the bootstrap less folder and the destination folder are writable by you and the web server user, follow the [symfony2 docs](http://symfony.com/doc/current/book/installation.html#configuration-and-setup))

* **turn off the force_compile option**, or the performance will be a big problem!

```yaml
cypress_less_elephant:
    less_projects:
        bootstrap:
            source_folder: %kernel.root_dir%/bootstrap/less
            source_file: bootstrap.less
            destination_css: %kernel.root_dir%/../src/Cypress/YourBundle/Resources/css/bootstrap/bootstrap.css
	# other folders you may have...
    force_compile: false
```

Now you have bootstrap recompiled every time you make a change in the less code.

You can change some variables in *variables.less*, create new files to add custom style or even add a [bootswatch theme](http://bootswatch.com/)

And if you used a git submodule, you can have a fork, keep the upstream changes and merge them with your customizations.

If you want bootstrap as it is, just add the repository to your composer file (assuming you want the 2.2.1 version), and require it:

```json
{
    "require": {
        "twitter/bootstrap": "2.2.1"
    },
    "repositories": [
        {
           "type": "package",
           "package": {
               "version": "2.2.1",
               "name": "twitter/bootstrap",
               "source": {
	               "url": "https://github.com/twitter/bootstrap.git",
	               "type": "git",
	               "reference": "v2.2.1"
               },
               "dist": {
	               "url": "https://github.com/twitter/bootstrap/zipball/v2.2.1",
	               "type": "zip"
               }
           }
        }
    ]
}
```

obviusly you should change your config file to point to the bootstrap.less file in the vendor dir

```yaml
cypress_less_elephant:
    less_projects:
        bootstrap:
            source_folder: %kernel.root_dir%/../vendor/twitter/bootstrap/less
            source_file: bootstrap.less
            destination_css: %kernel.root_dir%/../src/Cypress/YourBundle/Resources/css/bootstrap/bootstrap.css
	# other folders you may have...
    force_compile: false
```
