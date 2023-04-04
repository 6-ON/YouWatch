/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [],
  theme: {
    extend: {
      colors: {
        brown: {
          1: '#FFF8EA',
          2: '#9E7676',
          3: '#815B5B',
          4: '#594545',
        }
      },
      fontFamily: {
        Montserrat: ['Montserrat', 'sans-serif'],
        Inter: ['Inter', 'sans-serif'],
      },
      animation: {
        'pop-in': 'popIn 0.1s',
        'pop-out': 'popOut 0.1s',
      }, keyframes: {
        'popIn': {
          '0%': {transform: 'scale(0)'},
          '100%': {transform: 'scale(1)'},
        },
        'popOut': {
          '0%': {transform: 'scale(1)'},
          '100%': {transform: 'scale(0)'},
        },
      }
    },
  },
  plugins: [],
}
