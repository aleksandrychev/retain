
INSTALLATION
-------------
### Dependencies

 Go to `basic` directory and run composer(https://getcomposer.org/) command:<br />
```composer install```

### Database
- Create database and configure
- Go to `basic` directory and run database migration commands:<br />
```php yii migrate/up --migrationPath=@app/modules/auth/migrations```<br />
```php yii migrate/up```<br />

### Ruby
  Install Ruby, you can use next commands <br />

cd
```git clone https://github.com/rbenv/rbenv.git ~/.rbenv```<br />
```echo 'export PATH="$HOME/.rbenv/bin:$PATH"' >> ~/.bashrc```<br />
```echo 'eval "$(rbenv init -)"' >> ~/.bashrc```<br />
```exec $SHELL```

```cd```<br />
```git clone https://github.com/rbenv/rbenv.git ~/.rbenv```<br />
```echo 'export PATH="$HOME/.rbenv/bin:$PATH"' >> ~/.bashrc```<br />
```echo 'eval "$(rbenv init -)"' >> ~/.bashrc```<br />
```exec $SHELL```<br />

```git clone https://github.com/rbenv/ruby-build.git ~/.rbenv/plugins/ruby-build```<br />
```echo 'export PATH="$HOME/.rbenv/plugins/ruby-build/bin:$PATH"' >> ~/.bashrc```<br />
```exec $SHELL```<br />

```git clone https://github.com/rbenv/rbenv-gem-rehash.git ~/.rbenv/plugins/rbenv-gem-rehash```<br />

```rbenv install 2.3.0```<br />
```rbenv global 2.3.0```<br />

### Pragmatic Segmenter
```apt-get install gem```<br />
```gem install pragmatic_segmenter```<br />

### Pdf2htmlEx
Example of installation for Ubuntu <br />
```sudo apt-add-repository ppa:coolwanglu/pdf2htmlex```<br />
```sudo apt-get update```<br />
```sudo apt-get install pdf2htmle```<br />

### Uoconv
```apt-get install unoconv```

### Supervizord
```apt-get install supervisor```

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

### Supervizord
start watcher.rb through supervizord