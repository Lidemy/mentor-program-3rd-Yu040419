<?php
session_start();
require_once('conn.php');
include_once('utils.php');
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FEI WEN</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
  <div class="wrap">

    <?php
      include_once('templates/navbar.php');
    ?>  
    <div class="container">
      <div class='row d-flex justify-content-center'>
        <div class='new__comment col-md-9 mt-2'>
        <?php
          if (empty($_SESSION['username'])) { ?>
            <div>登入後即可發布您的廢文</div>
          <?php
          } else { ?>
            <div class='new__comment--name'><?php echo escape($nickname) ?></div>
          <?php
          } ?>
          <form class='new__comment--block' action='./handle_add_comment.php' method='POST' >
            <textarea name='text' class='new__comment--text' placeholder='輸入您的廢文' required></textarea>
            <input type='hidden' name='parent_id' value='0'/>
            <?php
              if (empty($_SESSION['username'])) { ?>
                <div class='mt-2'>
                  <a href="./login.php" class='button mt-2'>我要登入</a>
                  <a href="./register.php" class='button mt-2 ml-2'>我要註冊</a>
                </div>
              <?php
              } else { ?>
                <input type='button' class='button add__comment mt-2' value='送出' />
              <?php
              } ?>     
          </form>
        </div>
      </div>
      <div class="latest">LATEST FEI WEN</div>
      <div class="comment mb-4 row d-flex justify-content-center">
        <?php
          $page = 1;
          if (!empty($_GET['page'])) {
            $page = intval($_GET['page']);
          }

          $comments_per_page = 20;
          $offset = ($page - 1) * $comments_per_page;
          $sql = "SELECT U.nickname, U.username, C.comm_id, C.parent_id, C.text, C.create_at AS time, C.is_deleted
            FROM yu_users AS U JOIN yu_comments AS C ON U.id = C.user_id
            WHERE C.is_deleted IS NULL AND C.parent_id = 0
            ORDER BY time DESC LIMIT ? OFFSET ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('ii', $comments_per_page, $offset);
          $result = $stmt->execute();

          if (!$result) {
            die($conn->error);
          }

          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()) {

            // 留言
            include('templates/comments.php');
          }
        ?>
      </div>
      <div class='page'>

      <?php
        $sql = "SELECT COUNT(comm_id) AS total, C.is_deleted 
          FROM yu_users AS U JOIN yu_comments AS C ON U.id = C.user_id
          WHERE C.is_deleted IS NULL AND C.parent_id = 0
          GROUP BY C.is_deleted";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
          die($conn->error);
        }

        $row = $result->fetch_assoc();
        $total_comments = $row['total'];
        $total_pages = ceil($total_comments / $comments_per_page);

        if ($page != 1) { ?>
          <a href='index.php?page=<?php echo $page - 1 ?>' class='page__btn'>上一頁</a>
          <?php	
        } 

        for ($i = 1; $i <= $total_pages; $i += 1) {
          if ($page == $i) {?>
          <span class='on'><?php echo $i ?></span>
          <?php
          } else { ?>
          <a href='index.php?page=<?php echo $i ?>' class='page__btn'><?php echo $i ?></a>
          <?php
          }
        }

        if ($page != $total_pages) { ?>
          <a href='index.php?page=<?php echo $page + 1 ?>' class='page__btn'>下一頁</a>
          <?php	
        } ?>
      </div>
    </div>
  </div>
  <?php
  if (empty($_SESSION['username'])) { ?>
    <script src="JS/visitor.js"></script>
  <?php
  } else { ?>
    <script src="JS/all.js"></script>
  <?php
  }
  ?>
</body>
</html>