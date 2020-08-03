# CodeIgniter 3 Playground for Learning (ci3play.home.in)
## You can run this project online by setting without quotes '34.72.208.189	ci3play.home.in' in your hosts file
- Windows (C:\WINDOWS\system32\drivers\etc\hosts)
- Unix or Mac (/etc/hosts)

## Project History
**03/08/2020 20:28 Hrs**
- Added Google reCAPTCHA (v2 Invisible)
- Removed codeignitor built in captcha

**02/08/2020 20:00 Hrs**
- Enabled captcha at login

**01/08/2020 23:26 Hrs**
- Now user can change its password
- No menu links if user not logged in

**01/08/2020 13:00 Hrs**
- Fixed file line endings from CRLF to LF only and tabs to spaces (4), also encoding to be UTF-8 only
- Now using PSR-12 coding standard ref. https://www.php-fig.org/psr/psr-12
- Removed view function replaced with siteLayout for more understandable page layouts
- Applied commit and rollback to not to store user registration information if email sending failed
- New function checkAuth added to check if a post is owned by logged in user

**31/07/2020 16:00 Hrs**
- Genarated App Password in accounts.google.com to send email from my gmail account which has 2 step verification enabled
- Added email functionality to send
- Verify emailed token to activate new registered user
- User already logged then email verify link should destroy current session and then verify email

**31/07/2020 07:00 Hrs**
- Using Bootstrap 5 svg icons
    - Use stroke="white" stroke-width="2" property to change default color and change default bolderness
    - Use width="1em" height="1em" property to change size
    - Use viewBox="0 1 16 16" property to adjust alignment of the icon
    - Use fill="#fd7e14" to change icon color or using boostrap class in class="text-danger"
- Using query builder LEFT JOIN to get post with author name

**30/07/2020 19:00 Hrs**
- New User Model for user Login & Registration
- Registration completed with all common validation rules
- In Login page, entered email id will be check if exists

**29/07/2020 23:00 Hrs**
- Project flow has been changed alot, earlier posts shown in Posts page is now moved to Home page
- UI changed including navbar and footer
- New login/sign-in page added
- New route added for posts

**28/07/2020 22:55 Hrs**
- Using $query->row() for getting only single object

**28/07/2020 21:15 Hrs**
- Use redirect method to go back to posts section after successfull add, edit or deletion
- Remove index method from Posts controller as its not required
- User form open and close method
- Now using bit more validation rules with custom message for each rule
- Using nl2br() php method in displaying a post

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
