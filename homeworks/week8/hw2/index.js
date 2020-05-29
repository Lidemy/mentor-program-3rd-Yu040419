const request = new XMLHttpRequest();
const btn = document.querySelector('.btn');
const comment = document.querySelector('.comment');
const newId = document.querySelector('.new__id');
const newText = document.querySelector('.new__text');

const createDiv = () => {
  const div = document.createElement('div');
  div.classList.add('old__comment');
  comment.insertBefore(div, comment.childNodes[0]);
  div.innerHTML = `
    <div class="id__name">暱稱：<span class="old__id"></span></div>
    <div class="old__text"></div>`;
};

const loadComment = () => {
  const json = JSON.parse(request.responseText);
  const commentArr = json.map(item => Object.values(item)[1]);// 將第一個物件的 value 轉成陣列
  const idArr = json.map(item => Object.values(item)[0]);// 將第零個物件的 value 轉成陣列
  for (let i = 0; i < commentArr.length; i += 1) {
    createDiv();
    const oldId = document.querySelectorAll('.old__id');
    const oldText = document.querySelectorAll('.old__text');
    oldId[0].innerText = idArr[i];
    oldText[0].innerText = commentArr[i];
  }
};

request.open('GET', 'https://lidemy-book-store.herokuapp.com/posts?_limit=20');
request.onload = () => {
  if (request.status >= 200 && request.status < 400) {
    loadComment();
  } else {
    alert('系統不穩定，請再試一次');
  }
};
request.send();

const getNewComment = () => {
  request.open('GET', 'https://lidemy-book-store.herokuapp.com/posts?_limit=20');
  request.onload = () => {
    if (request.status >= 200 && request.status < 400) {
      const json = JSON.parse(request.responseText);
      const commentArr = json.map(item => Object.values(item)[1]);
      const newComment = commentArr[commentArr.length - 1];
      const idArr = json.map(item => Object.values(item)[0]);
      const newName = idArr[idArr.length - 1];
      createDiv();
      const oldId = document.querySelectorAll('.old__id');
      const oldText = document.querySelectorAll('.old__text');
      oldId[0].innerText = newName;
      oldText[0].innerText = newComment;
    } else {
      alert('系統不穩定，請再試一次');
    }
  };
  request.send();
};

btn.onclick = () => {
  if (newText.value === '') {
    alert('尚未填寫留言');
  } else if (newId.value === '') {
    alert('尚未填寫暱稱');
  } else {
    request.open('POST', 'https://lidemy-book-store.herokuapp.com/posts');
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.onload = () => {
      if (request.status >= 200 && request.readyState === 4) {
        getNewComment();
        newId.value = '';
        newText.value = '';
      } else {
        alert('系統不穩定，請再試一次');
      }
    };
    request.send(`id=${newId.value}&content=${newText.value}`);
  }
};
