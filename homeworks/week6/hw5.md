## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
1. <summary> : 通常使用在 <details> 標籤內的元素，用來描述細節的摘要。
2. <aside> : 網頁的側欄、附加內容。
3. <details> : 描述文檔某個部分的細節。

## 請問什麼是盒模型（box modal）
盒模型簡單來說就是透過一張圖，讓你一眼明瞭元素的內容（content）、內邊距（padding）、邊框（border）及外邊距（margin）。

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
#### 1. `display: block`
區塊元素，代表元素如 `div`、`h1`、`p `，元素呈現一個區塊，佔滿一整行。可以對此區塊任意調整區塊屬性設定。
#### 2. `display: inline`
行內元素，代表元素如 `span`、`a` ，元素會並排在同一行，區塊相關屬性的設定時多數不會有反應，不過元素內容本身皆不會動。
* `width`、`height`，不會有反應。
* `margin` 只會影響左右外邊距，上下邊距不影響。
* `padding` 在無 `background` 或是 `border` 的狀況下，只會影響左右內邊距，上下不影響；但在有的狀況下，不管上下還是左右都會影響。 
#### 3. `display: inline-block`
代表元素如 `input`、`select`、`button`。這個功能就像是將 `display:inline` 跟 `display:block` 的功能合在一起。元素可併排在同一行，但同時也可對此區塊作任意調整設定。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
#### 1. static 
`position: static` ： 預設值。
#### 2. relative
`position: relative` ： 藉由 `top` 、`bottom`、`left`、`right`來調整該元素預設值的相對位置，單位為 px ，數值可為正或負數。
> 若調整只會調整該元素的位置，其他元素並不會一併移動，所以有可能會覆蓋到其他元素。
#### 3. absolute
`position: absolute` ：絕對定位，藉由父層的定位，來做絕對定位。舉例來說，如果父層是 `position: relative` 那就會在父層所涵蓋的元素範圍中，去做絕對定位。如果父層並沒有定位，那就會定在相對於該網頁（也就是 <body> 元素）最左上角的絕對位置，再一樣透過 `top` 、`bottom`、`left`、`right`定絕對定位。所以，網頁上下左右滑動時，位置會跟著父層一起移動。
#### 4. fixed
`position: fixed` ：在瀏覽器（更精確的說法是 viewport）
中固定其元素位置，不管上下左右滑動位置都不變。
