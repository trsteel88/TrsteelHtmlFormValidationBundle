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

Add the bundle to the application kernal.

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        // ...
        new Trsteel\HtmlFormValidationBundle\TrsteelHtmlFormValidationBundle(),
        // ...
    );
}
```

Enable the bundle.

```yaml
# app/config/config_dev.yml
trsteel_html_form_validation:
    enabled: true
```
