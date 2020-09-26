## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
當使用者瀏覽網頁的時候，一般都會透過網址連結到網頁，但其實真正瀏覽的是網址對應到的 IP 位址的網頁。因為 Server 看不懂網址，只看得懂 IP 位址。這時候 DNS 就是負責類似翻譯的工作，將網頁的網址翻成 IP 位址，或者從 IP 位址翻成網頁網址。

DNS 主要的運作流程是先從 client 端夾帶網址發送 HTTP request 時，DNS 會依序從 .(root) 根域名 、.tw 頂級域名、 .com.tw 次級域名的 DNS 索取紀錄，最終得到 IP 並傳回 client 端。

對一般大眾來說，當今天普通電信業者所提供的 DNS 壞掉時，大眾可以直接連上 Google 提供的 DNS，繼續使用網路相關服務。

而對 Google 來說，當我們使用 Google 提供的 DNS 時，Google 就會蒐集到更多我們的使用紀錄及歷程，經過大量蒐集這些資料後，就能產生更完善的演算法投放更精準的廣告。
## 什麼是資料庫的 lock？為什麼我們需要 lock？
假設今天有一個訂票網站有活動優惠、多人同時使用這個頁面，有兩筆的 request 幾乎同時到達 server，但票只剩下一張，因為 server 幾乎是同時收到 request，因此 server 會同時處理這兩筆訂單，這時候就會發生 race condition，兩筆訂單都訂購成功，導致發生超賣的悲劇。

這時候可以透過 lock 語法來解決這個問題，但要注意 lock 語法只能在 transaction 裡被使用。

lock 的概念是，如果把某個 query 上鎖的話，當今天有多筆 request 同時抵達 server，那 server 就會先把資料鎖起來，等待第一個 query 執行結束後，再依序執行其他 query。

上鎖方式很簡單，只要在 query 後面加上 `FOR UPDATE` 就可以了。
```php=
$conn->autocommit(FALSE);
$conn->begin_transaction();
$conn->query("SELECT amount FROM products WHERE id = 1 FOR UPDATE");
$conn->commit();
```
也因為會把資料鎖起來，所以當要上鎖時要特別注意上鎖的地方，一般是上鎖一個 row 或是 column 就可以了，如果不小心鎖到一個 table，效能上就會慢非常多。

## NoSQL 跟 SQL 的差別在哪裡？
* **存放資料規格**：NoSQL 不需要設定 schema，想放什麼就放什麼，並透過 Key-Value 進行存取，存進去的資料格式類似 JSON。但因為 SQL 有嚴謹的 schema 設定，放入的資料必須是符合設定的規格才能成功存取。
* **關聯性**：NoSQL 的資料表之間沒有關聯，不像 SQL 通常需要經過正規化來達成關聯。
* **遵循規則**：NoSQL 一般會選擇 CAP 理論當中的其中兩項遵循，通常是選擇CP或AP，而 SQL 則是一定都要遵循 ACID 規則。
* **擴充方式**：NoSQL 在做資料擴充時是以水平擴充，較簡易成本也較低。SQL 是以垂直擴充，較複雜、通常需停機，成本也較高。
* **存放資料類別**：使用 NoSQL 的資料庫通常會存 log 紀錄這種沒有固定格式的資料、或是 facebook 讚數這種大量、但不需要即時同步、正確的資料。使用 MySQL 的資料庫則相反。

[資料來源](https://www.ithome.com.tw/news/92506)
## 資料庫的 ACID 是什麼？
在使用 SQL 的資料庫中，使用 Transaction 時，需要符合 ACID 四個特性：
1. 原子性 atomicity：交易當中的多項 query 要嘛全部失敗，要嘛全部成功。
2. 一致性 consistency：維持資料的一致性。以轉帳來說，交易前後錢的總數不會變。
3. 隔離性 isolation：多筆交易不會互相影響（不能同時改同一個值）。
4. 持久性 durability：交易成功之後，寫入的資料不會不見。