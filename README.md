# RC4 Budnle

Integrate RC4 support as Symfony2 bundle

Add your key as parameter

```xml
# parameters.yml
rc4_key: "this-is-my-super-secret-key"
```

## Get RC4 as service

```php
$obf = $this->container->get("corley_rc4.impl");

//Use it
echo $obf->rc4("this-is-my-string");
```

