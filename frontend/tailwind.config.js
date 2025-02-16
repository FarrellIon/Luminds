/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx,vue}',
    'node_modules/flowbite/**/*.{js,jsx,ts,tsx}'
  ],
  theme: {
    extend: {
      colors: {
        "darkTeal": "#143647",
        "skyBlue": "#48BCFB",
        "orange": "#FF7A3D",
        "goldenYellow": "#FFBD3E",
        "beige": "#FFEFD1",
        "mocca": "#BEB096",
        "bean": "#5B503C"
      },
      backgroundImage: {
        'classic-dark': "url('/src/assets/img/classic.png')",
        'classic-light': "url('/src/assets/img/classic2.png')"
      }
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require('@lostisworld/tailwind-mask'),
  ],
}

