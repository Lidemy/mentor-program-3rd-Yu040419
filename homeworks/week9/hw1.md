### 資料庫名稱：mtr03group3
### 資料表名稱：yu_comments
| 欄位名稱 | 欄位型態 | 說明 | 備註 |
|---------|---------|-------|-------|
|  comm_id  |  integer  | 留言 id | Primary Key . AI |
|  user_id  |  integer  | 使用者 id |  |
|  text  |  varchar(512)  | 留言內容 |  |
|  create_at  |  datetime  | 留言時間 | CURRENT_TIMESTAMP |
### 資料表名稱：yu_users
| 欄位名稱 | 欄位型態 | 說明 | 備註 |
|---------|---------|-------|-------|
|  id  |  integer  | 使用者 id | Primary Key . AI |
|  nickname  |  varchar(32)  | 暱稱 | Unique |
|  username  |  varchar(32)  | 帳號 | Unique |
|  password  |  varchar(32)  | 密碼 |  |
### 檔案說明
#### 前台
* login_page.php：會員登入頁面
* register_page.php：會員註冊頁面
* index.php：主頁
#### 後台
* login.php：會員登入
* logout.php：會員登出
* register.php：會員註冊
* add.php：新增留言
* conn.php：連線到遠端資料庫並進行測試