function capitalize(str) {
  let firstCapiStr = str;
  firstCapiStr = str.replace(str[0], str[0].toUpperCase());
  return firstCapiStr;
}
console.log(capitalize('nick'));
console.log(capitalize('Nick'));
console.log(capitalize(',hello'));
