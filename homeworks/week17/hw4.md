```javascript
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello() // 2
obj2.hello() // 2
hello() // undefined
```

`this` 的值可以透過呼叫函式的方式來辨別：
1. `obj.inner.hello() = obj.inner.hello.call(obj.inner)`
而 obj.inner.value 等於 2，因此
 `obj.inner.hello()` 會得到 2。
2. `obj2.hello() = obj2.hello.call(obj2)`
而 obj2 等於 obj.inner，因此
 `obj2.hello()` 跟第一個答案依樣會得到 2。
3. `hello() = hello.call()`
因為 hello 函式是直接呼叫，這邊的情況可以分成嚴格模式及非嚴格模式。
在非嚴格模式下， `this` 值就是預設綁定，在 node.js 環境下是 global，在瀏覽器是 window，但在沒有特別設定 `this` 值的狀況下，`this.value` 會是 undefined。
嚴格模式下未設定的 `this` 的值本來就是 undefined，因此 `this.value` 也會是 undefined。