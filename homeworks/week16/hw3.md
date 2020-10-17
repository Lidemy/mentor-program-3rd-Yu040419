# Cache
中文是快取，中國翻作緩存。簡單來說就是把資料暫時存在一個地方，以快速讀取資料。

快取剛開始其實指的是硬體的 CPU 快取，後來衍伸出只要是類似可快速存取的應用，就可被稱為快取。其中包含但不限於網頁 Client-side 及 Server-side 的快取，以及 Proxy Server 代理伺服器的快取。
## Client-side Cache
前端相關的快取也被稱為 HTTP Caching，都跟瀏覽器相關。
### 種類
依照快取優先順序分為以下四種：
1. Memory Cache：
    *  最優先
    *  部分瀏覽器才有，包含但不限於 Chrome
    *  存放在記憶體的快取
    *  該頁籤關閉就後，快取就會消失
    *  F5 刷新網頁時大多都是從這裡快取資料
    *  相較 Disk Cache：
        *  存取速度快
        *  可存放的容量較小
2. Service Worker Cache
    * 僅次 Memory Cache 優先的快取
    * 需要安裝 Service worker 才可使用
    * 只限 HTTPS 協定
    * 即便 Service worker 沒有該資料的快取，但只要透過 Service worker，即便是從之後的 Disk cache 拿，都會顯示是從 Service worker 拿到的快取
    * 快取持續性長，關閉瀏覽器及頁籤後還可持續留存
3. Disk Cache / HTTP Cache
    * 存放在磁碟的快取
    * Client-Side Cache 大多都是 Disk Cache
    * 即便頁籤或是瀏覽器關閉，快取也不會消失
    * 相較 Memory Cache：
        * 存取速度較慢
        * 可存放的容量較大
4. Push Cache
    *  基於 HTTP/2 的 Session
    *  Session 結束快取也跟著消失
    *  以上三種都沒有才會被使用
    *  （實在是不了解 Push cache QQ

