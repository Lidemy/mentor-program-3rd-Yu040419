## 教你朋友 CLI

以下以Windows系統為主。
### Command Line Interface的兒女 ─ Graphical User Interface
講 Command Line 之前呢，需要先提到圖形使用者介面 GUI ( Graphical User Interface )。那 GUI 又是什麼呢？

簡單來說就是我們目前正在使用的電腦介面，我們透過螢幕上的這些圖案跟電腦互動。舉例來說，我們會在某個檔案的圖案上面點兩下，打開這個檔案；也會停在檔案的圖示上，點右鍵修改檔名......等等。這些熟悉的操作都是透過 GUI 完成的。而 Command Line Interface 就是 GUI 的前身，在透過圖形操作跟電腦溝通前，之前使用電腦的人都是透過一行一行的打文字指令，告訴電腦要做甚麼事情，電腦再依照接收到的指令，做出反應。
### Command Line 跟 Command Line Interface 到底是甚麼關係？
現在請你想像一下，有個電腦工程師背對著你在寫程式，你一眼望過去就可以看到他在寫的內容。你腦子裡想像中，每個寫程式的人，螢幕都會有的黑底、看不懂的白色英文字、甚至對我們這些讀不懂程式的人來說，可以說是亂碼（？）的那個頁面，就是 Command Line Interface ( CLI )，人稱命令列介面。而 Command Line ( CMD )，就是裡面一行一行的文字，人稱命令列或命令提示字元。
### 不對啊，既然 GUI 這麼方便、易操作，為什麼還要用 CMD？
還記得之前有時候點一些檔案，電腦會跑出一個介面跟你說：「無法開啟檔案」嗎？這就是GUI的第一個小缺點，檔案類型很多，電腦無法開啟這麼多種檔案類型時，透過 CMD 就可以在 CLI 裡輕鬆打開檔案，聽起來是不是很酷？

除此之外，大家應該都有經驗，在網路速度有限的情況下，我們想看一篇有圖有文的網頁，大多都是先跑出字，再跑出圖的嘛。這就是 GUI 的第二個小缺點了，因為 GUI 透過圖形傳輸我們要電腦做的指令，這個過程當中，要傳送很多圖形數據；相較之下， CMD 只是小小的字元。在效率上， CMD 可是有極大的優勢。以上兩點就是為什麼，現在還是有許多人在使用 CMD 啦。
### 那該怎麼打開 CMD 呢？要下載嗎？
Windows系統有內建啦!很簡單，點選開始 → 所有程式 → 附屬應用程式 → 命令提示字元。就可以輕鬆找到啦。
如果你想要有個比較漂亮、好操作一點的介面，可以下載 Cmder ，兩個都可以喔。
### 那怎麼使用 CMD 呢？
先來了解一下 CMD 的幾個常用指令：
1. `pwb`：目前所在位置。
2. `ls`：目前所在位置中的檔案列表。
3. `cd`：改變路徑。
4. `touch`：新增檔案或改變檔案時間戳記。
5. `mkdir`：新增資料夾。
### 開始吧！
1. 使用 `mkdir wifi` 建立 wifi 資料夾。
2. 使用 `ls` 確定成功建立 wifi 資料夾。
3. 使用 `cd wifi` 改變路徑到wifi資料夾中。
4. 使用 `touch afu.js` 建立檔案。
5. 使用 `ls` 確定成功建立 afu.js 檔案。

