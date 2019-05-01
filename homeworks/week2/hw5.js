function join(str, concatStr) {
  let AfterJoin = '';
  for (let i = 0; i < str.length; i += 1) {
    AfterJoin += str[i];
    AfterJoin += concatStr;
  }
  AfterJoin = AfterJoin.substring(0, AfterJoin.length - 1);
  return AfterJoin;
}

function repeat(str, times) {
  let timeStr = '';
  for (let i = 1; i <= times; i += 1) {
    timeStr += str;
  }
  return timeStr;
}

console.log(join(['a', 1, 'b', 2, 'c', 3], ','));
console.log(repeat('yo', 5));
