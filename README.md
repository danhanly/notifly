# Notifly 
__Customisable & Extensible Notifications - Providing Alerts Exactly Where You Need Them__

[![Build Status](https://travis-ci.org/danhanly/notifly.svg?branch=master)](https://travis-ci.org/danhanly/notifly) [![Coverage Status](https://coveralls.io/repos/danhanly/notifly/badge.svg?branch=master&service=github)](https://coveralls.io/github/danhanly/notifly?branch=master)

Notifly makes it simple to store messages:

```php
$notifly = new Notifly();
$notifly->store('Notification Name', 'homepage');
```

Notifly makes it simple to render messages:

```php
$notifly = new Notifly();
$notifly->render('error', 'homepage');
```

## Customising

By default, notifly gives access to its SessionDriver to store messages in the default session, and also allows you to access four different types of renderer `error`, `warning`, `info` and `success` which use bootstrap display classes.

You can customise any of these by writing your own classes, and specifying them within the configuration file `.notifly.yml` which should exist within your project root.

```yml
renderers:
  error: \Notifly\Renderer\Error
  warning: \Notifly\Renderer\Warning
  info: \Notifly\Renderer\Info
  success: \Notifly\Renderer\Success
driver: \Notifly\Storage\SessionDriver
```

Providing the full class name for each of these items will allow Notifly to understand and utilise them in its processes.