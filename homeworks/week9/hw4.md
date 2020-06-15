## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
兩者最大的差別在於 TEXT 不可設定資料長度跟預設值，而 VARCHAR 皆可。

VARCHAR （VARiable CHAR），從名字 variable 中可以知道這個資料型態是可變的，而且也設定資料長度，也就是資料的大小。在欄位型態設定當中很常使用 VARCHAR，一來是比較不占空間，二來是搜尋時比較快。

另外還有一種欄位型態是 CHAR，一開始以為他是迷你的 VARCHAR，後來才發現他是固定長度，如果填入資料長度不足時，資料右邊會填上空白滿足當初設定的固定長度，因此在做資料處理時也要一併把空白處理掉。

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又會以什麼形式帶去 Server？
Cookie 就像是一張 MEMO 便條紙，這張 MEMO 紙有幾個特性：
* 可以記錄文字，但 MEMO 大小有限，不能紀錄太多東西。
* MEMO 是貼在瀏覽器那，不是伺服器。
* 有時效性，過一陣子這張 MEMO 就沒有用了。

### 為什麼需要 Cookie
因為 HTTP 是無狀態（stateless）的協議，也就是每次當瀏覽器發送 request 時，伺服器都會將它視為獨立個 request，因此在許多需要辨識身分的情況下就會非常不便，這時候就會需要用到 Cookie。
　　
以我們這次實作的會員系統為例，Cookie 就是讓伺服器了解，剛剛已經登入的使用者，就是現在想要留言的人。
### 如何產生 Cookie
瀏覽器今天夾帶個人帳戶資料要登入時，伺服器就會給瀏覽器一張寫著帳戶資料的 MEMO 紙，請瀏覽器貼在身上。這樣接下來瀏覽器接下來要留言時，瀏覽器就會知道是誰留的言。
　　
也就是假設今天伺服器接收到 http://www.example.com/test 發出 Tommy 要登入的 request，伺服器回傳的 response Header 中，就會夾帶：
* 使用者資料 ` Set-Cookie: username="Tommy" `
* 路徑 ` Set-Cookie: Path=/test`
* 網域 ` Set-Cookie: domain=example.com`

加起來就會是
``` 
HTTP/1.1 200 OK
Set-Cookie: username="Tommy"; path=/test; domain=example.com
```
後來當 Tommy 要新增留言時，瀏覽器就會帶著剛剛的 Cookie，傳送 request 給伺服器，讓伺服器辨識身分及相關資料。
```
POST /test/comment HTTP/1.1
Host: www.example.com
Cookie: username="Tommy"
```
於是伺服器就會知道是 Tommy 要留言了

參考資料：
* [白話 Session 與 Cookie：從經營雜貨店開始](https://medium.com/@hulitw/session-and-cookie-15e47ed838bc)
* [淺談 Session 與 Cookie：一起來讀 RFC](https://github.com/aszx87410/blog/issues/45)
* [php.net ─ setcookie](https://www.php.net/manual/en/function.setcookie.php)
* [MDN ─ HTTP Cookies](https://developer.mozilla.org/zh-TW/docs/Web/HTTP/Cookies)
## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
坦白說一開始沒有想到潛在問題，是看了老師寫的 Session 與 Cookie 系列第一集後，才覺得好像有可能會出現問題。

以會員系統為例，將會員資料存在 Cookie 當中，因為沒有進行加密，所以會員資料容易被修改或竊取。
