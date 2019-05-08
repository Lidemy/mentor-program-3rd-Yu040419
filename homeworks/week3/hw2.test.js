const alphaSwap = require('./hw2');

describe('測試hw2', () => {
  it('should return correct answer when str = nick', () => {
    expect(alphaSwap('nick')).toBe('NICK');
  });
  it('should return correct answer when str = NICK', () => {
    expect(alphaSwap('NICK')).toBe('nick');
  });
  it('should return correct answer when str = ,hEllO122', () => {
    expect(alphaSwap(',hEllO122')).toBe(',HeLLo122');
  });
});
