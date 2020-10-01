$(document).ready(() => {
  // 按讚出現登入才能按讚提示框
  $('.like').hover(() => {
    $('[data-toggle="tooltip"]').tooltip();
  });
});
