/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: ['./resources/**/*.blade.php'],
  theme: {
    extend: {
      colors: {
        primary: '#D5FFE4',
        primarybadge: '#E2F5FF',
        secondary: '#8BE8E5',
        secondarybadge: '#8BE8E5',
        thirdbadge: '#DBE88B',
        fourthbadge: '#F7BFBF',
        fifthbadge: 'rgba(253, 200, 88, 0.50)',
        sixthbadge: 'rgba(160, 132, 232, 0.50)',
        tertiary: '#A084E8',
        accent: '#6F61C0',
        gray: '#bfbfbf',
        lightgray: '#D1D1D1',
        graylight: '#D1D1D1',
        textgray: '#4E4E4E',
        tableheadbg: '#4E4F54',
        pagetextgray: '#656565',
        inputsearchgray: '#EFEFEF',
        btngreen: '#8BE8E5',
        lightgray: '#F1F1F1',
        mint: '#D5FFE4',
        theadgray: '#FAFAFA',
        purplelight: '#A084E8',
        purpledarker: '#6357ad',
        darkbgprimary: '#121212',
        darkbgsecondary: '#1F1B24',
        darkpurple: '#BB86FC',
        teal: '#03DAC5',
        badgereject: '#A30D11',
        purple: '#6F61C0',
        graydark: '#494949',
        'primary-dark': '#C7E9D3',
        customBlue: 'rgba(36, 0, 255, 0.55)',
        customblue: 'rgba(36, 0, 255, 0.55)',
      },
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif']
      },
      dropShadow: {
        'primary': '0px 3px 0px #000',
        '3xl': '0px 3px 0px black',
        '5xl': '10px 2px 2px rgba(0, 0, 0, 0.20)',
        'dropbottom' :'0px 4px 4px rgba(0, 0, 0, 0.05);',
        '4xl': [
          '0 35px 35px rgba(0, 0, 0, 0.25)',
          '0 45px 65px rgba(0, 0, 0, 0.15)'
        ],
      }
    },
  },
  plugins: [require('daisyui')],
}
