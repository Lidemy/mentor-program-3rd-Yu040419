class Stack {
  constructor() {
    this.arr = [];
  }

  push(value) {
    this.arr[this.arr.length] = value;
  }

  pop() {
    const lastItem = this.arr[this.arr.length - 1];
    this.arr.splice(this.arr.length - 1, 1);
    return lastItem;
  }
}

class Queue extends Stack {
  pop() {
    const firstItem = this.arr[0];
    this.arr.splice(0, 1);
    return firstItem;
  }
}

const stack = new Stack();
stack.push(1);
stack.push(2);
console.log(stack.pop()); // 2
console.log(stack.pop()); // 1

const queue = new Queue();
queue.push('a');
queue.push('b');
console.log(queue.pop()); // a
console.log(queue.pop()); // b
