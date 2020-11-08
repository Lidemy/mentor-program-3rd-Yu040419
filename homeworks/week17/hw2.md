```javascript
for(var i=0; i<5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}
```
在上面的程式碼中，依序執行以下步驟：
1. 執行 for 迴圈，宣告 i 等於 0。而 for 迴圈的條件是當 i 小於 5 時，執行 for 迴圈內的程式碼，執行後 i 加 1。
2. 目前 i 等於 0，且 i 小於 5，因此將 `console.log('i: ' + i)` 放入 Call Stack 中執行：在 console 印出「i: 0」。執行完畢後 `console.log('i: ' + i)` 移出 Call Stack。
3. 將 `setTimeout(() => {
    console.log(i)
  }, i * 1000)` 放入 Call Stack 中並執行：過了 `i * 1000` 毫秒後執行 `console.log(i)`。
  因為 setTimeout 需要透過 Web APIs 協助計時，因此印出 `console.log(i)` 的這段匿名函式會先進入 Web APIs。
4. 目前 i 值為 0，將 `i * 1000` 放入 Call Stack 中並執行，0 乘以 1000 等於 0。因此匿名函式 0 秒後會從 Web APIs 移入 Callback Queue 等待執行。`i * 1000` 也移出 Call Stack。目前 Callback Queue 有一個匿名函式等待執行。
5. 第一圈 for 迴圈執行完畢。i 加 1 等於 1。1 小於 5，因此開始執行第二圈。
6. 將 `console.log('i: ' + i)` 放入 Call Stack 中執行：在 console 印出「i: 1」。執行完畢後 `console.log('i: ' + i)` 移出 Call Stack。
7. 將 `setTimeout(() => {
    console.log(i)
  }, i * 1000)` 放入 Call Stack 中並執行：過了 `i * 1000` 毫秒後執行 `console.log(i)`。
  因為 setTimeout 需要透過 Web APIs 協助計時，因此印出 `console.log(i)` 的這段匿名函式會先進入 Web APIs。
8. 目前 i 值為 1，將 `i * 1000` 放入 Call Stack 中並執行，1 乘以 1000 等於 1000。因此匿名函式 1 秒後會從 Web APIs 移入 Callback Queue 等待執行。`i * 1000` 也移出 Call Stack。目前 Callback Queue 有兩個匿名函式等待執行。
9. 第二圈 for 迴圈執行完畢。i 加 1 等於 2。2 小於 5，因此開始執行第三圈。
10. 將 `console.log('i: ' + i)` 放入 Call Stack 中執行：在 console 印出「i: 2」。執行完畢後 `console.log('i: ' + i)` 移出 Call Stack。
11. 將 `setTimeout(() => {
    console.log(i)
  }, i * 1000)` 放入 Call Stack 中並執行：過了 `i * 1000` 毫秒後執行 `console.log(i)`。
  因為 setTimeout 需要透過 Web APIs 協助計時，因此印出 `console.log(i)` 的這段匿名函式會先進入 Web APIs。
12. 目前 i 值為 2，將 `i * 1000` 放入 Call Stack 中並執行，2 乘以 1000 等於 2000。因此匿名函式 2 秒後會從 Web APIs 移入 Callback Queue 等待執行。`i * 1000` 也移出 Call Stack。目前 Callback Queue 有三個匿名函式等待執行。
13. 第三圈 for 迴圈執行完畢。i 加 1 等於 3。3 小於 5，因此開始執行第四圈。
14. 將 `console.log('i: ' + i)` 放入 Call Stack 中執行：在 console 印出「i: 3」。執行完畢後 `console.log('i: ' + i)` 移出 Call Stack。
15. 將 `setTimeout(() => {
    console.log(i)
  }, i * 1000)` 放入 Call Stack 中並執行：過了 `i * 1000` 毫秒後執行 `console.log(i)`。
  因為 setTimeout 需要透過 Web APIs 協助計時，因此印出 `console.log(i)` 的這段匿名函式會先進入 Web APIs。
16. 目前 i 值為 3，將 `i * 1000` 放入 Call Stack 中並執行，3 乘以 1000 等於 3000。因此匿名函式 3 秒後會從 Web APIs 移入 Callback Queue 等待執行。`i * 1000` 也移出 Call Stack。目前 Callback Queue 有四個匿名函式等待執行。
17. 第四圈 for 迴圈執行完畢。i 加 1 等於 4。4 小於 5，因此開始執行第五圈。
18. 將 `console.log('i: ' + i)` 放入 Call Stack 中執行：在 console 印出「i: 4」。執行完畢後 `console.log('i: ' + i)` 移出 Call Stack。
19. 將 `setTimeout(() => {
    console.log(i)
  }, i * 1000)` 放入 Call Stack 中並執行：過了 `i * 1000` 毫秒後執行 `console.log(i)`。
  因為 setTimeout 需要透過 Web APIs 協助計時，因此印出 `console.log(i)` 的這段匿名函式會先進入 Web APIs。
20. 目前 i 值為 4，將 `i * 1000` 放入 Call Stack 中並執行，4 乘以 1000 等於 4000。因此匿名函式 4 秒後會從 Web APIs 移入 Callback Queue 等待執行。`i * 1000` 也移出 Call Stack。目前 Callback Queue 有五個匿名函式等待執行。
21. 第五圈 for 迴圈執行完畢。i 加 1 等於 5。5 並不小於 5，因此停止迴圈。
22. Call Stack 已經沒有需要執行的程式碼，這時候第一個進入 Callback Queue 的匿名函式會離開 Callback Queue 並進入
Call Stack 執行。
23. `console.log(i)` 進入
Call Stack 疊加在匿名函式上方，目前 i 值為 5，在 console 印出 5 之後，`console.log(i)` 移出 Call Stack，匿名函式也隨即移出 Call Stack。
24. 目前 Callback Queue 有四個匿名函式等待執行。最先進入 Callback Queue 的匿名函式會離開 Callback Queue 並進入
Call Stack 執行。
25. `console.log(i)` 進入
Call Stack 疊加在匿名函式上方，目前 i 值為 5，在 console 印出 5 之後，`console.log(i)` 移出 Call Stack，匿名函式也隨即移出 Call Stack。
26. 目前 Callback Queue 有三個匿名函式等待執行。最先進入 Callback Queue 的匿名函式會離開 Callback Queue 並進入
Call Stack 執行。
27. `console.log(i)` 進入
Call Stack 疊加在匿名函式上方，目前 i 值為 5，在 console 印出 5 之後，`console.log(i)` 移出 Call Stack，匿名函式也隨即移出 Call Stack。
28. 目前 Callback Queue 有兩個匿名函式等待執行。最先進入 Callback Queue 的匿名函式會離開 Callback Queue 並進入
Call Stack 執行。
29. `console.log(i)` 進入
Call Stack 疊加在匿名函式上方，目前 i 值為 5，在 console 印出 5 之後，`console.log(i)` 移出 Call Stack，匿名函式也隨即移出 Call Stack。
30. 目前 Callback Queue 只剩一個匿名函式等待執行。這個匿名函式會離開 Callback Queue 並進入
Call Stack 執行。
31. `console.log(i)` 進入
Call Stack 疊加在匿名函式上方，目前 i 值為 5，在 console 印出 5 之後，`console.log(i)` 移出 Call Stack，匿名函式也隨即移出 Call Stack。
32. Call Stack 清空，Callback Queue 清空，程式執行完畢。

因此執行結果為：
0
1
2
3
4
5
5
5
5
5
