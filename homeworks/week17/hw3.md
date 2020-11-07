```javascript
var a = 1
function fn() {
  console.log(a)
  var a = 5
  console.log(a)
  a++
  var a
  fn2()
  console.log(a)
  function fn2() {
    console.log(a)
    a = 20
    b = 100
  }
}
fn()
console.log(a)
a = 10
console.log(a)
console.log(b)
```
主要分成兩個階段，分別是第一階段的編譯及第二階段的執行。
第一階段編譯：
1. 建立 global EC 並 push 進 stack
2. 第一行宣告變數 a，放入 global EC 的 VO，並給予初始值 undefined
3. 第二行宣告函式 fn，放入 global EC 的 VO，給予初始值 function。建立 fn EC 並 push 進 stack。
4. 第三行沒有發現宣告，不做事
5. 第四行宣告變數 a，放入 fn EC 的 AO，並給予初始值 undefined
6. 第五行沒有宣告，不做事
7. 第六行沒有宣告，不做事
8. 第七行宣告變數 a，但發現 a 已經存在於 fn EC 的 AO，因此不做事
9. 第八行沒有宣告，不做事
10. 第九行沒有宣告，不做事
11. 第十行宣告函式 fn2，放入 fn EC 的 AO，給予初始值 function。建立 fn2 EC 並 push 進 stack。
12. 第十一行沒有宣告，不做事
13. 第十二行沒有宣告，不做事
14. 第十三行沒有宣告，不做事
15. 第十四行沒有宣告，不做事
16. 第十五行沒有宣告，不做事
17. 第十六行沒有宣告，不做事
18. 第十七行沒有宣告，不做事
19. 第十八行沒有宣告，不做事
20. 第十九行沒有宣告，不做事
21. 第二十行沒有宣告，不做事

第二階段執行：
1. 執行第一行：進入 Global scope，找 Global VO 是否有變數 a，有，將 1 賦值給 Global VO 的變數 a
2. 執行第十六行：呼叫 fn 函式
3. 執行第二行：執行 fn 函式並進入 fn scope
4. 執行第三行：找 fn AO 是否有變數 a，有，值是 undefined，因此在 console 印出 undefined
5. 執行第四行：找 fn AO 是否有變數 a，有，將 5 賦值給 fn AO 的 a
6. 執行第五行：找 fn AO 是否有變數 a，有，值是 5，因此在 console 印出 5
7. 執行第六行：找 fn AO 是否有變數 a，有，值是 5，5 加 1 等於 6，將 fn AO 變數 a 的值改成 6
8. 執行第七行：沒有執行任何程式
9. 執行第八行：呼叫 fn2 函式
10. 執行第十行：執行 fn2 函式並進入 fn2 scope
11. 執行第十一行：找 fn2 AO 是否有變數 a，沒有，於是往上找 fn AO 是否有變數 a，有，a 的值是 6。因此在 console 印出 6
12. 執行第十二行：找 fn2 AO 是否有變數 a，沒有，於是往上找 fn AO 是否有變數 a，有，將 20 賦值給 fn AO 的 a
13. 執行第十三行：找 fn2 AO 是否有變數 b，沒有，於是往上找 fn AO 是否有變數 b，沒有，於是往上找 global VO 是否有變數 b，沒有。目前非嚴格模式，因此在 global VO 中新增一變數 b 並賦值 100
14. 執行第九行：找 fn AO 是否有變數 a，有，值是 20。因此在 console 印出 20
14. 執行第十七行：找 Global VO 是否有變數 a，有，a 的值是 1。因此在 console 印出 1
15. 執行第十八行：找 Global VO 是否有變數 a，有，將 10 賦值給 Global VO 的 a
16. 執行第十九行：找 Global VO 是否有變數 a，有，a 的值是 10。因此在 console 印出 10
17. 執行第二十行：找 Global VO 是否有變數 b，有，b 的值是 100。因此在 console 印出 100

因此在 console 印出的結果是：
undefined
5
6
20
1
10
100