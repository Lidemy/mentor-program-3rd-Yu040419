let edit = true;

const btn = document.querySelector('.wrap');
btn.addEventListener('click', (e) => {
  let escape;

  //  編輯暱稱
  if (e.target.classList.contains('update__nickname')) {
    const nicknameForm = document.querySelector('.my__nickname--update');
    nicknameForm.classList.toggle('hidden');

  // 編輯帳號
  } else if (e.target.classList.contains('update__username')) {
    const usernameForm = document.querySelector('.my__username--update');
    usernameForm.classList.toggle('hidden');

  // 編輯密碼
  } else if (e.target.classList.contains('update__password')) {
    const passwordForm = document.querySelector('.my__password--update');
    passwordForm.classList.toggle('hidden');

  // 編輯留言
  } else if (e.target.classList.contains('comment__edit')) {
    const commentBlock = e.target.parentNode.parentNode.parentNode.parentNode;
    const commentText = commentBlock.children[1];
    const text = commentText.innerText;
    const commentId = commentText.dataset.id;

    // JS escape from: https://stackoverflow.com/questions/1787322/htmlspecialchars-equivalent-in-javascript/4835406#4835406

    escape = (word) => {
      const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;',
      };

      return word.replace(/[&<>"']/g, m => map[m]);
    };

    let formHtml = `
      <form class='comment__update--form' action='./handle_update.php' method='POST'>
        <textarea class='comment__update--text' name='update__text'>${text}</textarea>
        <input type='hidden'name='id' value='${escape(commentId)}' />
        <input type='submit' class='btn comment__update--confirm' value='編輯留言' />
        <span class='comment__update--cancel' >取消編輯</span>
      </form>
    `;

    // 去除 form 的換行
    formHtml = formHtml.replace(/\r\n|\n/g, '');

    if (edit) {
      commentText.classList.toggle('hidden');
      // 將 form 插入 commentText 之後的節點
      commentText.insertAdjacentHTML('afterend', formHtml);
      edit = false;
    } else {
      const form = commentBlock.children[2];
      commentBlock.removeChild(form);
      commentText.classList.toggle('hidden');
      edit = true;
    }

  // 取消編輯留言
  } else if (e.target.classList.contains('comment__update--cancel')) {
    const commentForm = e.target.parentNode;
    const commentText = e.target.parentNode.parentNode.children[1];
    commentText.classList.toggle('hidden');
    commentForm.classList.toggle('hidden');
    edit = true;
  }
});
