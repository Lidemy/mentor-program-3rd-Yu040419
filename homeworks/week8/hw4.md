## 什麼是 Ajax？
全名為 Asynchronous JavaScript and XML，並不是單指某個技術，只要是任何能跟伺服器交換資料的方式，都統稱為 AJAX。

最重要的是 Asynchronous 這個字，中文意思是「非同步」。
那甚麼是非同步呢？

就是去餐廳吃飯時，點餐後（發送 request 後），不需要一直站在出餐口等、只要坐在座位上做自己的事情（JS 繼續執行其他程式、暫不理會 response 何時回傳），餐點好了就會自己送來（response 好了就會回傳，通常會觸發 callback function）。
## 用 Ajax 與我們用表單送出資料的差別在哪？
1. 誰發送 request：表單送出資料時不會透過 JS，request 是由瀏覽器發送。但 Ajax 是透過 JS 發送 request ，而發送的過程中會經由瀏覽器。
2. 換頁：表單送出資料會需要換頁，Ajax 不需要換頁即可處理。
3. 速度：Ajax 因為不需要換頁、只需要局部刷新渲染，因此 Ajax 速度比表單傳送資料快得多。
## JSONP 是什麼？
全名是 JSON with Padding，透過 HTML 某些標籤像是 `<img/>` 和 `<script/>` ，不受同源政策（same-origin policy）的影響，來存取 Server 端的資料。

只要在 `<script/>` 標籤中放入想存取的網址，讓 server 端回傳資料後，再另外寫函式讀取取回的資料，就可以達成目的了。
## 要如何存取跨網域的 API？
如果我們需要跨來源存取資料時，這時候就需要 [CORS policy](https://developer.mozilla.org/zh-TW/docs/Web/HTTP/CORS)：
> CORS（Cross-Origin Resource Sharing，跨來源資源共享）

只要 Server 端在 HTTP Header 當中加以下這段，就可以讓不同來源存取資料：
```
access-control-allow-origin: * // 星號代表所有不同來源都可存取
```
除此之外，Server 端也可以透過 `access-control-allow-Headers` 以及  `access-control-allow-Methods` 來定義可存取資料的 Request Header 以及接受哪些 Method。
## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
因為第四週是透過 node.js 發送 request 而非透過瀏覽器，而同源政策是瀏覽器為了資安所設下的限制。因此如果不透過瀏覽器進行資料交換，就不會遇到跨網域的問題。
