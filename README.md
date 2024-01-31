# BookManageApp

## 著者API
### CREATE
|method|データ形式|
|:--|:--|
|post|json|

**URL**  
https://{ドメイン}/api/author  
例） http://localhost:8000/api/author  

**Request Body**  
|パラメータ|型|必須|
|:--|:--|:--|
|name|文字列|〇|

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

### READ
|method|データ形式|
|:--|:--|
|get|json|

**URL**  
https://{ドメイン}/api/author/{id}  
例） http://localhost:8000/api/author/1  

**Response Body**  
|パラメータ|内容|
|:--|:--|
|array|処理内容|

### UPDATE
|method|データ形式|
|:--|:--|
|put|json|

**URL**  
https://{ドメイン}/api/author/{id}  
例） http://localhost:8000/api/author/1  

**Request Body**  
|パラメータ|型|必須|
|:--|:--|:--|
|name|文字列|〇|

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

### DELETE
|method|データ形式|
|:--|:--|
|delete|json|

**URL**  
https://{ドメイン}/api/author/{id}  
例） http://localhost:8000/api/author/1  

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

***

## 出版社API
### CREATE
|method|データ形式|
|:--|:--|
|post|json|

**URL**  
https://{ドメイン}/api/publisher  
例） http://localhost:8000/api/publisher  

**Request Body**  
|パラメータ|型|必須|
|:--|:--|:--|
|name|文字列|〇|

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

### READ
|method|データ形式|
|:--|:--|
|get|json|

**URL**  
https://{ドメイン}/api/publisher/{id}  
例） http://localhost:8000/api/publisher/1  

**Response Body**  
|パラメータ|内容|
|:--|:--|
|array|処理内容|

### UPDATE
|method|データ形式|
|:--|:--|
|put|json|

**URL**  
https://{ドメイン}/api/publisher/{id}  
例） http://localhost:8000/api/publisher/1  

**Request Body**  
|パラメータ|型|必須|
|:--|:--|:--|
|name|文字列|〇|

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

### DELETE
|method|データ形式|
|:--|:--|
|delete|json|

**URL**  
https://{ドメイン}/api/publisher/{id}  
例） http://localhost:8000/api/publisher/1  

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

***

## 書籍API
### CREATE
|method|データ形式|
|:--|:--|
|post|json|

**URL**  
https://{ドメイン}/api/book  
例） http://localhost:8000/api/book  

**Request Body**  
|パラメータ|型|必須|
|:--|:--|:--|
|isbn|文字列|〇|
|name|文字列|〇|
|published_at|文字列|〇|
|author_id|数値|〇|
|publisher_id|数値|〇|

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

### READ
|method|データ形式|
|:--|:--|
|get|json|

**URL**  
https://{ドメイン}/api/book/{id}  
例） http://localhost:8000/api/book/1  

**Response Body**  
|パラメータ|内容|
|:--|:--|
|array|処理内容|

### UPDATE
|method|データ形式|
|:--|:--|
|put|json|

**URL**  
https://{ドメイン}/api/book/{id}  
例） http://localhost:8000/api/book/1  

**Request Body**  
|パラメータ|型|必須|
|:--|:--|:--|
|isbn|文字列|-|
|name|文字列|-|
|published_at|文字列|-|
|author_id|数値|-|
|publisher_id|数値|-|

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

### DELETE
|method|データ形式|
|:--|:--|
|delete|json|

**URL**  
https://{ドメイン}/api/book/{id}  
例） http://localhost:8000/api/book/1  

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

***

## ログインAPI
### LOGIN
|method|データ形式|
|:--|:--|
|post|json|

**URL**  
https://{ドメイン}/api/book  
例） http://localhost:8000/api/login  

**Request Body**  
|パラメータ|型|必須|
|:--|:--|:--|
|email|文字列|〇|
|password|文字列|〇|

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|

### LOGOUT
|method|データ形式|
|:--|:--|
|get|json|

**URL**  
https://{ドメイン}/api/logout
例） http://localhost:8000/api/logout

**Response Body**  
|パラメータ|内容|
|:--|:--|
|array|処理内容|

***

## 現在ログイン中のユーザのお気に入り書籍API
前提条件：ログイン後のみ利用可能

### CREATE
|method|データ形式|
|:--|:--|
|post|json|

**URL**  
https://{ドメイン}/api/favorite  
例） http://localhost:8000/api/favorite  

**Request Body**  
|パラメータ|型|必須|
|:--|:--|:--|
|book_id|数値|〇|

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

### READ
|method|データ形式|
|:--|:--|
|get|json|

**URL**  
https://{ドメイン}/api/favorite  
例） http://localhost:8000/api/favorite  

**Response Body**  
|パラメータ|内容|
|:--|:--|
|array|処理内容|

### UPDATE
|method|データ形式|
|:--|:--|
|put|json|

**URL**  
https://{ドメイン}/api/favorite/{id}  
例） http://localhost:8000/api/favorite/1  

**Request Body**  
|パラメータ|型|必須|
|:--|:--|:--|
|book_id|数値|〇|

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|

### DELETE
|method|データ形式|
|:--|:--|
|delete|json|

**URL**  
https://{ドメイン}/api/favorite/{id}  
例） http://localhost:8000/api/favorite/1  

**Response Body**  
|パラメータ|内容|
|:--|:--|
|result|処理結果|
|data|処理内容|