// JS escape from: https://stackoverflow.com/questions/1787322/htmlspecialchars-equivalent-in-javascript/4835406#4835406

function escape(word) {
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;',
  };

  return word.replace(/[&<>"']/g, m => map[m]);
}

// 新增
function appendHtml(value) {
  const todoHtml = `
    <div class="input-group mb-3">
      <div class="todo__list input-group-text">
        <div class="todo__row">
          <input class="todo__box" type="checkbox" />
          <span class="todo__item">${value}</span>
        </div>
        <i class="todo__delete material-icons" title="delete">clear</i>
      </div>
    </div>
  `;
  $('.todo__block').append(todoHtml);
}

// 檢查有無輸入
function checkInput(input) {
  if (input === '') {
    alert('Please enter your todo item!');
  } else {
    appendHtml(escape(input));
  }
}

// 取得並新增
function addTodo() {
  const todoValue = $('.todo__inputbox').val();
  checkInput(todoValue);
}


$(document).ready(() => {
  // 按下 enter
  $('.todo__inputbox').keypress((e) => {
    if (e.keyCode === 13) {
      addTodo();
      // 清空輸入欄位
      $('.todo__inputbox').val('');
    }
  });

  // 點選新增圖示
  $('.todo__add').click(() => {
    addTodo();
    $('.todo__inputbox').val('');
  });

  // 事件代理
  $('.todo__block').click((e) => {
    // 勾選完成時有刪除線，反之沒有
    if ($(e.target).hasClass('todo__box')) {
      $(e.target).next().toggleClass('checked');
      // 刪除
    } else if ($(e.target).hasClass('todo__delete')) {
      $(e.target).parent().parent().remove();
    }
  });
});
