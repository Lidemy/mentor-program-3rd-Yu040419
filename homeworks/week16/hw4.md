## CSS 預處理器是什麼？
CSS 欲處理器是一種撰寫 CSS 檔案的方式，達到以程式邏輯撰寫 CSS 語法目的的同時，又可以提供純 CSS 檔案供瀏覽器渲染。

當 CSS 檔案過大時，容易讓檔案易讀性變差、難以維護，這時候 CSS 欲處理器可以透過程式邏輯，像是類似 function 函式、extend 繼承、variable 變數、import 引入等觀念，撰寫 CSS 檔案，讓檔案在後續維護時更方便簡單。
## 我們可以不用 CSS 欲處理器嗎？
在檔案很小時可以不使用，但是當檔案過大時，使用 CSS 欲處理器能發揮事半功倍的效用。
## 請舉出任何一個跟 HTTP Cache 有關的 Header 並說明其作用。
* `cache-control: no-store`： 不使用快取。
* `cache-control: no-cache`： 使用快取，但每次會詢問是否內容已更新。
* `cache-control: max-age=60`： 使用快取，且快取時限為 60 秒。
* `cache-control: private`： 只供瀏覽器使用快取。
* `cache-control: public`： 供瀏覽器及代理伺服器使用快取。
## Stack 跟 Queue 的差別是什麼？
Stack 只有一個出口，不管進來或出去都必須從這個出口，採 First In Last Out 形式，也就是先進來的後執行，晚近來的先執行。主要應用像是遞迴。

Queue 有一個出口，一個入口，因此先進來的先執行，採 First In First Out 形式。主要應用像是 CPU 的工作排程。
## 請去查詢資料並解釋 CSS Selector 的權重是如何計算的（不要複製貼上，請自己思考過一遍再自己寫出來）
個人把這五個類別分別想成撲克牌的大老二：
* `!important`：同花順
* `inline style`：鐵支
* `id`：黑桃二
* `class / pseudo-class / attribute`：Ace / 順子 / 葫蘆
* `element`：其他單張牌

所以優先順序顯而易見：
!important > inline style > id > class / pseudo-class / attribute > element

實際造就這樣的優先順序，是依照位數大小。當位數越大、值越大時，所套用的樣式都越優先：
* `!important`：第五位數。1, 0, 0, 0, 0。
* `inline style`：第四位數。0, 1, 0, 0, 0。
* `id`：第三位數。0, 0, 1, 0, 0。
* `class / pseudo-class / attribute`：第二位數。0, 0, 0, 1, 0。
* `element`：第一位數。0, 0, 0, 0, 1。

這樣的計算方式有兩個特性：
1. 位數可以相加，但無法進位
2. 假設計算出來的值相同，晚寫的會覆蓋前者

計算範例如下：
```css
/*  權重：0, 0, 0, 0, 3 */
div > div > div {
    background: grey;
}

/*  權重：0, 0, 1, 1, 1 */
#one > div .three {
    background: orange;
}

```