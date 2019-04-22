## Laravel疑難雜症

### 問題一、laravel5.4以上版本使用MySQL v5.7.7以下版本噴錯問題與解決方法

會出問題的原因是Laravel預設的database character為utf8mb4，v5.7.7以下版本不支援所以噴錯，所以需修改code如下:

#### 修改app/Providers/AppServiceProvider.php

```
use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}

```

#### 修改config/database.php
```
'mysql' => [ 
'driver' => 'mysql', 
'host' => env('DB_HOST', '127.0.0.1'), 
'port' => env('DB_PORT', '3306'), 
'database' => env('DB_DATABASE', 'forge'),
'username' => env('DB_USERNAME', 'forge'),
'password' => env('DB_PASSWORD', ''), 
'unix_socket' => env('DB_SOCKET', ''),
'charset' => 'utf8mb4', 
'collation' => 'utf8mb4_unicode_ci',
'prefix' => '', 
'strict' => true,
'engine' => null, ],
```
##### 修改成
```
'mysql' => [ 
'driver' => 'mysql', 
'host' => env('DB_HOST', '127.0.0.1'), 
'port' => env('DB_PORT', '3306'), 
'database' => env('DB_DATABASE', 'forge'),
'username' => env('DB_USERNAME', 'forge'),
'password' => env('DB_PASSWORD', ''), 
'unix_socket' => env('DB_SOCKET', ''),
'charset' => 'utf8', 
'collation' => 'utf8_unicode_ci',
'prefix' => '', 
'strict' => true,
'engine' => 'InnoDB ROW_FORMAT=DYNAMIC', ],
```
* 參考資料:https://laravel-news.com/laravel-5-4-key-too-long-error
* 參考資料:https://github.com/the-control-group/voyager/issues/901

### 問題二、使用第三方API回傳自己頁面，結果沒有反應

主要原因是Laravel預設會自動開啟CSRF，問題來了第三方無法設置token，導致頁面不執行，修改方式如下:

#### 修改app/Http/Middleware/VerifyCsrfToken
```
protected $except = [
 //在這裡輸入你想關閉CSRF的Route路徑
 'webhook/*'
];
```
* 參考資料:https://laravel-news.com/excluding-routes-from-the-csrf-middleware
* 參考資料:https://laravel.com/docs/5.8/csrf#csrf-excluding-uris

### 問題三、如何在WHM/cPanel server安裝Laravel
#### 第一步，登入你的Server，進入cPanel 用戶根目錄，執行以下代碼
```
composer.phar create-project laravel/laravel --prefer-dist 
```
#### 第二步，刪除預設資料夾public_html，建立軟連結將public_html連至laravel/public/
```
//刪除預設資料夾public_html
rm -rf public_html
//建立軟連結
ln -s laravel/public/ public_html 
```
#### 第二種方法，修改.htaccess
##### 不刪除public_html，laravel資料夾全部資料丟入public_html中，在.htaccess中加入程式碼如下:
```
RewriteEngine on
RewriteCond %{REQUEST_URI} !^public
RewriteRule ^(.*)$ public/$1 [L]
```
* 參考資料:https://www.linuxhelp.com/how-to-install-laravel-in-whmcpanel-server
* 參考資料:https://webmasters.stackexchange.com/questions/98700/htaccess-direct-all-requests-to-public-dir-when-using-framework-etc

## Laravel套件平台分享區

##### (1)Voyager 後台管理套件:https://laravelvoyager.com/
##### (2)線上代碼編輯器:https://codesandbox.io
##### (3)線上前端代碼開發社群:https://codepen.io/
