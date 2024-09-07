/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class',
  theme: {
    colors: {
        'black': '#000000',
        'dark': '#333232',
        'green': '#10D9A3',
        'magenta': '#EF466F',
        'yellow': '#FFC43D',
        'blue': '#0F708B',
        'purple': '#8797F5',
        'light': '#FBFFF0',
        'white': '#ffffff',
        'transparent': 'transparent'
    },
    fontFamily: {
        sans: ['Inter', 'sans-serif'],
        special: ['Kodchasan', 'sans-serif']
    },
    extend: {
      backgroundImage: {
          'light-gradient': 'linear-gradient(74deg, #F8F8F8 21.4%, #EDEDED 97.67%)',
          'glass-1': "linear-gradient(272deg, rgba(248, 255, 228, 0.27) -0.85%, rgba(255, 255, 255, 0.02) 94.37%)",
          'lightglass-1': 'linear-gradient(272deg, rgba(255, 255, 255, 0.62) -0.85%, rgba(229, 229, 229, 0.67) 24.94%, rgba(255, 255, 255, 0.70) 94.37%)',
          'glassborder-1': 'linear-gradient(270deg, rgba(255, 255, 255, 0.65) 0%, rgba(118, 118, 118, 0.49) 94%)',
          'glass-2': "linear-gradient(272deg, rgba(248, 255, 228, 0.07) -0.85%, rgba(250, 255, 237, 0.25) 31.88%, rgba(255, 255, 255, 0.02) 94.37%)",
          'lightglass-2': 'linear-gradient(272deg, rgba(255, 255, 255, 0.90) 2.2%, rgba(223, 223, 223, 0.74) 33.89%, rgba(255, 255, 255, 0.90) 94.37%)',
          'glassborder-2': 'linear-gradient(90deg, rgba(255, 255, 255, 0.4) 0%, rgba(118, 118, 118, 0.49) 94%)',
      },
      backdropBlur: {
          'glass-1': '14px',
          'glass-2': '8.5px',
      },
      boxShadow: {
          'glass-2': '2px 2px 20px 0px rgba(0, 0, 0, 0.30)',
          'lightglass-2': '2px 14px 59px 0px rgba(0, 0, 0, 0.07)',
          'strong': '2px 5px 15px 0 rgba(0, 0, 0, 0.10)',
          'stark': '2px 4px 10px rgba(0, 0, 0, 0.15)'
      }
    },
  },
  plugins: [],
}

