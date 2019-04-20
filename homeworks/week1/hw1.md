## 交作業流程

1. `git branch week1`，建立分支，名為 week1。
2. `git checkout week1`，從 master 切換到 week1。
3. `vim` 編寫功課，寫完按 `esc` ，再輸入 `:wq` 即可儲存並跳離文字編輯器。
4. 功課完成後，使用 `git commit -am"week1finished"`，加入控制並建立版本。
5. `git push origin week1` 將此分支上傳到 GitHub classroom。
6. 進入 GitHub classroom ，點選 Compare & Pull Request。
7. 確認是由 week1 merge 到 master裡，輸入標題及內容，按下 create pull request，複製當頁網址。
8. 進入交作業的地方，新增 issue。
9. 按照格式輸入標題及內容，貼上網址、以及想法，點選 submit new issue。
10. 假設作業沒有問題，就會由 Huli 點選 merge 並刪除分支。假設作業有問題，Huli 也會 merge ，這時候就從步驟一開始。
11. 作業完成， issue 被關掉後。回到 terminal ，` git checkout master` 切換到master。
12. `git pull origin master` ，將被 merge 後的 master 下載下來。
13. `git branch -d week1` ，將 week1 的分支刪除。
14. 作業完成。

