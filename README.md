# CodeIgniter 3 Playground for Learning (ci3play.home.in)

## History
**23/07/2020 23:00 Hrs**
- Added constructor in Controller
- Eliminate use of index.php in url
    - Created .htaccess in public folder and written below configuration:
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^(.*)$ index.php/$1 [L]
    - Set $config['index_page'] = ''
- Added new method post and display post relative to post number pass in url

**23/07/2020 06:30 Hrs**
- Created public to set it as document root thus enhancing security
- Set full path name of application and system directory in public/index.php
- Set base url & created salt for encryption key in application/config/config.php
- Set default database to mysql, using database ci4 with prefix ci3_
- Created default controller Pages
- Created default method view for view
- Created header and footer templates under views/templates