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

const todoArr = [];

// 檢查輸入內容並跳脫
function checkInput(input) {
  if (input === '') {
    alert('Please enter your todo item!');
    return false;
  }
  return escape(input);
}

// 取得輸入內容並加進 array
function addTodo() {
  const todoValue = $('.todo__inputbox').val();
  if (checkInput(todoValue)) {
    const obj = {
      value: checkInput(todoValue),
      id: '',
      isDone: false,
    };
    todoArr.push(obj);
  }
}

// 將內容套入 html
function todoHtml(value, id, isDone) {
  return `
    <div class="input-group mb-3">
      <div class="todo__list input-group-text">
        <div class="todo__row">
          <input class="todo__box" data-id="${id}" type="checkbox" ${isDone ? 'checked' : ''}/>
          <span class="todo__item ${isDone ? 'checked' : ''}">${value}</span>
        </div>
        <i class="todo__delete material-icons" data-id="${id}" title="delete">clear</i>
      </div>
    </div>
  `;
}

// 將原有項目清空重新渲染畫面
function render() {
  $('.todo__block').empty();
  $('.todo__block').append(todoArr.map(item => todoHtml(item.value, todoArr.indexOf(item), item.isDone)));
}

$(document).ready(() => {
  // 按下 enter
  $('.todo__inputbox').keypress((e) => {
    if (e.keyCode === 13) {
      addTodo();
      // 清空輸入欄位
      $('.todo__inputbox').val('');
      render();
    }
  });

  // 點選新增圖示
  $('.todo__add').click(() => {
    addTodo();
    $('.todo__inputbox').val('');
    render();
  });

  // 事件代理
  $('.todo__block').click((e) => {
    // 勾選完成時有刪除線，反之沒有
    if ($(e.target).hasClass('todo__box')) {
      const id = $(e.target).data('id');
      console.log(todoArr[id].value);
      todoArr[id].isDone = !todoArr[id].isDone;
      $(e.target).next().toggleClass('checked');
      // 刪除
    } else if ($(e.target).hasClass('todo__delete')) {
      const id = $(e.target).data('id');
      todoArr.splice(id, 1);
      render();
    }
  });
});
