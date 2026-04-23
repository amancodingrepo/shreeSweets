/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./woocommerce/**/*.php",
    "./template-parts/**/*.php",
    "./assets/js/**/*.js"
  ],
  safelist: ['bg-brand-orange', 'text-brand-orange'],
  theme: {
    extend: {
      colors: {
        'brand-orange': '#F4821F',
        'brand-orange-dark': '#D96B10',
        'brand-orange-light': '#FEF3E8',
        'brand-red': '#C0392B',
        'brand-green': '#27AE60',
        'brand-ink': '#1A1A1A',
        'brand-ink2': '#555555',
        'brand-ink3': '#888888',
        'brand-bg': '#FFFFFF',
        'brand-bg2': '#FAF7F2',
        'brand-bg3': '#F2EBE0',
        'brand-line': '#EBE6DF',
      },
      spacing: {
        '1.25': '0.3125rem',
        '4.5': '1.125rem',
      },
      fontFamily: {
        'serif': ['"Playfair Display"', 'serif'],
        'sans': ['Poppins', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
