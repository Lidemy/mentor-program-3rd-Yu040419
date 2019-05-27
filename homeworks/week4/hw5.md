## 請以自己的話解釋 API 是什麼
如果把 API 擬人化的話，就像是餐廳中的服務生一樣，接受顧客（Client 端）的請求（Request），這個請求可能有很多種，包含像是要求看菜單（GET）、點餐（GET）、新增點餐內容（POST）、更改點餐內容（PATCH）、刪除內容（DELETE）等等。

服務生（API）會將這份請求傳給廚師（Server 端），廚師會再將完成的餐點（Response）交給服務生後，再由服務生送達到顧客桌上。

API 就是這樣扮演一個中間溝通的橋樑，提供兩端進行資訊交換。

## 請找出三個課程沒教的 HTTP status code 並簡單介紹
1. 304 Not Modified：東西跟之前長一樣，可以從快取拿就好。
2. 401 Unauthorized：未認證，可能需要登入。
3. 408 Request Timeout : 請求超時。可再隨時提交一次請求且無須修改。

## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。
### Base URL: https://www.best-restaurants.com
```json=
"restaurants": [
    {
      "_id": "1",
      "name": "Qiao",
      "address": "243 Centre Street, Ivanhoe, Oklahoma, 704",
      "email": "warnerferguson@qiao.com",
      "phone": "+1 (916) 544-3272"
    },
    {
      "_id": "2",
      "name": "Yogasm",
      "address": "816 Pleasant Place, Emory, Indiana, 5697",
      "email": "warnerferguson@yogasm.com",
      "phone": "+1 (844) 600-2343"
    },
    {
      "_id": "3",
      "name": "Buzzopia",
      "address": "192 Herkimer Place, Ernstville, West Virginia, 9795",
      "email": "warnerferguson@buzzopia.com",
      "phone": "+1 (926) 594-3097"
    },
    {
      "_id": "4",
      "name": "Helixo",
      "address": "261 Aurelia Court, Makena, Wisconsin, 2011",
      "email": "warnerferguson@helixo.com",
      "phone": "+1 (949) 424-2819"
    },
    {
      "_id": "5",
      "name": "Uplinx",
      "address": "844 Bassett Avenue, Balm, Palau, 785",
      "email": "warnerferguson@uplinx.com",
      "phone": "+1 (842) 408-2695"
    }
]
```


| 說明 | Method | path | 參數 | 範例 |
| -------- | -------- | -------- | -------- | -------- |
| 獲取所有餐廳 | GET| /restaurants |_limit:限制回傳資料數量 | /restaurants?_limit=5 |
| 獲取單一餐廳 | GET| /restaurants:_id | 無    | /restaurants/3 |
| 新增餐廳 | POST | /restaurants | name: 餐廳名稱  | 無   |
| 刪除餐廳 | DELETE | /restaurants:_id | Text     | 無  |
| 更改餐廳資訊 | PATCH | /restaurants:_id | phone: 電話號碼 | 無  |

