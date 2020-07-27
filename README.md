# CodeIgniter 3 Playground for Learning (ci3play.home.in)
## You can run this project online by setting without quotes '35.192.57.184	ci3play.home.in' in your hosts file 
- Windows (C:\WINDOWS\system32\drivers\etc\hosts)
- Unix or Mac (/etc/hosts)

## Project History
**27/07/2020 07:30 Hrs**
- Autoload session
- Use of session flashdata for displaying post create table, add, update & delete message
- Use of latest_by field to always show recent post

**26/07/2020 15:00 Hrs**
- Used custom helpers
- Edit a post
- Hard / Soft delete a post

**26/07/2020 02:00 Hrs**
- Show all post or by specific id order by post added date
- Create post controller
- New create post form with form validation
- New Post model for
    - checking database & Create Table (Using Forge and Util)
    - get posts (all or by id)
    - add new post

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
