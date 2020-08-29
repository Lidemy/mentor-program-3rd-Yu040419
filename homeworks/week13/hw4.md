## Bootstrap 是什麼？
[Bootstrap](https://getbootstrap.com/docs/4.5/components/alerts/) 是一個 UI Library，其中包含 CSS 跟 JS 兩個部分，可以擇一或是兩個一起使用。將很多寫好很美支援 RWD 的版型包起來，只要套上 class 就能讓網頁煥然一新。

但也因為實在是太好用，所以很多網頁都會使用，如果覺得看太膩，可以使用其他 UI Library 像是 [bootswatch](https://bootswatch.com/) 或是底下會講到的 CSS Framework 更換版型。

而不管是 Bootstrap 或是 Bootswatch 都有支援網格系統（Grid System）。
## 請簡介網格系統以及與 RWD 的關係
網格系統（Grid System）就是將主要的版面中，一列（row）切成十二個欄位（column），在不同的區塊透過標示該元素欄位數，來決定該元素的寬度。

比方說今天某個元素標示的寬度是一個欄位，那相對應的標示寬度的名稱是 `col-1` ，依照不同網站，可以設定不同列的寬度，因此相對應不同網站的欄位寬度也可能不同。假設該網站設定一列是 960 px，那 `col-1` 的寬度就會是 960 / 12 * 1 = 80；如果另一個元素的寬度是兩個欄位 `col-2` ，那該元素的寬度就會是 960 / 12 * 2 = 160，以此類推。

除此之外，網格系統可以依據不同的螢幕寬度，下不同的斷點（breakpoint），達到 RWD 的功能。以常見的 Bootstrap 的網格系統舉例：

Screen size | Extra small | Small | Medium | Large | Extra large
---------|---------|----------|---------|---------|---------
 breakpoint | <576px | <576px | ≥768px | ≥768px| ≥1200px

在螢幕大於 1200px 會有一種編排方式，當螢幕小於 1200px 又大於 768px 時，會又有另一種編排方式，以此類推。
## 請找出任何一個與 Bootstrap 類似的 library
* [Foundation](https://get.foundation/develop/getting-started.html)：除了有基本的網頁元件外，還有提供 email 的元件。（不過官方定位是 responsive front-end framework）
* [Bulma](https://bulma.io/)：個人認為看起來比 bootstrap 使用上更簡單，但缺點是沒辦法透過 JS 操控物件。是一個純粹的 CSS framework。
* [Tailwind CSS](https://tailwindcomponents.com/)：提供的元件較少（像是沒有 buttons 跟 forms），但可以高度客製化，也是一個 CSS framework。
* [Material UI](https://material-ui.com/)：基於 Google  [Material Design](https://wcc723.gitbooks.io/google_design_translate/content/) 的 React UI 框架。因此只能用在 React 框架，也無法自由套用 CSS class 名稱。

資料參考以下兩篇文章：
* [Bootstrap Alternatives: The top 36 options in 2020](https://classpert.com/blog/top-bootstrap-alternatives)
* [Top Bootstrap Alternatives](https://hackr.io/blog/top-bootstrap-alternatives)
## jQuery 是什麼？
前端好用的 library 函式庫，主要用來協助操控 DOM 物件。

（函式庫就像是別人動手造好的輪子，既然別人都已經寫好，就不需要花時間自己寫。大公司可能會對使用的 library 有規範，小公司的話通常就沒有。）

優點有二：
* 語法簡潔
* 支援跨瀏覽器

缺點就是假設今天要改成使用原生的 JS 時，要把所有的程式碼都更改過一遍，且因為容易依賴 jQuery 而忘記原生寫法。
## jQuery 與 vanilla JS 的關係是什麼？
vanilla JS 就是原生的 JS 語法，而 jQuery 就像是已經被包裝過的 JS function，只要放入相對應的參數跟文字，就可以用簡單的語法操控 DOM 物件。

簡單來說， jQuery 就是建立在 vanilla JS 的函式庫。
