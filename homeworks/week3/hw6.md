## hw1：好多星星
這次所有功課當中，這一題是讓我想最久的一題。本來一直想說要用巢狀迴圈解題，一直嘗試了很多次，但都沒有辦法達到題目的要求。後來才開始想說，或許用其他的方式也可以達到的同樣的效果，所以就開始上網找資料。偶然中看見 repeat ，一試之後就可以了。
這次也給我了一個很深的體悟，寫程式時要轉換一下思維，如果認為 A 方法行不通時，就可以試試看 B 或 C 方法，不要將自己局限在框架中。
## hw2：大小寫互換
寫出符合題目要求的並沒有花很多時間，但寫出讓 Lidemy OJ 打滿分的，想了好久。
一開始寫的語法是：
```Javascript =
function alphaSwap(str) {
  let result = '';
  const testStr = 'AZ';
  for (let i = 0; i < str.length; i += 1) {
    if (str[i] >= testStr[0] && str[i] <= testStr[1]) {
      result += str[i].toLowerCase();
    } else {
      result += str[i].toUpperCase();
    } 
  }
  return result
}
```
Jest 測試都過了，但這樣的結果丟進去 OJ 裡面無法拿到的滿分，後來又在去把之前的筆記拿出來，發現
`str[i] >= testStr[0] && str[i] <= testStr[1]`
可被代替為
`str[i] >= 'A' && str[i] <= 'Z'`
才順利結束這回合。
## hw3：判斷質數
一開始是將所有的因數都丟進去一個字串，如果字串長度大於 2 的話，那就回傳 false。不是的話就回傳 true。但這個方式在 OJ 裡面無法拿滿分。所以才思考是不是有更精簡的用法。才想到把 i 的範圍設在 2 <= i < n，並直接在最開始的時候將 1 判斷 false。這樣就順利成功了。
## hw4：判斷迴文
剛開始看到迴文的時候就直接想到了 reverse 這個用法，開始翻筆記 reverse 該如何使用。但這時候就發現說 reverse 是陣列的語法，但 OJ 上不適用陣列的語法。所以就想到可以結合上個禮拜的作業，並透過加入條件式，如果輸入的字串相等翻轉過後的字串，那就可以回傳 True。這邊也順利在 OJ 拿到滿分。
不順利的是在 ESLint 的時候，那時候 ESLint 檢查出來的結果是要在最後加上 return。我就很不解的是，我明明已經加拉，OJ 拿了滿分、Jest 測試也過了，不太懂問題出在哪。後來才把最後的條件式的 else 刪除，並在最後直接加上 return false，才順利完成。從這次的經驗也才發現原來 return 的位置也是一件需要注意的事情。
## hw5：大數加法