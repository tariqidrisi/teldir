
## Laravel Requirements

- PHP >= 7.1.3.
- OpenSSL PHP Extension.
- PDO PHP Extension.
- Mbstring PHP Extension.
- Tokenizer PHP Extension.
- XML PHP Extension.
- Ctype PHP Extension.
- JSON PHP Extension.

## Steps to run project

- Local server setup I used wamp server as my localhost. [Download Wamp](https://sourceforge.net/projects/wampserver/)
- Make sure you have Visual C++ Redistributable Packages. [Here](https://www.microsoft.com/en-za/download/details.aspx?id=48145)
- Add php path in your environment variables.
- Download composer. [Here]( https://getcomposer.org/download/ )
- Clone this repo `https://github.com/tariqidrisi/teldir.git` using `git clone` command.
- Create a `teldir` database in your localhost or whatever you like but make sure you set your db name same in your `.env` file.
- Edit your `.env` file as per your database configuration.  
- Run migrations using `php artisan migrate` command.
- Update your packages using `composer install / composer update` command.
- Install `node` librabries using `npm install` command and then run `npm run production` or `npm run dev` depending upon the server ebvironment. 


For any assistance mail me on `mohammedtariq@programmer.net`
