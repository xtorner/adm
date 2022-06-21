## APP installation

App

#### Vagrant

Access vagrant (debian9) SSH

```
$ vagrant shh debian9
```

Admin permissions

```
$ sudo su
```

Copy Virtual-Host .cnf file for apache

```
$ cp /vagrant/vms/debian9/config/apache/vhosts/web.conf /etc/apache2/sites-available/web.conf
```

Enable and restart

```
$ a2ensite web
$ service apache2 restart
```

** Enable php mod_rewrite if it's not enabled.

### Hosts

Add to hosts file: `192.168.5.50 app.socialsmarthome.local`

### Project

Folder for installation: YOUR_VAGRANT_ROOT (**App Environment**)

```
$ cd projects/www/
```

`YOUR_VAGRANT_ROOT/projects/www/`

Clone Web (app).

```
$ git clone git@bitbucket.org:SocialSmartHome/{name}-web.git web
$ cd web
```

Move to laravel branch.

```
$ git checkout feature/laravel
```


Add config settings to `.env` file.

```
...
APP_URL=http://app.socialsmarthome.local:8000

...

DB_CONNECTION=mysql
DB_HOST=192.168.5.50
DB_PORT=3306
DB_DATABASE=ssh_app
DB_USERNAME=root
DB_PASSWORD=2012situlili

...

```

Create a mysql database called:
```
ssh_app
utf8mb4_general_ci
```

Install composer packages.

```
$ composer install
```

Install migrations and seed demo data.

```
$ php artisan migrate:refresh --seed
```

### Access

**User:** Administrator

**Password:** 12345678