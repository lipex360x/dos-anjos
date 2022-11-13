<h2 align="center">Wordpress Rest Plugin API Boilerplate</h2>
<p align="center">Wodpress API with Plop Generator</p>

---

<p align="center">
  <img src="https://github.com/lipex360x/wordpress_api_rest/blob/main/assets/screen.png" />
</p>

---

#### :bookmark_tabs: Content Index

- [Startup](#zap-startup)

- [Generators](#zap-generator)

- [REST Routes](#zap-rest-routes)

---

#### :zap: Startup
* Install Packages
- Run: `yarn` or `npm i` in terminal

* Install Plugins

- [WP File Manager](https://wordpress.org/plugins/wp-file-manager/)

- [JWT Authentication](https://br.wordpress.org/plugins/jwt-authentication-for-wp-rest-api/)


Using ***WP File Manager***, insert in `wp-config.php`

```php
define('JWT_AUTH_SECRET_KEY', 'JWT_AUTH_SECRET_KEY_STRING');

define('JWT_AUTH_CORS_ENABLE', true);
```
---

#### :zap: Generator

- Run: `yarn gen` or `npm run gen` in terminal

- Follow the instructions

---

#### :zap: Rest Routes

http://[wordpress.url]/wp-json/api/[entity]

---

:point_up_2: [Go to Content Index](#bookmark_tabs-content-index)

---

:pushpin: Tips: for easier navigation by github, consider installing the [Octotree](https://chrome.google.com/webstore/detail/octotree-github-code-tree/bkhaagjahfmjljalopjnoealnfndnagc) plugin

