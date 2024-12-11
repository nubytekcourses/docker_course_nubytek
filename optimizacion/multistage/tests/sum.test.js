const sum = require('../src/sum');

test('Suma correctamente dos números', () => {
  expect(sum(1, 2)).toBe(3);
  expect(sum(-1, 1)).toBe(0);
});

// test('Prueba intencionalmente fallida', () => {
//   expect(true).toBe(false); // Esto siempre fallará
// });