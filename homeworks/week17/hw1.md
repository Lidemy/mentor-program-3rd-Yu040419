在解釋之前要先講解一下瀏覽器執行 JavaScript 程式碼主要分成三個執行區塊，分別是 Call Stack、Web APIs 及 Callback Queue。

因為 JavaScript 是單執行緒（Single Thread）的程式語言，一次只能執行一件事情。那遇到像是非同步的事件監聽怎麼辦呢？這時候就會需要剛剛談到的三個執行區塊，這三個執行區塊的執行流程，就被稱為 Event Loop。

回過頭來看這段程式碼：
```javascript
console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)
```
1. 將 `console.log(1)` 放入 Call Stack 裡，執行「在 console 印出 1」，執行後 `console.log(1)` 移出 Call Stack。
2. 將 `setTimeout(() => {
  console.log(2)
}, 0)` 放入 Call Stack 裡，執行時因為要計算秒數，所以將 setTimeout 中的匿名函式放入 Web APIs 計算秒數。
3. 將 `console.log(3)` 放入 Call Stack 裡，執行「在 console 印出 3」，執行後 `console.log(3)` 移出 Call Stack。
4. 剛剛在 Web APIs 的匿名函式在計算 0 秒後，匿名函式移到 Callback Queue 中，等待 Call Stack 完全空了、沒有待執行的程式碼時，將這個匿名函式移至 Call Stack 執行。
5. 將 `setTimeout(() => {
  console.log(4)
}, 0)` 放入 Call Stack 裡，執行時因為要計算秒數，所以將 setTimeout 中的匿名函式放入 Web APIs 計算秒數。
6. 將 `console.log(5)` 放入 Call Stack 裡，執行「在 console 印出 5」，執行後 `console.log(5)` 移出 Call Stack。
7. 剛剛在 Web APIs 的匿名函式在計算 0 秒後，匿名函式移到 Callback Queue 中，等待 Call Stack 完全空了、沒有待執行的程式碼時、並且待前面也在 Callback Queue 的程式先執行完畢後，再移至 Call Stack 執行。
8. 先進到 Callback Queue 的匿名函式移到 Call Stack。
9. 執行匿名函式，於是  `console.log(2)` 疊在匿名函式上方，執行「在 console 印出 2」，執行後 `console.log(2)` 移出 Call Stack。匿名函式也隨即移出 Call Stack。
10. 在 Callback Queue 的匿名函式移到 Call Stack。
11. 執行匿名函式，於是  `console.log(4)` 疊在匿名函式上方，執行「在 console 印出 4」，執行後 `console.log(4)` 移出 Call Stack。匿名函式也隨即移出 Call Stack。
12. 程式執行完畢。

因此在 console 中會依序印出：
1
3
5
2
4