以上的優先順序如下圖（省略了部分瀏覽器才有的 Memory Cache）：
![](https://i.imgur.com/RHGoIVt.png)
[圖片來源](https://web.dev/service-worker-caching-and-http-caching/)
### 使用設定
Client-Side 的快取都是透過 Server 端的 HTTP Response Headers 來設定，所以其實只要 Server 端寫好設定，瀏覽器就會自動依照設定做相對應的運作。以下依照三種概念區分，分別是使用與否、有效期限及驗證。
#### 使用與否
* 不要使用：
    * `Cache-Control: no-store`：每次都發 request 到 Server 請求檔案
* 要使用：
    * `Cache-Control: public`：可被瀏覽器及中間的代理伺服器（Proxy Server）或是 CDN 快取
    * `Cache-Control: private`：只可被瀏覽器快取
    * `Cache-Control: no-cache`：每次都確認看資料有沒有變動更新。通常會搭配以下討論到的 `ETag` 或 `Last-Modified` 使用
    * `Pragma: no-cache`：跟 `Cache-Control: no-cache` 效用相同，但基本上不會使用，是古老的 header。
#### 有效期限
* `Cache-Control: max-age=60`：有效期限是收到 response 後 60 秒，假設 30 秒刷新頁面時，並不會跟 server 拿資料，而是從快取。是相對時間。
* `Cache-Control: s-maxage=60`：針對 proxy server 代理伺服器，像是 CDN 所設定的有效期限。如果 30 秒時 CDN 的快取內容有變，瀏覽器也不會發送 request。是相對時間。
* `expires: Wed, 21 Oct 2020 07:28:00 GMT`：絕對時間，該時間後就無效。

三者優先權： `Cache-Control: s-maxage` > `Cache-Control: max-age` > `Expires`。
#### 驗證
當快取過期時，不代表不能用快取裡的資料了，這時候就可以透過以下來跟 Server 確認，快取裡的資料是不是還可以使用。

驗證方法有兩種：
* 依照修改時間：`Last-Modified` 與 `If-Modified-Since`
* 依照檔案有無變動：`Etag` 與 `If-None-Match`
##### 依照修改時間
Server 設定的 Response Headers：
```
Status code: 200
Cache-Control: max-age=60
Last-Modified: Wed, 07 Oct 2020 07:28:00 GMT
// 上次修改時間是 2020-10-07 07:28:00 GMT
```
當一分鐘過後，快取已經過期時，使用者刷新瀏覽器時，瀏覽器會發送以下的 Request Headers：
```
If-Modified-Since: Wed, 07 Oct 2020 07:28:00 GMT
// 上次修改時間是 2020-10-07 07:28:00 GMT 嗎？
```
如果檔案不變時，Server 就會回覆：
```
Status code: 304 // 沒有改變 (Not Modified)
Cache-Control: max-age=60
Last-Modified: Wed, 07 Oct 2020 07:28:00 GMT
```
如果檔案有改變，Server 就會回覆：
```
Status code: 200 // 拿到新的檔案
Cache-Control: max-age=60
Last-Modified: Wed, 07 Oct 2020 07:30:00 GMT
// 換上新的修改時間 2020-10-07 07:30:00 GMT
```
##### 依照檔案有無變動
`Etag` 的概念有點類似 Hash，只要是同樣的輸入，一定會得到相同的輸出，`Etag` 也是。如果檔案內容沒有變動，`Etag` 的值也會是相同的。

Server 設定的 Response Headers：
```
Status code: 200
Cache-Control: max-age=60
Etag: x234dff
```
當一分鐘過後，快取已經過期時，使用者刷新瀏覽器時，瀏覽器會發送以下的 Request Headers：
```
If-None-Match: x234dff
// etag 值還是 x234dff 嗎?
```
如果檔案不變時，Server 就會回覆：
```
Status code: 304 // 沒有改變 (Not Modified)
Cache-Control: max-age=60
Etag: x234dff
```
如果檔案有改變，Server 就會回覆：
```
Status code: 200 // 拿到新的檔案
Cache-Control: max-age=60
Etag: x4524dgg
// 換上新的 Etag 值
```
一般來說，==會使用依照修改檔案與否的 `Etag` 與 `If-None-Match`==。因為有可能檔案從 A 改成 B 又改回 A，這樣依照編輯時間是有被改過的，還是會需要下載一遍相同的檔案。
### 常見使用類型
* 頻繁更動的資料：`cache-control: no-cache` 搭配 `etag`
    * 可以將 etag 的機制實作在 JS 檔案名稱，讓 JS 檔案。在 index.html 當中 `<script src="檔名有變動"></script>`，index.html 的 etag 就會改變，這時就會只需要
* 不常變化的資料：`cache-control: max-age=31536000` （一年）
* 希望檔案有更新，再發 request，可以將樓上兩者搭配使用。比方說在 index.html 設定 `cache-control: no-cache` 搭配 `etag`，而 index.html 裡 `<script src="script-qd3j2orjoa.js"></script>`，將 etag 機制直接放入 JS 檔案名稱。JS 檔案更改後不儲存檔案，直接令存檔案並更改檔名。JS 檔設定 `cache-control: max-age=31536000`。
這樣一來，一旦 JS 檔名更改，index.html 的 etag 也會更改，就可以達成目的。
### 失效
當瀏覽器發出 `PUT`、`POST`、`DELETE` 等請求時（要更改、新增、刪除資料時），原先該 URL 的各種 Client-side 快取就會自動失效。
### 強迫瀏覽器更新資源
* 打開 dev tools 的 Network 標籤，勾選 Disable cache 後，再重新按重新整理
* Ctrl + F5 / Ctrl + 按重新整理
## Proxy Server
> 代理伺服器，也稱為前向代理

代理伺服器顧名思義就是一個代理人的概念，介於 client 端跟 server 端的中間人，需要由 client 端設定。做的事情包含：
* 代理 client 發送 request
* 連接網際網路
* 將資料存在自己的快取
* 收到 server 的 response 並回覆給 client

也因為 Proxy Server 這個中間人的關係，所以間接形成一個防火牆，當外部要攻擊 client 端時，就會攻擊到 Proxy Server，因為所有請求的 IP 位址都是 Proxy Server。

一般來說常見的架構是，多個 client 對應一個 proxy server。在這樣的狀況下，當 client A 請求過 R 網站，隔天 client B 也想要請求 R 網站時，proxy server 就會依照快取的設定檢查有無過期後，直接從快取拿資料回傳給 cient B，達到降低負載的效果。

但一旦請求太多，proxy server 也是有可能會有應付不來的可能，這時候就可以考慮幫 proxy Server 設置他的上層代理伺服器（類似幫這個 proxy server 再開幾台 proxy server 的概念），詳細可以參考 [鳥哥的文章](http://linux.vbird.org/linux_server/0420squid.php#theory_parent_proxy)。

Proxy Server 特色包含：
* 因為快取加快網頁存取速度、減少網路頻寬浪費
* 提供類似防火牆功能保護 client
* 搭配上層代理伺服器可達成降低負載（Load Balance）的效果

Proxy Server 雖然好用，但有幾個致命的缺點：
* 因為隱藏 client 的 IP 位址，可能會被濫用做壞事
* 由使用者設定，對一般大眾門檻太高。且因設定不易，可能會因為快取機制拿到舊資料

因此就誕生了 CDN。
## CDN
> Content Delivery Network，內容傳遞網路

### Reverse Proxy
在討論 CDN 之前，要先來談談反向代理伺服器（Reverse Proxy），因為 CDN 是反向代理的應用之一。那什麼是反向代理呢？其實很多概念跟 Proxy Server 類似，最大的不同就是，反向代理的人並非 client，而是 Server。

反向代理的特色包含：
* 一般大眾使用門檻低：因為由 server 端進行設定，所以使用者不須做任何設定
* 保護 Server：跟前向代理（proxy server）相反，因為接收 response 的 IP 位址都是反向代理的，所以外部要攻擊 server 的難度提升不少
* 壓縮內容以節省網路頻寬
* 保留前向代理的優點：
    * 提供快取加快使用者存取速度
    * 降低伺服器負載
### 運作特色
CDN 的概念就向是 Server 端將反向代理伺服器放在各個地方，降低原先 client 發送 request 到距離更遠的地方時，可能產生的網路連接及交換問題。

除了 反向代理原本的特色外，CDN 特色還包含：
* 提高傳輸效能：CDN 可以依照使用者的位置連接距離最近、最順暢的反向代理
* 提高系統穩定性：
    * 當某個反向代理伺服器遭到攻擊時，CDN 就可以將 request 連接到其他的反向快取，繼續提供服務
    * Server 當機時，也因為 CDN 的快取機制讓使用者不至於都無法連線
### 注意要點
Server 端在設定 CDN 的快取有效時間，跟 CDN 回覆給 client 端的快取有效時間需要一致，否則會發生資料不同步的事情。可參考 [網路傳輸的加速 - CDN 與 HTTP 緩存](https://mark-lin.com/posts/20190921/)。

## 資料來源
* [深入理解浏览器的缓存机制](https://www.jianshu.com/p/54cc04190252)
* [循序漸進理解 HTTP Cache 機制](https://blog.techbridge.cc/2017/06/17/cache-introduction/)
* [Web 快取](https://zh.wikipedia.org/wiki/Web%E7%BC%93%E5%AD%98)
* [HTTP Caching -- Summer](https://cythilya.github.io/2018/07/27/http-caching/)
* [反向代理](https://zh.wikipedia.org/wiki/%E5%8F%8D%E5%90%91%E4%BB%A3%E7%90%86)
* [CDN](https://zh.wikipedia.org/wiki/%E5%85%A7%E5%AE%B9%E5%82%B3%E9%81%9E%E7%B6%B2%E8%B7%AF)