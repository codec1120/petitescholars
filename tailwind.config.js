const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  purge: [
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    './public/**/*.html',
    './src/**/*.{js,jsx,ts,tsx,vue}',
  ],

  theme: {
    extend: {
      container: {
        center: true,
        padding: "1rem",
      },
      fontFamily: {
        sans: ["Poppins", ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: {
          50: "#F7FAF4",
          100: "#EFF6EA",
          200: "#D6E7CA",
          300: "#BDD9AB",
          400: "#8CBD6B",
          500: "#5AA02C",
          600: "#519028",
          700: "#36601A",
          800: "#294814",
          900: "#1B300D",
        },
      },
      width: {
      },
      height: {
      },
    },
  },

  plugins: [
    require("@tailwindcss/ui"),
    require('@tailwindcss/forms'),
  ],
};
