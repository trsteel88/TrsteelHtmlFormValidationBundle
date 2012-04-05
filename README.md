Easily disable HTML5 validation errors.

Add the following lines to the deps file:

    [TrsteelHtmlFormValidationBundle]
        git=http://github.com/trsteel88/TrsteelHtmlFormValidationBundle.git
        target=/bundles/Trsteel/HtmlFormValidationBundle

Update your vendors by running:

```bash
$ php ./bin/vendors
```

Add the Trsteel namespace to your autoloader.

```php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    'Trsteel' => __DIR__.'/../vendor/bundles',
    // your other namespaces
));
```

Add the bundle to the application kernel.

``` php
<?php
// app/AppKernel.php
    public function registerBundles()
    {
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            // ...
            $bundles[] = new Trsteel\HtmlFormValidationBundle\TrsteelHtmlFormValidationBundle();
            // ...
        }
    }
```

