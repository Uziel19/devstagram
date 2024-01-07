/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "resources/**/*.blade.php",
    "resources/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

/*Tailwind css le elimina todos los estilos a todas las etiquetas */

/* se incluyo el template de la paginacion para que se pudieran aplicar las clases de tailwind */